<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;

class ProduitController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request)
    {
        // On établit la connexion a la DB via Doctrine
        $pdo = $this->getDoctrine()->getManager();

        /**
         * ->findOneBy(['id' => 2])
         * ->findBy(['nom' => 'Nom du produit'])
         */

        // On crée un élem de la classe produit
        $produit = new Produit();
        //On associe au form produit l'objet de la classe produit créé précédemment
        $form = $this->createForm(ProduitType::class, $produit);
         //
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // Form envoyé, on le save
            $pdo->persist($produit);
            $pdo->flush();
        }

        // On pose une requête pour récupérer tous les éléments de la DB
        $produits = $pdo->getRepository(Produit::class)->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
            'form_produit_new' => $form->createView()
        ]);
    }

        /**
     * @Route("/produit/{id}", name="show_produit")
     */

    public function produit(Request $request, Produit $produit = null) {
        if($produit != null) {
            $form = $this->createForm(ProduitType::class, $produit);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()) {
                $pdo=$this->getDoctrine()->getManager();
                $pdo->persist($produit);
                $pdo->flush();
            }
            return $this->render('produit/produit.html.twig', [
                'myproduit' => $produit,
                'form_produit_change' => $form->createView()
            ]);
        }
        else {
            return $this->redirectToRoute('home');
        }
    }
    
        /**
     * @Route("/delCat/{id}", name="delete_produit")
     */


    public function deleteRecord(Produit $produit = null) {
        if($produit != null) {
            $pdo=$this->getDoctrine()->getManager();
            $pdo->remove($produit);
            $pdo->flush();
            return $this->redirectToRoute('home');
        }
        else {
            return $this->redirectToRoute('home');
        }

    }
}
