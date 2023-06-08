<?php

namespace App\Controller;

use App\Entity\Equipment;
use App\Form\EquipmentType;
use App\Repository\EquipmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EquipmentController extends AbstractController
{
    #[Route('/equipment', name: 'equipment.index')]
    public function index(EquipmentRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $equipment = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('pages/equipment/index.html.twig', [
            'equipment' => $equipment,
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
    public function new(Request $request, EntityManagerInterface $manager): Response
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

        return $this->render('pages/equipment/new.html.twig', [
            'form' => $form->createView()
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
    public function edit(equipment $equipment, Request $request, EntityManagerInterface $manager): Response
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

        return $this->render('pages/equipment/edit.html.twig', [
            'form' => $form->createView()
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

    #[Route('/tags/ajout/ajax/{label}', name: 'add.ajax', methods: ['POST'])]
    public function addAjax(string $label, EntityManagerInterface $manager): Response
    {
        $equipment = new Equipment();
        $equipment->setName(trim(strip_tags($label)));
        $manager->persist($equipment);
        $manager->flush();

        $id = $equipment->getId();
        return new JsonResponse(['id' => $id]);

    }
}
