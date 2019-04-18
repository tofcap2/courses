<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Recipe;
use App\Entity\RecipeIngredient;
use App\Entity\RecipeSearch;
use App\Entity\Step;
use App\Form\RecipeSearchType;
use App\Form\RecipeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/recipe")
 */
class RecipeController extends BaseController
{
    /**
     * @Route("/", name="recipe_index", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function index(): Response
    {
        $recipes = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findAll();

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }

    /**
     * @Route("/new", name="recipe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recipe = new Recipe();
        $recipe->setUser($this->getUser());
//        $picture = new Picture();
//        $picture->setRecipe($this->getUser());
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render('recipe/new.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipe_show", methods={"GET"})
     */
    public function show(Recipe $recipe, Picture $picture, Step $step, RecipeIngredient $recipeIngredient): Response
    {
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'picture' => $picture,
            'step' => $step,
            'recipeIngredient' => $recipeIngredient
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recipe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Recipe $recipe): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recipe_index', [
                'id' => $recipe->getId(),
            ]);
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="recipe_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Recipe $recipe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($recipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('recipe_index');
    }

}
