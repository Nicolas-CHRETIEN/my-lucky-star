<?php

namespace App\Controller;


use App\Entity\Stars;

// Import the repository to be able to use it as an argument in the public function.
use App\Repository\StarsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StarsController extends AbstractController {
    /**
     * @Route("/stars", name="app_stars")
     */

    public function index(StarsRepository $repository): Response {

        // Add the repository in argument of the function is the same than if we use the get repository method to select datas from Stars class:
        // $repository = $this->getDoctrine()->getRepository(Stars::class);

        $stars = $repository->findAll();



        return $this->render('stars/index.html.twig', ['stars' => $stars]);
    }

    /**
    *
    * @Route("/concept", name = "app_concept")
    */

    public function concept(StarsRepository $repository): Response {

        $stars = $repository->findAll();

        return $this->render('concept/index.html.twig', ['stars' => $stars]);
    }
    

    /**
     * Use a route with a parameter to send differents informations in function of the name of the route.
     * @Route("/stars/{title}", name="app_stars_distance")
     * 
     * 
     */

     public function knowMore($title, StarsRepository $repository): Response {

        // I select the informations corresponding to the title.
        // Below I use the findOneByX selection. I make title to send the corresponding datas corresponding to the title in the shape of an array.

        $star = $repository->findOneByTitle($title);
        return $this->render('stars/knowMore.html.twig', ['star' => $star]);
    }


    /**
    *
    * @Route("/starsType/{type}", name = "app_starsType")
    */

    public function starsType($type, StarsRepository $repository): Response {

        $stars = $repository->findAll();

        return $this->render('starsType/category.html.twig', ['stars' => $stars]);
        return $this->render('starsType/number.html.twig', ['stars' => $stars]);
        return $this->render('starsType/lifeDuration.html.twig', ['stars' => $stars]);
        return $this->render('starsType/lifeEnd.html.twig', ['stars' => $stars]);
    }

}