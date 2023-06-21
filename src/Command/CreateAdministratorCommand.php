<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:create-administrator',
    description: 'Create an administrator',
)]
class CreateAdministratorCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct('app:create-administrator');

        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::OPTIONAL, 'Name')
            ->addArgument('firstName', InputArgument::OPTIONAL, 'Fisrt Name')
            ->addArgument('email', InputArgument::OPTIONAL, 'Email')
            ->addArgument('password', InputArgument::OPTIONAL, 'Password');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        

        $helper = $this->getHelper('question');
        $io = new SymfonyStyle($input, $output);

        $name = $input->getArgument('name');
        if (!$name) {
            $question = new Question('Quel est le nom de l\'administrateur : ');
            $name = $helper->ask($input, $output, $question);
        }

        $firstName = $input->getArgument('firstName');
        if (!$firstName) {
            $question = new Question('Quel est le prénom de l\'administrateur : ');
            $firstName = $helper->ask($input, $output, $question);
        }

        $email = $input->getArgument('email');
        if (!$email) {
            $question = new Question('Quel est l\'email de ' . $firstName . ' : ');
            $email = $helper->ask($input, $output, $question);
        }

        $plainPassword = $input->getArgument('password');
        if (!$plainPassword) {
            $question = new Question('Quel est le mot de passe de ' . $firstName . ' : ');
            $plainPassword = $helper->ask($input, $output, $question);
        }

        $user = (new User())->setName($name)
            ->setFirstName($firstName)
            ->setEmail($email)
            ->setPlainPassword($plainPassword)
            ->setRoles(['ROLE_ADMIN']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('Le nouvel administrateur a été créé !');

        return Command::SUCCESS;
    }
}