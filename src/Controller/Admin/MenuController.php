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
     */
    public function ajoutMenu( Request $request, EntityManagerInterface $manager)
    {
        $menu=new Menu();
        $form=$this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() )
        {
            $manager->persist($menu);
            $manager->flush();
            return $this->redirectToRoute('admin_menus');
        }
        return $this->render('admin/menu/formAjoutMenu.html.twig', [
            'formMenu' => $form->createView()
        ]);
    }
}
