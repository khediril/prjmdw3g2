<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categ = new Categorie();
        $categ->setNom('c1');
        $manager->persist($categ);
        $manager->flush();
        for ($i=0; $i < 20; $i++) { 
            $produit = new Produit();
            $produit->setNom("produit".$i);
            $produit->setPrix(mt_rand(1000,10000));
            $produit->setQuantite(mt_rand(10,100));
            $produit->setCategorie($categ);
            $manager->persist($produit);

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
