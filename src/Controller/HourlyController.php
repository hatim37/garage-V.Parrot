<?php

namespace App\Controller;

use App\Entity\Hourly;
use App\Form\HourlyType;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HourlyController extends AbstractController
{
    #[Route('/horaire', name: 'hourly.index')]
    public function index(HourlyRepository $repository, PaginatorInterface $paginator, Request $request, InformationRepository $informationRepository): Response
    {
        //$horaire = $repository->findAll();

        $horaire = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();

        return $this->render('pages/hourly/index.html.twig', [
            'horaire' => $horaire,
            'information' => $informationRepository,
        ]);
    }

    /**
     * cette fonction permet de modifier une option
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */

     #[Route('/horaire/edition/{id}', name: 'hourly.edit', methods: ['GET', 'POST'])]
     public function edit(Hourly $hourly, Request $request, EntityManagerInterface $manager,
      InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
     {
         $form = $this->createForm(HourlyType::class, $hourly, ['labelButton' => 'Valider']);
         $form->handleRequest($request);
 
         if ($form->isSubmitted() && $form->isValid()) {
             $hourly = $form->getData();
 
             $manager->persist($hourly);
             $manager->flush();
 
             $this->addFlash(
                 'success',
                 'Votre horaire a été modifiée avec succès !'
             );
 
             return $this->redirectToRoute('hourly.index');
         }

         //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
 
         return $this->render('pages/hourly/edit.html.twig', [
            'form' => $form->createView(),
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
         ]);
     }
}
