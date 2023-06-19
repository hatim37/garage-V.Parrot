<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Contact;
use App\Form\CarType;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    
    /**
     * Cette fonction permet d'afficher les messages reçu
     *
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param ContactRepository $commentRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    #[Route('/contact', name: 'contact.index')]
    public function index(InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, ContactRepository $commentRepository, Request $request, 
     PaginatorInterface $paginator): Response
    {
        //On récupère les données de l'entité Commentaire et on utilise la pagination pour l'affichage
        $contact = $paginator->paginate(
            $commentRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            6 /*limit per page*/
        );

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();


        return $this->render('pages/contact/index.html.twig', [
            'contact'=> $contact,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

    
    /**
     * Cette fonction permet de créer un nouveau message
     *
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/contact/creation', name: 'contact.new', methods: ['GET', 'POST'])]
    public function new(InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, Request $request, 
     EntityManagerInterface $manager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre message a été envoyé avec succès.'
            );

            return $this->redirectToRoute('home.index');
        }
         //repository pour afficher les variables dans le footer
         $informationRepository = $informationRepository->findAll();
         $hourlyRepository = $hourlyRepository->findAll();
 
         return $this->render('pages/contact/new.html.twig', [
             'information' => $informationRepository,
             'horaire' => $hourlyRepository,
             'form' => $form->createView(),
         ]);
    }

    
    /**
     * Cette fonction permet de créer un nouveau message depuis une annonce avec le titre pré-rempli
     *
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param Car $car
     * @return Response
     */
    #[Route('/contact/creation/{id}', name: 'contact-car.new', methods: ['GET', 'POST'])]
    public function newAnnonce(InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, Request $request, 
     EntityManagerInterface $manager, Car $car): Response
    {
        //On récupère les données de l'annonce depuis sont formulaire
        $formCar = $this->createForm(CarType::class, $car);
        //On récupère le titre de l'annonce
        $car = $formCar->getData()->getTitle();
        

        $contact = new Contact();
        //On pré-rempli le champ Sujet avec le titre de l'annonce
        $contact->setSubject($car);

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre message a été envoyé avec succès.'
            );

            return $this->redirectToRoute('car.index');
        }

         //repository pour afficher les variables dans le footer
         $informationRepository = $informationRepository->findAll();
         $hourlyRepository = $hourlyRepository->findAll();
 
         return $this->render('pages/contact/new.html.twig', [
             'information' => $informationRepository,
             'horaire' => $hourlyRepository,
             'form' => $form->createView(),
         ]);
    }


    /**
     * Cette fonction permet de supprimer un message
     *
     * @param EntityManagerInterface $manager
     * @param Contact $contact
     * @return Response
     */ 
    #[Route('/contact/suppression/{id}', name: 'contact.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Contact $contact): Response
    {
        
        $manager->remove($contact);
        $manager->flush();

        //message flash
        $this->addFlash(
            'success',
            'Votre message a été supprimé avec succès !'
        );

        return $this->redirectToRoute('contact.index');
    }


    /**
     * Cette fonction permet d'afficher le contenu d'un message
     *
     * @param Contact $contact
     * @param InformationRepository $repository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[Route('/contact/{id}', name: 'contact.show', methods: ['GET'])]
    public function show(Contact $contact, InformationRepository $repository,
     HourlyRepository $hourlyRepository): Response
    {
        
        //repository pour afficher les variables dans le footer
        $hourlyRepository = $hourlyRepository->findAll();
        $information = $repository->findAll();

        return $this->render('pages/contact/show.html.twig', [
            'contact' => $contact,
            'information' => $information,
            'horaire' => $hourlyRepository,
        ]);
    }

}
