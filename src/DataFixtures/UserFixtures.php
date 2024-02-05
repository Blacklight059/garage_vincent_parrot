<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

use Faker;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
    ){}

    public function load(ObjectManager $manager): void
    {
        $admin = new Admin();
        $admin->setEmail('admin@admin.fr');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setLastname('PARROT');
        $admin->setFirstname('Vincent');

        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $userTest = new Employee();
        $userTest->setEmail('steven_gomes@hotmail.fr');
        $userTest->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'steven')
        );
        $userTest->setLastname('GOMES');
        $userTest->setFirstname('Steven');

        $userTest->setRoles(['ROLE_USER']);
        $manager->persist($userTest);

        $faker = Faker\Factory::create('fr-FR');

        for($usr2 = 1; $usr2 <= 5; $usr2++) {
            $user = new Employee();
            $user->setEmail($faker->email);
            $user->setLastname($faker->lastName);
            $user->setFirstname($faker->firstName);
            $user->setPassword(
            $this->passwordEncoder->hashPassword($user, 'secretPatient')
            );
            $user->setRoles(['ROLE_USER']);
            $manager->persist($user);

        }

        $manager->flush();
    }
}
