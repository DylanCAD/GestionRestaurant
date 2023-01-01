<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/admin/menus", name="admin_menus", methods={"GET"})
     */
    public function listeMenus(MenuRepository $repo)
    {
        $menus=$repo->findAll();
        return $this->render('admin/menu/listeMenus.html.twig', [
            'lesMenus' => $menus
        ]);
    }

    /**
     * @Route("/admin/menu/ajout", name="admin_menu_ajout", methods={"GET","POST"})
     * @Route("/admin/menu/modif/{id}", name="admin_menu_modif", methods={"GET","POST"})
     */
    public function ajoutModifMenu(Menu $menu=null, Request $request, EntityManagerInterface $manager)
    {
        if($menu == null){
            $menu=new Menu();
            $mode="ajouté";
        }else{
            $mode="modifié";
        }
        $form=$this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($menu);
            $manager->flush();
            $this->addFlash("success","Le menu a bien été $mode");
            return $this->redirectToRoute('admin_menus');
        }
        return $this->render('admin/menu/formAjoutModifMenu.html.twig', [
            'formMenu' => $form->createView()
            
        ]);
    }

    /**
     * @Route("/admin/menu/suppression/{id}", name="admin_menu_suppression", methods={"GET"})
     */
    public function suppressionMenu(Menu $menu, EntityManagerInterface $manager)
    {
        $manager->remove($menu);
        $manager->flush();
        $this->addFlash("success","Le menu a bien été supprimé");
        return $this->redirectToRoute('admin_menus');
    }
}
