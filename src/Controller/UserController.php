<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserPasswordType;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UserController extends AbstractController
{   

    /**
     * Cette fonction permet d'afficher la liste des utilisateur
     *
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param UserRepository $repository
     * @return Response
     */
    #[Security("is_granted('ROLE_ADMIN')")]
    #[Route('/utilisateur', name: 'user.index', methods: ['GET'])]
    public function index(PaginatorInterface $paginator, Request $request, InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, UserRepository $repository): Response
    {

        $utilisateur = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();


        return $this->render('pages/user/index.html.twig', [
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
            'user' => $utilisateur,

        ]);
    }
    
    
    /**
     * Cette fonction permet de modifier un utilisateur
     *
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')")]
    #[Route('/utilistateur/edition/{id}', name: 'user.edit', methods: ['GET', 'POST'])]
    public function edit(User $user, Request $request, EntityManagerInterface $manager,
     InformationRepository $informationRepository, HourlyRepository $hourlyRepository ): Response
    {
        //On verifie si il s'agit d'un rôle Admin
        $role = $this->getUser()->getRoles();
        $tableau [] = "ROLE_ADMIN";
        $result = count(array_uintersect($role, $tableau, function ($role, $tableau) {
            return strcmp($role, $tableau);
        })) > 0;

        //si le rôle n'est pas Admin alors on verifie si l'utilisateur est bien le propriétaire du compte à modifier
        if ($result == false) {
            if(!$this->getUser()) {
                return $this->redirectToRoute('security.login');
            }
            if($this->getUser() !== $user) {
                return $this->redirectToRoute('home.index');
            }
        }

        $form = $this->createForm(userType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            
		        $user->setUpdatedAt(new \DateTimeImmutable());
                $user = $form->getData();
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Votre compte a été modifié avec succès !'
                );

                return $this->redirectToRoute('home.index');
        }

         //repository pour afficher les variables dans le footer
         $informationRepository = $informationRepository->findAll();
         $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/user/edit.html.twig', [
            'form' => $form->createView(),
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }


    /**
     * Cette fonction permet de modifier un mot de passe
     *
     * @param User $choosenUser
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $hasher
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[Security("is_granted('ROLE_USER') and user === choosenUser")]
    #[Route('/utilisateur/edition-mot-de-passe/{id}', 'user.edit.password', methods: ['GET', 'POST'])]
    public function editPassword(User $choosenUser,Request $request, EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher, InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response {
        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($hasher->isPasswordValid($choosenUser, $form->getData()['plainPassword'])) {
                $choosenUser->setUpdatedAt(new \DateTimeImmutable());
                $choosenUser->setPlainPassword(
                    $form->getData()['newPassword']
                );

                $this->addFlash(
                    'success',
                    'Le mot de passe a été modifié.'
                );

                $manager->persist($choosenUser);
                $manager->flush();

                return $this->redirectToRoute('recipe.index');
            } else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe renseigné est incorrect.'
                );
            }
        }

         //repository pour afficher les variables dans le footer
         $informationRepository = $informationRepository->findAll();
         $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/user/edit_password.html.twig', [
            'form' => $form->createView(),
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

    
    /**
     * Cette fonction permet de supprimer un utilisateur
     *
     * @param EntityManagerInterface $manager
     * @param User $user
     * @return Response
     */
    #[Security("is_granted('ROLE_ADMIN')")]
    #[Route('/utilisateur/suppression/{id}', name: 'user.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, User $user): Response
    {
        $manager->remove($user);
        $manager->flush();
        $this->addFlash(
            'success',
            'Votre utilisateur a été supprimée avec succès !'
        );

        return $this->redirectToRoute('user.index');
    }
}

