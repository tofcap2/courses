<?php

namespace App\Controller;

use App\Entity\Picture;
use App\Entity\Recipe;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DefaultController extends BaseController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('default/home.html.twig', [
            'controller_name' => 'DefaultController'
        ]);
    }

    /**
     * @return mixed
     */
    public function recipe_picture()
    {
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->findAll();

        $picture = $this->getDoctrine()->getRepository(Picture::class)->findAll();

        return $this->render('default/homepage.html.twig',[
            "recipe" => $recipe,
            "picture" => $picture
        ]);
    }
}
