<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/categorie", name="categorie")
     */
    public function index(Request $request)
    {
        // On établit la connexion a la DB via Doctrine
        $pdo = $this->getDoctrine()->getManager();

        /**
         * ->findOneBy(['id' => 2])
         * ->findBy(['nom' => 'Nom du produit'])
         */
        // On crée un élem de la classe catégorie
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        //
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // Form envoyé, on le save
            $pdo->persist($categorie);
            $pdo->flush();
            $this->addFlash("success", "Catégorie créée");
        }


        $categories = $pdo->getRepository(Categorie::class)->findAll();


        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
            'form_categorie_new' => $form->createView()
        ]);
    }

    /**
     * @Route("/categorie/{id}", name="show_categorie")
     */

    public function categorie(Request $request, Categorie $categorie = null) {
        if($categorie != null) {
            $form = $this->createForm(CategorieType::class, $categorie);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()) {
                $pdo=$this->getDoctrine()->getManager();
                $pdo->persist($categorie);
                $pdo->flush();
                $this->addFlash("success", "Catégorie modifiée");
            }
            return $this->render('categorie/categorie.html.twig', [
                'mycategorie' => $categorie,
                'form_categorie_change' => $form->createView()
            ]);
        }
        else {
            return $this->redirectToRoute('categorie');
        }
    }

        /**
     * @Route("/delCat/{id}", name="delete_categorie")
     */

    
    public function deleteRecord(Categorie $categorie = null) {
        if($categorie != null) {
            $pdo=$this->getDoctrine()->getManager();
            $pdo->remove($categorie);
            $pdo->flush();
            $this->addFlash("success", "Catégorie supprimée");
        }
        else {
            $this->addFlash("danger", "Catégorie introuvable");
        }
        return $this->redirectToRoute('categorie');
    }
}
