<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    
    /**
     * Cette fonction permet d'afficher les commentaires
     *
     * @param ServiceRepository $serviceRepository
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param CommentRepository $commentRepository
     * @param Request $request
     * @param PictureCommentService $pictureService
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/', name: 'home.index', methods: ['GET', 'POST'])]
    public function index(ServiceRepository $serviceRepository, InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, CommentRepository $commentRepository): Response
    {
       
        //On récupère les commentaires pour les afficher dans la page d'accueil
        $comment = $commentRepository->findAll();

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();
        $service = $serviceRepository->findAll();

        return $this->render('pages/home.html.twig', [
            'service' => $service,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
            'comment'=> $comment,
        ]);
    }
}
