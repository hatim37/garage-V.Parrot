<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Service;
use App\Repository\CarRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index(ServiceRepository $repository): Response
    {

        $service = $repository->findAll();

        return $this->render('pages/home.html.twig', [
            'service' => $service,
        ]);
    }

  
}
