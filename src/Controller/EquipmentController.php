<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipmentController extends AbstractController
{
    #[Route('/equipment', name: 'equipment.index')]
    public function index( EquipmentRepository $repository, PaginatorInterface $paginator, Request $request,
      InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
        $equipment = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/equipment/index.html.twig', [
            'equipment' => $equipment,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);

    }

        /**
     * cette fonction permet de créer une nouvelle option
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */

    #[Route('/equipment/nouveau', name: 'equipment.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager, InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
        $equipment = new Equipment();
        $form = $this->createForm(EquipmentType::class, $equipment, ['labelButton' => 'Créer une option']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $equipment = $form->getData();

            $manager->persist($equipment);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre option a été créé avec succès !'
            );

            return $this->redirectToRoute('equipment.index');
        }

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/equipment/new.html.twig', [
            'form' => $form->createView(),
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

     /**
     * cette fonction permet de modifier une option
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */

    #[Route('/equipment/edition/{id}', name: 'equipment.edit', methods: ['GET', 'POST'])]
    public function edit(equipment $equipment, Request $request, EntityManagerInterface $manager,
     InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
        $form = $this->createForm(EquipmentType::class, $equipment, ['labelButton' => 'Valider']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipment = $form->getData();

            $manager->persist($equipment);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre option a été modifiée avec succès !'
            );

            return $this->redirectToRoute('equipment.index');
        }

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/equipment/edit.html.twig', [
            'form' => $form->createView(),
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }



    /**
     * Cette fonction permet de supprimer une option
     *
     * @param EntityManagerInterface $manager
     * @param equipment $equipment
     * @return Response
     */

    #[Route('/equipment/suppression/{id}', name: 'equipment.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, equipment $equipment): Response
    {
        $manager->remove($equipment);
        $manager->flush();
        $this->addFlash(
            'success',
            'Votre option a été supprimée avec succès !'
        );

        return $this->redirectToRoute('equipment.index');
    }

}
