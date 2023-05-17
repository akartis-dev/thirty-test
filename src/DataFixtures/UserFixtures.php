<?php

namespace App\DataFixtures;

use App\Entity\Products;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $user = new User();
            $user->setFirstname($faker->firstName)
                ->setLastname($faker->lastName)
                ->setEmail("email$i@dev.com");
            $user->setPassword($this->passwordHasher->hashPassword($user, '12345678'));

            $manager->persist($user);
        }


        $manager->flush();
    }
}
