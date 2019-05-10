<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\RecipeIngredient;
use App\Form\MenuType;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menu")
 */
class MenuController extends BaseController
{
    /**
     * @Route("/", name="menu_index", methods={"GET"})
     */
    public function index(): Response
    {
        $menus = $this->getDoctrine()
            ->getRepository(Menu::class)
            ->findBy([ 'user' => $this->getUser() ]);

        $recipe = $this->getDoctrine()->getRepository(Menu::class)->findByIngredient();

        return $this->render('menu/index.html.twig', [
            'menus' => $menus,
            'recipe' => $recipe,
        ]);
    }

    /**
     * @Route("/new", name="menu_new", methods={"GET","POST"})
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
     * @Route("/show", name="menu_show", methods={"GET"})
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
     * @Route("/{id}/edit", name="menu_edit", methods={"GET","POST"})
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
     * @Route("/{id}", name="menu_delete", methods={"DELETE"})
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


    /**
     * @Route("/", name="vuecourse", methods="GET")
     * @param Menu $menu
     * @return Response
     */
    public function vuecourse(Menu $menu)
    {
        //$ingredient = $this->getDoctrine()->getRepository(Menu::class)->editcourse(['menu' => $menu]);


        return $this->render('vuecourse.html.twig', ['recipeIngredients' => $recipeIngredients, 'menu' => $menu]);
    }

}
