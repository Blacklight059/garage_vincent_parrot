<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Energy;
use App\Entity\Hours;
use App\Entity\Option;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $hoursday1 = new Hours();
        $hoursday1->setOpen("Lundi au vendredi de 8h30 à 12h00 et de 13h00 à 18h00");
        $hoursday2 = new Hours();
        $hoursday2->setOpen("Samedi de 9h00 à 18h00");        
        $hoursday3 = new Hours();
        $hoursday3->setOpen("Dimanche et jours fériés fermés");

        $option1 = new Option();
        $option1->setName("Écran tactile");
        $option2 = new Option();
        $option2->setName("Prise(s) USB");        
        $option3 = new Option();
        $option3->setName("Sellerie en cuir");

        $brand1 = new Brand();
        $brand1->setName("Toyota");
        $brand2 = new Brand();
        $brand2->setName("Renault");        
        $brand3 = new Brand();
        $brand3->setName("Lexus");
        $brand4 = new Brand();
        $brand4->setName("Tesla");

        $energy1 = new Energy();
        $energy1->setName("hybride");
        $energy2 = new Energy();
        $energy2->setName("Essence");        
        $energy3 = new Energy();
        $energy3->setName("Electrique");

        $manager->persist($hoursday1);
        $manager->persist($hoursday2);
        $manager->persist($hoursday3);
        $manager->persist($option1);
        $manager->persist($option2);
        $manager->persist($option3);
        $manager->persist($brand1);
        $manager->persist($brand2);
        $manager->persist($brand3);
        $manager->persist($brand4);
        $manager->persist($energy1);
        $manager->persist($energy2);
        $manager->persist($energy3);

        $manager->flush();
    }
}
