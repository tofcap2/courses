<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\RecipeIngredient;
use App\Form\MenuType;
use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 * @property MenuRepository repository
 */
class MenuController extends BaseController
{
    /**
     * @Route("/menu/", name="menu_index", methods={"GET"})
     */
    public function index(): Response
    {
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findBy([ 'user' => $this->getUser() ]);

        //$recipe = $this->getDoctrine()->getRepository(Menu::class)->findAllIngredients($menus[1]->getId());

        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
            //'recipe' => $recipe,
        ]);
    }

    /**
     * @Route("/menu/new", name="menu_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($menu);
            $entityManager->flush();

            return $this->redirectToRoute('menu_index');
        }

        return $this->render('menu/new.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/menu/show", name="menu_show", methods={"GET"})
     * @param Menu $menu
     * @return Response
     */
    public function show(Menu $menu): Response
    {
        return $this->render('menu/show.html.twig', [
            'menu' => $menu,
        ]);
    }

    /**
     * @Route("/menu/{id}/edit", name="menu_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Menu $menu): Response
    {
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('menu_index', [
                'id' => $menu->getId(),
            ]);
        }

        return $this->render('menu/edit.html.twig', [
            'menu' => $menu,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/menu/{id}", name="menu_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Menu $menu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($menu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('menu_index');
    }


}
