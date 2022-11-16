<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="app_test")
     */
    public function index(): Response
    {
        $etudiant = ["safa","selmen","emna","rim","rayen"];
        $classe  = "MDW3.1";
       
        return $this->render('test/test.html.twig', ["etuds" => $etudiant,"classe" =>  $classe  ]);
    }
    /**
     * @Route("/bonjour", name="app_bonjour")
     */
    public function bonjour(): Response
    {
        return $this->render('test/bonjour.html.twig', [
            'controller_name' => 'TestController:bonjour',
        ]);
    }
    /**
     * @Route("/{name}", name="app_accueil")
     */
    public function accueil($name): Response
    {
        return $this->render('test/accueil.html.twig', [
            'nom' => $name,
        ]);
    }
    /**
     * @Route("/somme/{nb1}/{nb2}", name="app_somme")
     */
    public function somme($nb1,$nb2): Response
    {
         
        $somme = $nb1 + $nb2;
        return $this->render('test/somme.html.twig', [
            'a' => $nb1,'b'=>$nb2,'som'=>$somme
        ]);
    }
     /**
     * @Route("/api/test", name="app_api_test")
     */
    public function apitest(): JsonResponse
    {
         
        
        return $this->json(['username' => 'jane.doe']);
    }
}
