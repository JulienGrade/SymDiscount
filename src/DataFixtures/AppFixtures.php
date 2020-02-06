<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Ici je gère les produits
        for($i=1; $i <= 10; $i++){
            $faker = Factory::create();
            $product = new Product();

            $product->setName($faker->word)
                    ->setContent($faker->paragraph(4))
                    ->setPrice(mt_rand(99, 999))
                    ->setFavorite((bool)mt_rand(0,1))
                    ->setColor($faker->randomElements($array = array ('red','green','blue','orange','yellow'), $count = 2))
                    ->setCreatedAt($faker->dateTime($max = 'now', $timezone = null))
                    ->setImage('http://placehold.it/1000x400')
                    ->setDiscount($faker->numberBetween($min = 5, $max = 50));


            $manager->persist($product);

        }
        $manager->flush();
    }
}
