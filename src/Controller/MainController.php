<?php

// namespace: pth of the Controller.

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MainController extends AbstractController {

    
    /**
    *
    * @Route("/", name = "home")
    */
    

    public function home() {
        return $this->render("home.html.twig");
    }
}