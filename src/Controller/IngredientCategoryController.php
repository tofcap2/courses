<?php

namespace App\Controller;

use App\Entity\IngredientCategory;
use App\Form\IngredientCategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ingredient/category")
 */
class IngredientCategoryController extends AbstractController
{
    /**
     * @Route("/", name="ingredient_category_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ingredientCategories = $this->getDoctrine()
            ->getRepository(IngredientCategory::class)
            ->findAll();

        return $this->render('ingredient_category/index.html.twig', [
            'ingredient_categories' => $ingredientCategories,
        ]);
    }

    /**
     * @Route("/new", name="ingredient_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ingredientCategory = new IngredientCategory();
        $form = $this->createForm(IngredientCategoryType::class, $ingredientCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ingredientCategory);
            $entityManager->flush();

            return $this->redirectToRoute('ingredient_category_index');
        }

        return $this->render('ingredient_category/new.html.twig', [
            'ingredient_category' => $ingredientCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_category_show", methods={"GET"})
     */
    public function show(IngredientCategory $ingredientCategory): Response
    {
        return $this->render('ingredient_category/show.html.twig', [
            'ingredient_category' => $ingredientCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ingredient_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IngredientCategory $ingredientCategory): Response
    {
        $form = $this->createForm(IngredientCategoryType::class, $ingredientCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ingredient_category_index', [
                'id' => $ingredientCategory->getId(),
            ]);
        }

        return $this->render('ingredient_category/edit.html.twig', [
            'ingredient_category' => $ingredientCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ingredient_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IngredientCategory $ingredientCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ingredientCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ingredientCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ingredient_category_index');
    }
}
