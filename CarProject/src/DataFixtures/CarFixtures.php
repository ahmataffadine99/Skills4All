<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\CarCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class CarFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        // Récupérer les catégories de voiture existantes depuis la base de données
        $categories = $manager->getRepository(CarCategory::class)->findAll();

        for ($i = 0; $i < 50; $i++) {
            $car = new Car();
            $car->setNbSeats($faker->numberBetween(2, 5));
            $car->setNbDoors($faker->numberBetween(2, 5));
            $car->setName($faker->word);
            $car->setCost($faker->randomFloat(2, 10000, 50000));

            // Associer une catégorie de voiture aléatoire à chaque voiture
            $randomCategory = $faker->randomElement($categories);
            $car->setCategory($randomCategory);

            $manager->persist($car);
        }

        $manager->flush();
    }
}

