<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Entity\Commande;
use App\Form\CommandeType;
use PHPUnit\TextUI\Command;
use App\Repository\MenuRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commandes", name="commandes", methods={"GET"})
     */
    public function listeCommandes(CommandeRepository $repo)
    {
        $commandes=$repo->findAll();
        return $this->render('commande/listeCommandes.html.twig', [
            'lesCommandes' => $commandes
        ]);
    }

    /**
     * @Route("/commande/ajout", name="commande_ajout", methods={"GET","POST"})
     * @Route("/commande/modif/{id}", name="commande_modif", methods={"GET","POST"})
     */
    public function ajoutModifCommande(Commande $commande=null, Request $request, EntityManagerInterface $manager)
    {
        if($commande == null){
            $commande=new Commande();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }
        $form=$this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($commande);
            $manager->flush();
            $this->addFlash("success","La commande a bien été $mode");
            return $this->redirectToRoute('commandes');
        }
        return $this->render('commande/formAjoutModifCommande.html.twig', [
            'formCommande' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/commande/suppression/{id}", name="commande_suppression", methods={"GET"})
     */
    public function suppressionCommande(Commande $commande, EntityManagerInterface $manager)
    {
        $manager->remove($commande);
        $manager->flush();
        $this->addFlash("success","La commande a bien été supprimé");
        return $this->redirectToRoute('commandes');
    }
}
