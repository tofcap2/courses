<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Recipe;
use App\Entity\RecipeSearch;
use App\Form\RecipeSearchType;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @property RecipeRepository repository
 * @Route("/recipe")
 */
class RecipeController extends BaseController
{
    public function __construct(RecipeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="recipe_index", methods={"GET"})
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $search = new RecipeSearch();
        $form = $this->createForm(RecipeSearchType::class, $search);
        $form->handleRequest($request);

        $recipes = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1), 12);
//        $toto = $request->get('category');
//        dump($toto); die();

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
            'form'    => $form->createView(),
        ]);

    }

    /**
     * @Route("/new", name="recipe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $recipe = new Recipe();
        $recipe->setUser($this->getUser());
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
     * @param Recipe $recipe
     * @return Response
     */
    public function show(Recipe $recipe): Response
    {
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe
        ]);
    }

    /**
     * @Route("/{id}/edit", name="recipe_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Recipe $recipe
     * @return Response
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
