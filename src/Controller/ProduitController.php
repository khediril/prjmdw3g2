<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/produit/add2", name="app_produit_add2")
     */
    public function add2(Request $request): Response
    {
        $produit=new Produit();

        $form = $this->createForm(ProduitType::class, $produit);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $produit = $form->getData();
            $this->getDoctrine()
            ->getRepository(Produit::class)->save($produit,true);
            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_produit_list');
        }


        return $this->renderForm('produit/add2.html.twig', [
            'monform' => $form,
        ]);
       /* $produit->setNom($nom);
        $produit->setPrix($prix);
        $produit->setQuantite($quantite);
        $this->getDoctrine()
            ->getRepository(Produit::class)->save($produit,true);*/
      /*  $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();*/
        
     /*   return $this->render('produit/index.html.twig', [
            'produit' => $produit,
        ]);*/
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
        $this->getDoctrine()
            ->getRepository(Produit::class)->save($produit,true);
      /*  $em = $this->getDoctrine()->getManager();
        $em->persist($produit);
        $em->flush();*/
        
        return $this->render('produit/index.html.twig', [
            'produit' => $produit,
        ]);
    }
     /**
     * @Route("/produit/list", name="app_produit_list")
     */
    public function list(): Response
    {
      $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
       // dd($produits);
        return $this->render('produit/list.html.twig', ['produits'=>$produits]);
    }
     /**
     * @Route("/produit/detail/{id}", name="app_produit_details")
     */

    public function detail($id,ProduitRepository $repo): Response
    {
        $repo = $this->getDoctrine()->getRepository(Produit::class);
  
        $produit = $repo->find($id);
        //$produit = $this->getDoctrine()
      //      ->getRepository(Produit::class)
      //      ->find($id);
       // dd($produits);
        return $this->render('produit/detail.html.twig', ['p'=>$produit]);
    }
     /**
     * @Route("/produit/delete/{id}", name="app_produit_delete")
     */

    public function delete($id,ProduitRepository $repo): Response
    {
        $produit = $repo->find($id);
        if($produit)
        {
            $repo->remove($produit,true);
        }
        return $this->redirectToRoute('app_produit_list');  
       // return $this->render('produit/delete.html.twig', ['p'=>$produit]);
    }
     /**
     * @Route("/produit/update/{id}/{price}", name="app_produit_update")
     */

    public function update($id,$price,ProduitRepository $repo): Response
    {
        $produit = $repo->find($id);
        

        if($produit)
        {
            $produit->setPrix($price);
            $repo->save($produit,true);
        } 

        return $this->redirectToRoute('app_produit_list');
    }
    
}
