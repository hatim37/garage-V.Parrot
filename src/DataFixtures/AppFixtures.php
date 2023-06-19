<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Comment;
use App\Entity\Contact;
use App\Entity\Equipment;
use App\Entity\Hourly;
use App\Entity\Images;
use App\Entity\Information;
use App\Entity\Service;
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
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
       
        $faker = (new \Faker\Factory())::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));


        //Type
        $type1 = 'Berline';
        $type2 = 'Break';
        $type3 = 'Monospace';
        $type4 = 'Cabriolet';
        $types = [$type1, $type2, $type3, $type4];

        //d$doors        
        $fiscalPower1 = 6;
        $fiscalPower2 = 7;
        $fiscalPower3 = 8;
        $fiscalPower4 = 9;
        $fiscalPower5 = 10;
        $fiscalPowers = [$fiscalPower1, $fiscalPower2, $fiscalPower3, $fiscalPower4, $fiscalPower5];

        //NombreOfDoor
        $door1 = 3;
        $door2 = 5;
        $doors = [$door1, $door2];

        //fuel
        $fuel1 = 'Diesel';
        $fuel2 = 'Electrique';
        $fuel3 = 'Essence';
        $fuel4 = 'GPL';
        $fuels = [$fuel1, $fuel2, $fuel3, $fuel4];

        //Couleur
        $color1 = 'Blanc';
        $color2 = 'Vert';
        $color3 = 'Gris';
        $color4 = 'Noir';
        $color4 = 'Rouge';
        $colors = [$color1, $color2, $color3, $color4];


        //realPower
        $color1 = 'Blanc';
        $color2 = 'Vert';
        $color3 = 'Gris';
        $color4 = 'Noir';
        $color4 = 'Rouge';
        $colors = [$color1, $color2, $color3, $color4];

        //realPower
        $realPower1 = 110;
        $realPower2 = 120;
        $realPower3 = 130;
        $realPower4 = 140;
        $realPower5 = 150;
        $realPower6 = 160;
        $realPower7 = 170;
        $realPower8 = 180;
        $realPowers = [$realPower1, $realPower2, $realPower3, $realPower4, $realPower5, $realPower6, $realPower7, $realPower8];

        //numberOfPlace
        $place1 = 5;
        $place2 = 7;
        $place3 = 9;
        $places = [$place1, $place2, $place3];

        //emission
        $emission1 = '99 g/km (Classe A)';
        $emission2 = '119 g/km (Classe B)';
        $emission3 = '139 g/km (Classe C)';
        $emission4 = '141 g/km (Classe D)';
        $emission5 = '223 g/km (Classe F)';
        $emissions = [$emission1, $emission2, $emission3, $emission4, $emission5];


        //gearbox
        $gearbox1 = 'Manuelle';
        $gearbox2 = 'Automatique';
        $gearbox3 = 'Manuelle séquent.';
        $gearbox = [$gearbox1, $gearbox2, $gearbox3];

    //  //cars

    $car1 = new Car();
    $car1->setTitle('Land Rover Defender')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars1[] = $car1;
        $manager->persist($car1);//
 
    $car2 = new Car();
    $car2->setTitle('BMW M4')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars2[] = $car2;
        $manager->persist($car2);//
     
    $car3 = new Car();
    $car3->setTitle('Land Rover Evoque')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars3[] = $car3;
        $manager->persist($car3);
    
    $car4 = new Car();
    $car4->setTitle('Mercedes Cabriolet SL400')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars4[] = $car4;
        $manager->persist($car4);
   
    $car5 = new Car();
    $car5->setTitle('BMW M4')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars5[] = $car5;
        $manager->persist($car5);
     
    $car6 = new Car();
    $car6->setTitle('Peugeot 308 Coupé Cabriolet')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars6[] = $car6;
        $manager->persist($car6);
     
    $car7 = new Car();
    $car7->setTitle('BMW M3 Coupé')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars7[] = $car7;
        $manager->persist($car7);
     
    $car8 = new Car();
    $car8->setTitle('Mercedes GLE 300d 4MATIC')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars8[] = $car8;
        $manager->persist($car8);
     
    $car9 = new Car();
    $car9->setTitle('Mercedes CLA 220 CDI')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars9[] = $car9;
        $manager->persist($car9);
      
   $car10 = new Car();
   $car10->setTitle('Jaguar F-Type R')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars10[] = $car10;
        $manager->persist($car10);
    
   $car11 = new Car();
   $car11->setTitle('Mercedes S500 Cabriolet')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars11[] = $car11;
        $manager->persist($car11);
   
    $car12 = new Car();
    $car12->setTitle('Mercedes Cabriolet')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars12[] = $car12;
        $manager->persist($car12);
    
    $car13 = new Car();
    $car13->setTitle('Ferrari')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars13[] = $car13;
        $manager->persist($car13);
      
    $car14 = new Car();
    $car14->setTitle('Audi R8 Cabriolet')
        ->setPrice(mt_rand(10000, 20000))
        ->setYear($this->faker->dateTimeBetween($startDate = '-15 years', $endDate = '0 years', $timezone = null))
        ->setKilometer(mt_rand(10000, 280000))
        ->setType($types[mt_rand(0, count($types) - 1)])
        ->setFiscalPower($fiscalPowers[mt_rand(0, count($fiscalPowers) - 1)])
        ->setNumberOfDoor($doors[mt_rand(0, count($doors) - 1)])
        ->setFuel($fuels[mt_rand(0, count($fuels) - 1)])
        ->setColor($colors[mt_rand(0, count($colors) - 1)])
        ->setRealPower($realPowers[mt_rand(0, count($realPowers) - 1)])
        ->setNumberOfPlace($places[mt_rand(0, count($places) - 1)])
        ->setEmission($emissions[mt_rand(0, count($emissions) - 1)])
        ->setGearbox($gearbox[mt_rand(0, count($gearbox) - 1)]);
        $cars14[] = $car14;
        $manager->persist($car14);

        $cars =[$car1, $car2, $car3, $car4, $car5, $car6, $car7, $car8, $car9, $car10,
        $car11, $car12, $car13, $car14];

        


        //Images
      $images = [];
     
        $image1 = new Images();
        $image1->setName('annonce1.jpg')
        ->setCar($cars1[mt_rand(0, count($cars1) - 1)]);
        $manager->persist($image1);
        $image2 = new Images();
        $image2->setName('annonce2.jpg')
        ->setCar($cars1[mt_rand(0, count($cars1) - 1)]);
        $manager->persist($image2);
        $image3 = new Images();
        $image3->setName('annonce3.jpg')
        ->setCar($cars1[mt_rand(0, count($cars1) - 1)]);
        $manager->persist($image3);
        $image4 = new Images();
        $image4->setName('annonce4.jpg')
        ->setCar($cars2[mt_rand(0, count($cars2) - 1)]);
        $manager->persist($image4);
        $image5 = new Images();
        $image5->setName('annonce5.jpg')
        ->setCar($cars2[mt_rand(0, count($cars2) - 1)]);
        $manager->persist($image5);
        $image6 = new Images();
        $image6->setName('annonce6.jpg')
        ->setCar($cars2[mt_rand(0, count($cars2) - 1)]);
        $manager->persist($image6);
        $image7 = new Images();
        $image7->setName('annonce7.jpg')
        ->setCar($cars3[mt_rand(0, count($cars3) - 1)]);
        $manager->persist($image7);
        $image8 = new Images();
        $image8->setName('annonce8.jpg')
        ->setCar($cars3[mt_rand(0, count($cars3) - 1)]);
        $manager->persist($image8);
        $image9 = new Images();
        $image9->setName('annonce9.jpg')
        ->setCar($cars3[mt_rand(0, count($cars3) - 1)]);
        $manager->persist($image9);
        $image10 = new Images();
        $image10->setName('annonce10.jpg')
        ->setCar($cars4[mt_rand(0, count($cars4) - 1)]);
        $manager->persist($image10);
        $image11 = new Images();
        $image11->setName('annonce11.jpg')
        ->setCar($cars4[mt_rand(0, count($cars4) - 1)]);
        $manager->persist($image11);
        $image12 = new Images();
        $image12->setName('annonce12.jpg')
        ->setCar($cars4[mt_rand(0, count($cars4) - 1)]);
        $manager->persist($image12);
        $image13 = new Images();
        $image13->setName('annonce13.jpg')
        ->setCar($cars5[mt_rand(0, count($cars5) - 1)]);
        $manager->persist($image13);
        $image14 = new Images();
        $image14->setName('annonce14.jpg')
        ->setCar($cars5[mt_rand(0, count($cars5) - 1)]);
        $manager->persist($image14);
        $image15 = new Images();
        $image15->setName('annonce15.jpg')
        ->setCar($cars5[mt_rand(0, count($cars5) - 1)]);
        $manager->persist($image15);    
        $image16 = new Images();
        $image16->setName('annonce16.jpg')
        ->setCar($cars6[mt_rand(0, count($cars6) - 1)]);
        $manager->persist($image16);
        $image17 = new Images();
        $image17->setName('annonce17.jpg')
        ->setCar($cars6[mt_rand(0, count($cars6) - 1)]);
        $manager->persist($image17);
        $image18 = new Images();
        $image18->setName('annonce18.jpg')
        ->setCar($cars6[mt_rand(0, count($cars6) - 1)]);
        $manager->persist($image18);
        $image19 = new Images();
        $image19->setName('annonce19.jpg')
        ->setCar($cars7[mt_rand(0, count($cars7) - 1)]);
        $manager->persist($image19);
        $image20 = new Images();
        $image20->setName('annonce20.jpg')
        ->setCar($cars7[mt_rand(0, count($cars7) - 1)]);
        $manager->persist($image20);
        $image21 = new Images();
        $image21->setName('annonce21.jpg')
        ->setCar($cars7[mt_rand(0, count($cars7) - 1)]);
        $manager->persist($image21);
        $image22 = new Images();
        $image22->setName('annonce22.jpg')
        ->setCar($cars8[mt_rand(0, count($cars8) - 1)]);
        $manager->persist($image22);
        $image23 = new Images();
        $image23->setName('annonce23.jpg')
        ->setCar($cars8[mt_rand(0, count($cars8) - 1)]);
        $manager->persist($image23);
        $image24 = new Images();
        $image24->setName('annonce24.jpg')
        ->setCar($cars8[mt_rand(0, count($cars8) - 1)]);
        $manager->persist($image24);
        $image25 = new Images();
        $image25->setName('annonce25.jpg')
        ->setCar($cars9[mt_rand(0, count($cars9) - 1)]);
        $manager->persist($image25);
        $image26 = new Images();
        $image26->setName('annonce26.jpg')
        ->setCar($cars9[mt_rand(0, count($cars9) - 1)]);
        $manager->persist($image26);
        $image27 = new Images();
        $image27->setName('annonce27.jpg')
        ->setCar($cars9[mt_rand(0, count($cars9) - 1)]);
        $manager->persist($image27);
        $image28 = new Images();
        $image28->setName('annonce28.jpg')
        ->setCar($cars10[mt_rand(0, count($cars10) - 1)]);
        $manager->persist($image28);
        $image29 = new Images();
        $image29->setName('annonce29.jpg')
        ->setCar($cars10[mt_rand(0, count($cars10) - 1)]);
        $manager->persist($image29);
        $image30 = new Images();
        $image30->setName('annonce30.jpg')
        ->setCar($cars10[mt_rand(0, count($cars10) - 1)]);
        $manager->persist($image30);
        $image31 = new Images();
        $image31->setName('annonce31.jpg')
        ->setCar($cars11[mt_rand(0, count($cars11) - 1)]);
        $manager->persist($image31);
        $image32 = new Images();
        $image32->setName('annonce32.jpg')
        ->setCar($cars11[mt_rand(0, count($cars11) - 1)]);
        $manager->persist($image32);
        $image33 = new Images();
        $image33->setName('annonce33.jpg')
        ->setCar($cars11[mt_rand(0, count($cars11) - 1)]);
        $manager->persist($image33);
        $image34 = new Images();
        $image34->setName('annonce34.jpg')
        ->setCar($cars12[mt_rand(0, count($cars12) - 1)]);
        $manager->persist($image34);
        $image35 = new Images();
        $image35->setName('annonce35.jpg')
        ->setCar($cars12[mt_rand(0, count($cars12) - 1)]);
        $manager->persist($image35);
        $image36 = new Images();
        $image36->setName('annonce36.jpg')
        ->setCar($cars12[mt_rand(0, count($cars12) - 1)]);
        $manager->persist($image36);
        $image37 = new Images();
        $image37->setName('annonce37.jpg')
        ->setCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($image37);
        $image38 = new Images();
        $image38->setName('annonce38.jpg')
        ->setCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($image38);
        $image39 = new Images();
        $image39->setName('annonce39.jpg')
        ->setCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($image39);
        $image40 = new Images();
        $image40->setName('annonce40.jpg')
        ->setCar($cars14[mt_rand(0, count($cars14) - 1)]);
        $manager->persist($image40);
        $image41 = new Images();
        $image41->setName('annonce41.jpg')
        ->setCar($cars14[mt_rand(0, count($cars14) - 1)]);
        $manager->persist($image41);
        $image42 = new Images();
        $image42->setName('annonce42.jpg')
        ->setCar($cars14[mt_rand(0, count($cars14) - 1)]);
        $manager->persist($image42);


        //Equipment

        $equipment1 = new Equipment();
        $equipment1->setName('Direction assistée')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment1);
        $equipment2 = new Equipment();
        $equipment2->setName('ESP')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment2);
        $equipment3 = new Equipment();
        $equipment3->setName('Jantes Alu')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment3);
        $equipment4 = new Equipment();
        $equipment4->setName('Ordinateur de bord')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment4);
        $equipment5 = new Equipment();
        $equipment5->setName('Régulateur de vitesse')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment5);
        $equipment6 = new Equipment();
        $equipment6->setName('Sellerie cuir')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment6);
        $equipment7 = new Equipment();
        $equipment7->setName('ABS')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment7);
        $equipment8 = new Equipment();
        $equipment8->setName('Détecteur de pluie')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment8);
        $equipment9 = new Equipment();
        $equipment9->setName('Limiteur de vitesse')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment9);
        $equipment10 = new Equipment();
        $equipment10->setName('Détecteur de sous-gonflage')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment10);
        $equipment11 = new Equipment();
        $equipment11->setName('Volant multifonction')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment11);
        $equipment12 = new Equipment();
        $equipment12->setName('Ecran tactile')
        ->addCar($cars1[mt_rand(0, count($cars1) - 1)])
        ->addCar($cars2[mt_rand(0, count($cars2) - 1)])
        ->addCar($cars3[mt_rand(0, count($cars3) - 1)])
        ->addCar($cars4[mt_rand(0, count($cars4) - 1)])
        ->addCar($cars5[mt_rand(0, count($cars5) - 1)])
        ->addCar($cars6[mt_rand(0, count($cars6) - 1)])
        ->addCar($cars7[mt_rand(0, count($cars7) - 1)])
        ->addCar($cars8[mt_rand(0, count($cars8) - 1)])
        ->addCar($cars9[mt_rand(0, count($cars9) - 1)])
        ->addCar($cars10[mt_rand(0, count($cars10) - 1)])
        ->addCar($cars11[mt_rand(0, count($cars11) - 1)])
        ->addCar($cars12[mt_rand(0, count($cars12) - 1)])
        ->addCar($cars13[mt_rand(0, count($cars13) - 1)]);
        $manager->persist($equipment12);

        $equipments = [$equipment1, $equipment2, $equipment3, $equipment4, $equipment5, 
        $equipment6, $equipment7, $equipment8, $equipment9, $equipment10, $equipment11, $equipment12];
        


        //Service

        $service1 = new Service();
        $service1->setName('Entretien');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Vidange');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Diagnostic');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Réparation');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Pneumatique');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Pare-brise');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Climatisation');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Dépannage');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Réparation d’embrayage');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Révision moteur');
        $manager->persist($service1);

        $service1 = new Service();
        $service1->setName('Distribution');
        $manager->persist($service1);
//
   
        //information

        $information = new Information;
        $information->setName('Garage V.Parrot')
            ->setPhone($this->faker->phoneNumber())
            ->setEmail('v.parrot@garage.com')
            ->setstreet($this->faker->streetAddress())
            ->setcity($this->faker->postcode().' '.$this->faker->city());
            $manager->persist($information);
        
        //horaire
        $horaire1 = new Hourly;
        $horaire1->setDay('Lundi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setTimeStartAfternoon('14h')
         ->setTimeEndAfternoon('18h');
         $manager->persist($horaire1);

         $horaire2 = new Hourly;
        $horaire2->setDay('Mardi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setTimeStartAfternoon('14h')
         ->setTimeEndAfternoon('18h');
         $manager->persist($horaire2);

         $horaire3 = new Hourly;
         $horaire3->setDay('Mercredi')
          ->setTimeStartMorning('09h')
          ->setTimeEndMorning('12h')
          ->setTimeStartAfternoon('14h')
          ->setTimeEndAfternoon('18h');
          $manager->persist($horaire3);

          $horaire4 = new Hourly;
        $horaire4->setDay('Jeudi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setTimeStartAfternoon('14h')
         ->setTimeEndAfternoon('18h');
         $manager->persist($horaire4);

         $horaire5 = new Hourly;
        $horaire5->setDay('Vendredi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setTimeStartAfternoon('14h')
         ->setTimeEndAfternoon('18h');
         $manager->persist($horaire5);

         $horaire6 = new Hourly;
        $horaire6->setDay('Samedi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setCloseAfternoon(true);
         $manager->persist($horaire6);

         $horaire6 = new Hourly;
        $horaire6->setDay('Dimanche')
         ->setCloseMorning(true)
         ->setCloseAfternoon(true);
         $manager->persist($horaire6);


         //comment

        $comments =[];
        for ($i=0; $i < 10; $i++) {
            $comment = new Comment();
            $comment->setName($this->faker->name())
                ->setMessage($this->faker->realText())
                ->setNote(mt_rand(1, 5))
                ->setIsApproved(mt_rand(0, 1) === 0 ? 'Non' : 'Oui');


            $comments[] = $comment;
            $manager->persist($comment);
        }

        //Contact
        $contacts =[];
        for ($i=0; $i < 10; $i++) {
            $contact = new Contact();
            $contact->setName($this->faker->lastName())
                ->setFirstName($this->faker->firstName())
                ->setAddress($this->faker->address())
                ->setMessage($this->faker->realText())
                ->setEmail($this->faker->email())
                ->setPhone($this->faker->phoneNumber());

            $contacts[] = $contact;
            $manager->persist($contact);
        }
        


        $manager->flush();
   }
}