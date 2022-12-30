<?php

namespace App\Controller\Admin;

use App\Repository\MenuRepository;
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
}
