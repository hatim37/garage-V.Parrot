<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Images;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Faker\Provider\Fakecar;

class AppFixtures extends Fixture
{
   
    private Generator $faker;
   
    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager): void
    {
       
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));



        //Car
        for ($i=0; $i < 10; $i++) {
            $car = new Car();
            $car->setTitle($faker->vehicle())
                ->setPrice(mt_rand(5000, 12000))
                ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
                ->setKilometer(mt_rand(10000, 280000));
            $cars[] = $car;
            $manager->persist($car);
        }


        //images
        $image1 = 'annonce1.webp';
        $image2 = 'annonce2.webp';
        $image3 = 'annonce3.webp';
        $image4 = 'annonce4.webp';
        $image5 = 'annonce5.webp';
        $image6 = 'annonce6.webp';
        $image7 = 'annonce7.webp';
        $imageAnnonce = [$image1, $image2, $image3, $image4, $image5, $image6, $image7];


      $images = [];
      for ($i=0; $i < 50; $i++) {
          $image = new Images();
          $image->setName($imageAnnonce[mt_rand(0, count($imageAnnonce) - 1)])
          //$image->setName($this->faker->image())
          ->setCar($cars[mt_rand(0, count($cars) - 1)]);
          $images[] = $image;
          $manager->persist($image);
      }






        $manager->flush();
    }
}
