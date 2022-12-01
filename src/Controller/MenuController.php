<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
