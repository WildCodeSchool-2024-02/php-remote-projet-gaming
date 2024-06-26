<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    // public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    // {
    // }

    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $password = 'password012345';
        $user->setEmail("gaming@gmail.com");
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));
        $manager->persist($user);
        $manager->flush();

        $admin = new User();
        $password = 'password012345';
        $admin->setEmail("admin@gmail.com");
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordHasher->hashPassword($admin, $password));
        $manager->persist($admin);
        $manager->flush();
    }
}
