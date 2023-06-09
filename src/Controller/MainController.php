<?php

// namespace: pth of the Controller.

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\StarsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MainController extends AbstractController {

    // ------------------- Home page. --------------------
    /**
    *
    * @Route("/", name = "app_home")
    */
    

    public function home() {
        return $this->render("home/home.html.twig");
    }


    // ------------------- Universe page. -------------------------

    /**
    *
    * @Route("/universe", name = "app_universe")
    */
    

    public function universe() {
        return $this->render("home/universe.html.twig");
    }



    // ----------------------- Describe the concept of the site. ---------------------------
    /**
    *
    * @Route("/concept", name = "app_concept")
    */

    public function concept(StarsRepository $repository): Response {

        $stars = $repository->findAll();

        return $this->render('concept/index.html.twig', ['stars' => $stars]);
    }


    

    // ----------------------- Galaxy page. ------------------------


    /**
    *
    * @Route("/galaxy", name = "app_galaxy")
    */
    

    public function galaxy() {
        return $this->render("home/galaxy.html.twig");
    }


    // -------------------------- Solar system page. -----------------------


    /**
    *
    * @Route("/solarSystem", name = "app_solar_system")
    */
    

    public function solarSystem() {
        return $this->render("home/solarSystem.html.twig");
    }

    // ----------------------- category stars. ---------------------------
    /**
    *
    * @Route("/starsType/category", name = "app_category")
    */

    public function category(StarsRepository $repository): Response {

        $stars = $repository->findAll();

        return $this->render('starsType/category.html.twig', ['stars' => $stars]);
    }

    // ----------------------- life duration stars. ---------------------------
    /**
    *
    * @Route("/starsType/life_duration", name = "app_life_duration")
    */

    public function life_duration(StarsRepository $repository): Response {

        $stars = $repository->findAll();

        return $this->render('starsType/lifeDuration.html.twig', ['stars' => $stars]);
    }

    // ----------------------- life end stars. ---------------------------
    /**
    *
    * @Route("/starsType/life_end", name = "app_life_end")
    */

    public function life_end(StarsRepository $repository): Response {

        $stars = $repository->findAll();

        return $this->render('starsType/lifeEnd.html.twig', ['stars' => $stars]);
    }

    // ----------------------- My account. ---------------------------
    /**
    *
    * @Route("/account/my_account", name = "app_my_account")
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    */

    public function my_account(StarsRepository $stars_repository, UserRepository $users_repository): Response {

        $stars = $stars_repository->findAll();
        $users = $users_repository->findAll();

        return $this->render('account/myAccount.html.twig', ['stars' => $stars, 'users' => $users]);
    }

    // ----------------------- user introduction account. ---------------------------
    /**
    *
    * @Route("/account/{id}", name = "app_account")
    */

    public function account($id, StarsRepository $stars_repository, UserRepository $users_repository): Response {

        $user = $users_repository->findOneById($id);
        $stars = $stars_repository->findAll();
        $users = $users_repository->findAll();

        return $this->render('account/index.html.twig', ['stars' => $stars, 'users' => $users, 'user' => $user]);
    }
}
