<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $product = new Products();
            $product->setName($faker->words(2, true))
                ->setDescription($faker->paragraphs($faker->numberBetween(3, 8), true))
                ->setPrice($faker->numberBetween(10, 1000));

            $manager->persist($product);
        }


        $manager->flush();
    }
}
