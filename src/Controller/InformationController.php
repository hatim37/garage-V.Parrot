<?php

namespace App\Controller;

use App\Entity\Information;
use App\Form\InformationType;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InformationController extends AbstractController
{
    #[Route('/information', name: 'information.index')]
    public function index(HourlyRepository $hourlyRepository, PaginatorInterface $paginator, Request $request, ServiceRepository $serviceRepository, InformationRepository $informationRepository): Response
    {
        

        $information = $paginator->paginate(
            $informationRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        $hourly = $hourlyRepository->findAll();
        $service = $serviceRepository->findAll();

        return $this->render('pages/information/index.html.twig', [
            'horaire' => $hourly,
            'service' => $service,
            'information' => $information,
        ]);
    }

    /**
     * cette fonction permet de modifier une option
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */

     #[Route('/information/edition/{id}', name: 'information.edit', methods: ['GET', 'POST'])]
     public function edit(Information $information, Request $request, EntityManagerInterface $manager,
      InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
     {
         $form = $this->createForm(InformationType::class, $information, ['labelButton' => 'Valider']);
         $form->handleRequest($request);
 
         if ($form->isSubmitted() && $form->isValid()) {
             $hourly = $form->getData();
 
             $manager->persist($hourly);
             $manager->flush();
 
             $this->addFlash(
                 'success',
                 'Votre information a été modifiée avec succès !'
             );
 
             return $this->redirectToRoute('information.index');
         }


         //repository pour afficher les variables dans le footer
         $hourly = $hourlyRepository->findAll();
         $informationRepository = $informationRepository->findAll();
 
         return $this->render('pages/information/edit.html.twig', [
            'form' => $form->createView(),
            'horaire' => $hourly,
            'information' => $informationRepository,
         ]);
     }
}
