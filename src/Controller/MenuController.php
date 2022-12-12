<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/menus", name="menus", methods={"GET"})
     */
    public function listeMenus(MenuRepository $repo)
    {
        $menus=$repo->findAll();
        return $this->render('menu/listeMenus.html.twig', [
            'lesMenus' => $menus
        ]);
    }

    /**
     * @Route("/menu/{id}", name="ficheMenu", methods={"GET"})
     */
    public function ficheMenu(Menu $menu)
    {
        return $this->render('menu/ficheMenu.html.twig', [
            'lesMenus' => $menu
        ]);
    }
}
