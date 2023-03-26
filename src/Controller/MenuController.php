<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Model\FiltreMenu;
use App\Form\FiltreMenuType;
use App\Repository\MenuRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController
{
    /**
     * @Route("/menus", name="menus", methods={"GET"})
     */
    public function listeMenus(MenuRepository $repo, PaginatorInterface $paginator, Request $request)
    {
        $filtre=new FiltreMenu();
        $formFiltreMenu=$this->createForm(FiltreMenuType::class, $filtre);
        $formFiltreMenu->handleRequest($request);
        $menus = $paginator->paginate(
            $repo->listeMenusCompletePaginee($filtre),
            $request->query->getInt('page', 1), 9
            );
        return $this->render('menu/listeMenus.html.twig', [
            'lesMenus' => $menus,
            'formFiltreMenu'=>$formFiltreMenu->createView()

        ]);
    }

    /**
     * @Route("/menu/{id}", name="ficheMenu", methods={"GET"})
     */
    public function ficheMenu(Menu $menu)
    {
        return $this->render('menu/ficheMenu.html.twig', [
            'leMenu' => $menu
        ]);
    }
}
