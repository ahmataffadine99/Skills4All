<?php

namespace App\DataFixtures;
use App\Entity\CarCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categories = ['Compact', 'SUV', 'Luxury'];

        foreach ($categories as $categoryName) {
            $category = new CarCategory();
            $category->setName($categoryName);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
