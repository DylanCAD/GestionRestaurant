<?php

namespace App\Controller\Admin;

use App\Entity\Boisson;
use App\Form\BoissonType;
use App\Repository\BoissonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BoissonController extends AbstractController
{
    /**
     * @Route("/admin/boissons", name="admin_boissons", methods={"GET"})
     */
    public function listeBoissons(BoissonRepository $repo)
    {
        $boissons=$repo->findAll();
        return $this->render('admin/boisson/listeBoissons.html.twig', [
            'lesBoissons' => $boissons
        ]);
    }

    /**
     * @Route("/admin/boisson/ajout", name="admin_boisson_ajout", methods={"GET","POST"})
     * @Route("/admin/boisson/modif/{id}", name="admin_boisson_modif", methods={"GET","POST"})
     */
    public function ajoutModifBoisson(Boisson $boisson=null, Request $request, EntityManagerInterface $manager)
    {
        if($boisson == null){
            $boisson=new Boisson();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }
        $form=$this->createForm(BoissonType::class, $boisson);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($boisson);
            $manager->flush();
            $this->addFlash("success","La boisson a bien été $mode");
            return $this->redirectToRoute('admin_boissons');
        }
        return $this->render('admin/boisson/formAjoutModifBoisson.html.twig', [
            'formBoisson' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/admin/boisson/suppression/{id}", name="admin_boisson_suppression", methods={"GET"})
     */
    public function suppressionBoisson(Boisson $boisson, EntityManagerInterface $manager)
    {
        $manager->remove($boisson);
        $manager->flush();
        $this->addFlash("success","La boisson a bien été supprimée");
        return $this->redirectToRoute('admin_boissons');
    }
}
