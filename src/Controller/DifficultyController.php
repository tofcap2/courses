<?php

namespace App\Controller;

use App\Entity\Difficulty;
use App\Form\DifficultyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/difficulty")
 */
class DifficultyController extends BaseController
{
    /**
     * @Route("/", name="difficulty_index", methods={"GET"})
     */
    public function index(): Response
    {
        $difficulties = $this->getDoctrine()
            ->getRepository(Difficulty::class)
            ->findAll();

        return $this->render('difficulty/index.html.twig', [
            'difficulties' => $difficulties,
        ]);
    }

    /**
     * @Route("/new", name="difficulty_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $difficulty = new Difficulty();
        $form = $this->createForm(DifficultyType::class, $difficulty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($difficulty);
            $entityManager->flush();

            return $this->redirectToRoute('difficulty_index');
        }

        return $this->render('difficulty/new.html.twig', [
            'difficulty' => $difficulty,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="difficulty_show", methods={"GET"})
     */
    public function show(Difficulty $difficulty): Response
    {
        return $this->render('difficulty/show.html.twig', [
            'difficulty' => $difficulty,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="difficulty_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Difficulty $difficulty): Response
    {
        $form = $this->createForm(DifficultyType::class, $difficulty);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('difficulty_index', [
                'id' => $difficulty->getId(),
            ]);
        }

        return $this->render('difficulty/edit.html.twig', [
            'difficulty' => $difficulty,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="difficulty_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Difficulty $difficulty): Response
    {
        if ($this->isCsrfTokenValid('delete'.$difficulty->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($difficulty);
            $entityManager->flush();
        }

        return $this->redirectToRoute('difficulty_index');
    }
}
