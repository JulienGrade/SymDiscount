<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $genres = ['male', 'female'];

        // Ici on gère les utilisateurs

        $users =[];
        for($i =1; $i <=20; $i++) {
            $user = new User();

            $genre = $faker->randomElement($genres);

            $picture = 'https://randomuser.me/api/portraits/';
            $pictureId = $faker->numberBetween(1, 99) . '.jpg';

            $picture .= ($genre == 'male' ? 'men/' : 'women/') . $pictureId;

            $hash = $this->encoder->encodePassword($user, 'password');

            $user->setFirstName($faker->firstName($genre))
                 ->setLastName($faker->lastName)
                 ->setEmail($faker->email)
                 ->setPicture($picture)
                 ->setIntroduction($faker->sentence())
                 ->setHash($hash);

            $manager->persist($user);
            $users[] = $user;
        }


        // Ici je gère les produits
        for($i=1; $i <= 10; $i++){

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
