<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DefaultController extends BaseController
{

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->findLast(1);

        return $this->render('default/home.html.twig', [
            'recipe' => $recipe
        ]);
    }

}
