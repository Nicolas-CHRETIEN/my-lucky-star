<?php

// namespace: pth of the Controller.

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MainController extends AbstractController {

    // ------------------- Home page. --------------------
    /**
    *
    * @Route("/", name = "home")
    */
    

    public function home() {
        return $this->render("home/home.html.twig");
    }


    // ------------------- Universe page. -------------------------

    /**
    *
    * @Route("/universe", name = "universe")
    */
    

    public function universe() {
        return $this->render("home/universe.html.twig");
    }




    // ----------------------- Galaxy page. ------------------------


    /**
    *
    * @Route("/galaxy", name = "galaxy")
    */
    

    public function galaxy() {
        return $this->render("home/galaxy.html.twig");
    }


    // -------------------------- Solar system page. -----------------------


    /**
    *
    * @Route("/solarSystem", name = "solar_system")
    */
    

    public function solarSystem() {
        return $this->render("home/solarSystem.html.twig");
    }
}