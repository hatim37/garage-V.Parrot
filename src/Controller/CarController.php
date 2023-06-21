<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Images;
use App\Entity\PropertySearch;
use App\Form\CarType;
use App\Form\PropertySearchType;
use App\Repository\CarRepository;
use App\Repository\HourlyRepository;
use App\Repository\ImagesRepository;
use App\Repository\InformationRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    
    /**
     * Cette fonction permet d'afficher la liste des voitures selon une recherche
     *
     * @param CarRepository $repository
     * @param Request $request
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[Route('/voiture', name: 'car.index')]
    public function index(CarRepository $repository, Request $request,
     InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
      //On créer le formulaire de recherche
      $search = new PropertySearch();
      $form = $this->createForm(PropertySearchType::class, $search);
      $form->handleRequest($request);

      // On définit le nombre d'éléments par page
      $limit = 6;

      // On récupère le numéro de page
      $page = (int)$request->query->get("page", 1);

      // On récupère les annonces de la page en fonction du filtre
      $car = $repository->findBySearch($search, $page, $limit);
      
      // On récupère le nombre total d'annonces
      $total = $repository->getTotalAnnonces($search);

      //si on a une requete ajax, on modifie uniquement la partie "content"
      if($request->get('ajax')) {
          return new JsonResponse([
              'content' => $this->renderView('pages/car/_content.html.twig', [
                'car' => $car,
               'total'=> $total,
               'limit'=> $limit,
                'page' => $page,
              ])
          ]);
      }


      //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

      //si on a une requete classique
      return $this->render('pages/car/index.html.twig', [
          'car' => $car,
          'total'=> $total,
          'limit'=> $limit,
          'page' => $page,
          'form'=> $form->createView(),
          'information' => $informationRepository,
          'horaire' => $hourlyRepository,
      ]);

    }

    
    /**
     * Cette fonction permet de créer une annonce
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param PictureService $pictureService
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/voiture/creation', name: 'car.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager, PictureService $pictureService,
      InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les images
            $images = $form->get('images')->getData();
            
            foreach($images as $image){
                //on definit le dossier de destination
                $folder = 'car';

                //on appelle le service d'ajout
                $fichier = $pictureService->add($image, $folder);

                $img = new Images();
                $img->setName($fichier);
                $car->addImage($img);
            }

            $car = $form->getData();
            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre annonce a été créé avec succès !'
            );

            return $this->redirectToRoute('car.index');
        }

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/car/new.html.twig', [
            'form' => $form->createView(),
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

    
    /**
     * Cette fonction permet de modifier une annonce
     *
     * @param car $car
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param PictureService $pictureService
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/voiture/edition/{id}', name:'car.edit', methods: ['GET', 'POST'])]
    public function edit(car $car, Request $request, EntityManagerInterface $manager, PictureService $pictureService,
      InformationRepository $informationRepository, HourlyRepository $hourlyRepository, ImagesRepository $imagesRepository): Response 
    {

        $image = $imagesRepository->RemoveAllImageCar($car->getId());
            
        $form = $this->createForm(CarType::class, $car,  ['required' => $image ? false : true]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les images
            $images = $form->get('images')->getData();
            
            foreach($images as $image){
                //on definit le dossier de destination
                $folder = 'car';

                //on appelle le service d'ajout
                $fichier = $pictureService->add($image, $folder);

                $img = new Images();
                $img->setName($fichier);
                $car->addImage($img);
            }
            
            $car = $form->getData();

            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre annonce a été modifié avec succès !'
            );

            return $this->redirectToRoute('car.index');
        }

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/car/edit.html.twig', [
            'form' => $form->createView(),
            'car' => $car,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

    
    /**
     * Cette fonction permet de supprimer une annonce
     *
     * @param EntityManagerInterface $manager
     * @param Car $car
     * @param ImagesRepository $imagesRepository
     * @param Images $images
     * @param PictureService $pictureService
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/voiture/suppression/{id}', name: 'car.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Car $car,
     ImagesRepository $imagesRepository, Images $images, PictureService $pictureService): Response
    {
        
        //On récupère le nom des images qui appartienent à cette annonce
        $image = $imagesRepository->RemoveAllImageCar($car->getId());
        //dd($image);

        //On boucle sur le resultat qui est une arrayCollection 
        foreach($image as $ligne){
            // On boucle une seconde fois pour extraire uniquement la valeur 'name' 
            foreach($ligne as $cle=>$valeur){
            //On appelle le service PictureService a qui on passe le nom de l'image
                if($pictureService->delete($valeur, 'car')){
                //On supprime l'image de la base de données
                $manager->remove($images);
                $manager->flush();
                }
            }
        }

        //On supprime l'annonce
        $manager->remove($car);
        $manager->flush();

        //message flash
        $this->addFlash(
            'success',
            'Votre annonce a été supprimé avec succès !'
        );

        return $this->redirectToRoute('car.index');
    }


    /**
     * Cette fonction permet de supprimer une image
     *
     * @param EntityManagerInterface $manager
     * @param PictureService $pictureService
     * @param Images $image
     * @param Request $request
     * @return JsonResponse
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/voiture/suppression/image/{id}', name: 'car.delete_image', methods: ['DELETE'])]
    public function deleteImage(EntityManagerInterface $manager, PictureService $pictureService, Images $image, Request $request): JsonResponse
    {

        //On récupère le contenu dela requête
        $data = json_decode($request->getContent(), true);

        if($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])){
            //le token est valide

            //on récupère le nom de l'image
            $nom = $image->getName();

            if($pictureService->delete($nom, 'car')){
                //On supprime l'image de la base de données
                $manager->remove($image);
                $manager->flush();
                return new JsonResponse(['success' => true], 200);
            }
        }

        // La suppression a échoué
        return new JsonResponse(['error' => 'Erreur de suppression'], 400);
    }


    /**
     * Cette fonction permet d'afficher les détails d'une annonce
     *
     * @param car $car
     * @param InformationRepository $repository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[Route('/voiture/{id}', name: 'car.show', methods: ['GET'])]
    public function show(car $car, InformationRepository $repository,
     HourlyRepository $hourlyRepository): Response
    {
        
        //repository pour afficher les variables dans le footer
        $hourlyRepository = $hourlyRepository->findAll();
        $information = $repository->findAll();

        return $this->render('pages/car/show.html.twig', [
            'car' => $car,
            'information' => $information,
            'horaire' => $hourlyRepository,
        ]);
    }

}

