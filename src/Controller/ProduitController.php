<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{
    /**
     * @Route("/produit", name="app_produit")
     */
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }
    /**
     * @Route("/produit/add/{nom}/{prix}/{quantite}", name="app_produit_add")
     */
    public function add($nom,$prix,$quantite): Response
    {
        $produit=new Produit();
        $produit->setNom($nom);
        $produit->setPrix($prix);
        $produit->setQuantite($quantite);
        $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();
        
        return $this->render('produit/index.html.twig', [
            'produit' => $produit,
        ]);
    }
}
