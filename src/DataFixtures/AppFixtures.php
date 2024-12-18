<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'password'
        ));

        $user->setNom('Dupont');
        $user->setPrenom('Jean');
        $user->setAddress('123 rue de la Paix'); // Use setAddress() instead of setAdresse()
        $user->setPostal(75000);
        $user->setCity('Paris');
        $user->setDateEmbauche(new \DateTime());
        $user->setRole('ROLE_USER');

        $manager->persist($user);

        $manager->flush();
    }
}