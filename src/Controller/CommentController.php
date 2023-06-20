<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Images;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\HourlyRepository;
use App\Repository\ImagesRepository;
use App\Repository\InformationRepository;
use App\Repository\ServiceRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    
    /**
     * Cette fonction permet d'afficher les commentaires
     *
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param CommentRepository $commentRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/commentaire', name: 'comment.index')]
    public function index(InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, CommentRepository $commentRepository, Request $request, 
     PaginatorInterface $paginator): Response
    {
        //On récupère les données de l'entité Commentaire et on utilise la pagination pour l'affichage
        $comment = $paginator->paginate(
            $commentRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();


        return $this->render('pages/comment/index.html.twig', [
            'comment'=> $comment,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

    
    /**
     * Cette fonction permet de créer un commentaire
     *
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param CommentRepository $commentRepository
     * @param Request $request
     * @param PictureService $pictureService
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/commentaire/creation', name: 'comment.new', methods: ['GET', 'POST'])]
    public function new(InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, Request $request, 
     PictureService $pictureService, EntityManagerInterface $manager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les images
            $images = $form->get('images')->getData();
            
            if($images){
                //on definit le dossier de destination
                $folder = 'comment';

                //on appelle le service d'ajout
                $fichier = $pictureService->add($images, $folder, 500, 500);

                $img = new Images();
                $img->setName($fichier);
                $comment->addImage($img);
            }

            $comment = $form->getData();
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre commentaire a été créé avec succès, il sera soumis à modération dans les plus brefs délais.'
            );

            return $this->redirectToRoute('comment.new');
        }

        

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();


        return $this->render('pages/comment/new.html.twig', [
           
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
            'form' => $form->createView(),
        ]);
    }

    
    /**
     * Cette fonction êrmet de modifier un commentaire
     *
     * @param Comment $comment
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param PictureService $pictureService
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/commentaire/edition/{id}', name: 'comment.edit', methods: ['GET', 'POST'])]
    public function edit(Comment $comment, Request $request, EntityManagerInterface $manager,
     InformationRepository $informationRepository, HourlyRepository $hourlyRepository, PictureService $pictureService): Response
    {
        $form = $this->createForm(CommentType::class, $comment, ['label' => 'Approuvé']);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les images
            $images = $form->get('images')->getData();
            
            if($images){
                //on definit le dossier de destination
                $folder = 'comment';

                //on appelle le service d'ajout
                $fichier = $pictureService->add($images, $folder, 500, 500);

                $img = new Images();
                $img->setName($fichier);
                $comment->addImage($img);
            }

            $comment = $form->getData();
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre commentaire a été modifié avec succès !'
            );

            return $this->redirectToRoute('comment.index');
        }
        
        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/comment/edit.html.twig', [
            'form' => $form->createView(),
            'comment' => $comment,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }



    /**
     * Cette fonction permet de supprimer un commentaire
     *
     * @param EntityManagerInterface $manager
     * @param Comment $comment
     * @param ImagesRepository $imagesRepository
     * @param Images $images
     * @param PictureService $pictureService
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/commentaire/suppression/{id}', name: 'comment.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Comment $comment, ImagesRepository $imagesRepository,
     Images $images, PictureService $pictureService): Response
    {
        //On récupère le nom des images qui appartienent à cette annonce
        $image = $imagesRepository->RemoveImageComment($comment->getId());
        

        //On boucle sur le resultat qui est une arrayCollection 
        foreach($image as $ligne){
            // On boucle une seconde fois pour extraire uniquement la valeur 'name' 
            foreach($ligne as $cle=>$valeur){
                
            //On appelle le service PictureService a qui on passe le nom de l'image
                if($pictureService->delete($valeur, 'comment', 500, 500)){
                //On supprime l'image de la base de données
                $manager->remove($images);
                $manager->flush();
                }
            }
        }
        //On supprime l'annonce
        $manager->remove($comment);
        $manager->flush();

        //message flash
        $this->addFlash(
            'success',
            'Votre commentaire a été supprimé avec succès !'
        );

        return $this->redirectToRoute('comment.index');
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
    #[Route('/commentaire/suppression/image/{id}', name: 'comment.delete_image', methods: ['DELETE'])]
    public function deleteImage(EntityManagerInterface $manager, PictureService $pictureService, Images $image, Request $request): JsonResponse
    {

        //On récupère le contenu dela requête
        $data = json_decode($request->getContent(), true);

        if($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])){
            //le token est valide

            //on récupère le nom de l'image
            $nom = $image->getName();

            if($pictureService->delete($nom, 'comment', 500, 500)){
                //On supprime l'image de la base de données
                $manager->remove($image);
                $manager->flush();
                return new JsonResponse(['success' => true], 200);
            }
        }
        // La suppression a échoué
        return new JsonResponse(['error' => 'Erreur de suppression'], 400);
    }
}
