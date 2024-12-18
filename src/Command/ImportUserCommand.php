<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(name: 'app:import-user', description: 'Imports users from JSON file')]
class ImportUserCommand extends Command
{
    private $em;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        $this->em = $em;
        $this->passwordHasher = $passwordHasher;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $json = file_get_contents('public/Visiteur.json');
        $data = json_decode($json, true);

        foreach ($data as $item) {
            $user = new User();
            $user->setOldId($item['id']);
            $user->setEmail(sprintf('%s.%s@gmail.com', $item['nom'], $item['prenom']));
            $user->setPassword($this->passwordHasher->hashPassword(
                $user,
                $item['mdp']
            ));
            $user->setNom($item['nom']);
            $user->setPrenom($item['prenom']);
            $user->setAddress($item['adresse']);
            $user->setPostal($item['cp']);
            $user->setCity($item['ville']);
            // Convert string to DateTime object
            $dateEmbauche = \DateTime::createFromFormat('Y-m-d', $item['dateEmbauche']);
            $user->setDateEmbauche($dateEmbauche);

            $this->em->persist($user);
        }

        $this->em->flush();

        $io->success('User data import completed.');

        return Command::SUCCESS;
    }
}
