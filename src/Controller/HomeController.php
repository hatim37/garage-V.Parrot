<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Service;
use App\Repository\CarRepository;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index(ServiceRepository $serviceRepository, InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
        
        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();
        $service = $serviceRepository->findAll();

        return $this->render('pages/home.html.twig', [
            'service' => $service,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

  
}
