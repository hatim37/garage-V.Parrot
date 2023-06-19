<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ServiceController extends AbstractController
{

    
    /**
     * Cette function permet d'afficher les services
     *
     * @param ServiceRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[Route('/service', name: 'service.index', methods: ['GET'])]
    public function index(ServiceRepository $repository, PaginatorInterface $paginator, Request $request, InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
        $service = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/service/index.html.twig', [
            'service' => $service,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

   
    /**
     * Cette fonction permet de créer un nouveau service
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[Route('/service/nouveau', name: 'service.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager, InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service, ['labelButton' => 'Créer un service']);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();

            $manager->persist($service);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre service a été créé avec succès !'
            );

            return $this->redirectToRoute('service.index');
        }

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/service/new.html.twig', [
            'form' => $form->createView(),
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }


    
    /**
     * Cette fonction permet de modifier un service
     *
     * @param Service $service
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[Route('/service/edition/{id}', name: 'service.edit', methods: ['GET', 'POST'])]
    public function edit(Service $service, Request $request, EntityManagerInterface $manager,
     InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
        $form = $this->createForm(ServiceType::class, $service, ['labelButton' => 'Modifier']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $service = $form->getData();

            $manager->persist($service);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre service a été modifié avec succès !'
            );

            return $this->redirectToRoute('service.index');
        }

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/service/edit.html.twig', [
            'form' => $form->createView(),
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }


    /**
     * Cette fonction permet de supprimer un service
     *
     * @param EntityManagerInterface $manager
     * @param Service $service
     * @return Response
     */
    #[Route('/service/suppression/{id}', name: 'service.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Service $service): Response
    {
        $manager->remove($service);
        $manager->flush();
        $this->addFlash(
            'success',
            'Votre service a été supprimé avec succès !'
        );

        return $this->redirectToRoute('service.index');
    }
}
