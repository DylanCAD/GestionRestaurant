<?php

namespace App\Controller\Admin;

use App\Entity\Accompagnement;
use App\Form\AccompagnementType;
use App\Repository\AccompagnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccompagnementController extends AbstractController
{
    /**
     * @Route("/admin/accompagnements", name="admin_accompagnements", methods={"GET"})
     */
    public function listeAccompagnements(AccompagnementRepository $repo)
    {
        $accompagnements=$repo->findAll();
        return $this->render('admin/accompagnement/listeAccompagnements.html.twig', [
            'lesAccompagnements' => $accompagnements
        ]);
    }

    /**
     * @Route("/admin/accompagnement/ajout", name="admin_accompagnement_ajout", methods={"GET","POST"})
     * @Route("/admin/accompagnement/modif/{id}", name="admin_accompagnement_modif", methods={"GET","POST"})
     */
    public function ajoutModifAccompagnement(Accompagnement $accompagnement=null, Request $request, EntityManagerInterface $manager)
    {
        if($accompagnement == null){
            $accompagnement=new Accompagnement();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }
        $form=$this->createForm(AccompagnementType::class, $accompagnement);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($accompagnement);
            $manager->flush();
            $this->addFlash("success","L' accompagnement a bien été $mode");
            return $this->redirectToRoute('admin_accompagnements');
        }
        return $this->render('admin/accompagnement/formAjoutModifAccompagnement.html.twig', [
            'formAccompagnement' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/admin/accompagnement/suppression/{id}", name="admin_accompagnement_suppression", methods={"GET"})
     */
    public function suppressionAccompagnement(Accompagnement $accompagnement, EntityManagerInterface $manager)
    {
        $manager->remove($accompagnement);
        $manager->flush();
        $this->addFlash("success","L'accompagnement a bien été supprimé");
        return $this->redirectToRoute('admin_accompagnements');
    }
}
