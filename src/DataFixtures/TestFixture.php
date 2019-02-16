<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Migrations\Version\Factory;
use App\Entity\Compteur;
use App\Entity\Abonnement;
use App\Entity\Facture;

class TestFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $fake = \Faker\Factory::create('fr_FR');


        for ($i=1; $i <10 ; $i++) { 
                    $compteur = new Compteur();
                    $compteur->setNumero($fake->randomNumber());
                    $manager->persist($compteur);

                    //On donne des abonnements a un compteur
            for ($j=1; $j < 2; $j++) { 
                $abonnement = new Abonnement();
                $abonnement->setContrat($fake->sentence())
                            ->setDate($fake->dateTime())
                            ->setCumulAnc($fake->randomFloat())
                            ->setCumulNouv($fake->randomFloat())
                            ->setCompteur($compteur);

                $manager->persist($abonnement);

                //On donne des factures a un abonnement
                for ($k=1; $k < mt_rand(4, 8); $k++) { 
                    $facture = new Facture();
                    $facture->setMois($fake->monthName())
                            ->setConsomation($fake->randomFloat())
                            ->setPrix($fake->randomDigit)
                            ->setReglement($fake->boolean())
                            ->setAbonnement($abonnement);

                    $manager->persist($facture);
                }
            }
        }


        $manager->flush();
    }
}
