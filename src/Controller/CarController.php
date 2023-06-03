<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Images;
use App\Form\CarType;
use App\Repository\CarRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/car', name: 'car.index')]
    public function index(CarRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $car = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );


        return $this->render('pages/car/index.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/car/creation', name: 'car.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager, PictureService $pictureService): Response
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
                'Votre recette a été créé avec succès !'
            );

            return $this->redirectToRoute('car.index');
        }

        return $this->render('pages/car/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/car/edition/{id}', name:'car.edit', methods: ['GET', 'POST'])]
    public function edit(car $car, Request $request, EntityManagerInterface $manager, PictureService $pictureService): Response 
    {

        $form = $this->createForm(carType::class, $car);
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
                'Votre recette a été modifié avec succès !'
            );

            return $this->redirectToRoute('car.index');
        }

        return $this->render('pages/car/edit.html.twig', [
            'form' => $form->createView(),
            'car' => $car
        ]);
    }

    #[Route('/car/suppression/{id}', name: 'car.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Car $car): Response
    {
        $manager->remove($car);
        $manager->flush();
        $this->addFlash(
            'success',
            'Votre car a été supprimé avec succès !'
        );

        return $this->redirectToRoute('home.index');
    }

    #[Route('/car/suppression/image/{id}', name: 'car.delete_image', methods: ['DELETE'])]
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

    #[Route('/car/{id}', name: 'car.show', methods: ['GET'])]
    public function show(carRepository $repository, PaginatorInterface $paginator, Request $request, car $car): Response
    {

        $dataEquipment = $repository->findEquipment();
       
       

        return $this->render('pages/car/show.html.twig', [
            'car' => $car,
            'equipment'=> $dataEquipment,
        ]);
    }

}

