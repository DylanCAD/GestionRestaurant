<?php

namespace App\Controller\Admin;

use App\Entity\Sauce;
use App\Form\SauceType;
use App\Repository\SauceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SauceController extends AbstractController
{
    /**
     * @Route("/admin/sauces", name="admin_sauces", methods={"GET"})
     */
    public function listeSauces(SauceRepository $repo)
    {
        $sauces=$repo->findAll();
        return $this->render('admin/sauce/listeSauces.html.twig', [
            'lesSauces' => $sauces
        ]);
    }

    /**
     * @Route("/admin/sauce/ajout", name="admin_sauce_ajout", methods={"GET","POST"})
     * @Route("/admin/sauce/modif/{id}", name="admin_sauce_modif", methods={"GET","POST"})
     */
    public function ajoutModifSauce(Sauce $sauce=null, Request $request, EntityManagerInterface $manager)
    {
        if($sauce == null){
            $sauce=new Sauce();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }
        $form=$this->createForm(SauceType::class, $sauce);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($sauce);
            $manager->flush();
            $this->addFlash("success","La sauce a bien été $mode");
            return $this->redirectToRoute('admin_sauces');
        }
        return $this->render('admin/sauce/formAjoutModifSauce.html.twig', [
            'formSauce' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/admin/sauce/suppression/{id}", name="admin_sauce_suppression", methods={"GET"})
     */
    public function suppressionSauce(Sauce $sauce, EntityManagerInterface $manager)
    {
        $manager->remove($sauce);
        $manager->flush();
        $this->addFlash("success","La sauce a bien été supprimé");
        return $this->redirectToRoute('admin_sauces');
    }
}
