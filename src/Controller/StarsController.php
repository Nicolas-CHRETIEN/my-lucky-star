<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Stars;
use App\Entity\Images;
use App\Form\ImageType;
use App\Form\CreateStarType;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\StarsRepository;
use App\Repository\ImagesRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class StarsController extends AbstractController {

    // ----------------------- Select the datas from the DB and pass them to the products page. ---------------------------
    /**
     * @Route("/page/{page}/filter/{filter}/stars", name="")
     */

    // public function index($page, $filter, StarsRepository $star_repository): Response {

    //     // Add the repository in argument of the function is the same than if we use the get repository method to select datas from Stars class:
    //     // $repository = $this->getDoctrine()->getRepository(Stars::class);
        
        
    //     if ($filter == "red" || $filter == "yellow" || $filter == "white" || $filter == "blue") {
    //         $allStars = $star_repository->findBy(['image' => ['/images/stars/' . $filter . '/image1.jpg',
    //                                                         '/images/stars/' . $filter . '/image2.jpg',
    //                                                         '/images/stars/' . $filter . '/image3.jpg',
    //                                                         '/images/stars/' . $filter . '/image4.jpg',
    //                                                         '/images/stars/' . $filter . '/image5.jpg',
    //                                                         '/images/stars/' . $filter . '/image6.jpg',
    //                                                         '/images/stars/' . $filter . '/image7.jpg',
    //                                                         '/images/stars/' . $filter . '/image8.jpg',
    //                                                         '/images/stars/' . $filter . '/image9.jpg',
    //                                                         '/images/stars/' . $filter . '/image10.jpg',
    //                                                         '/images/stars/' . $filter . '/image11.jpg',
    //                                                         '/images/stars/' . $filter . '/image12.jpg',
    //                                                         '/images/stars/' . $filter . '/image13.jpg',
    //                                                         '/images/stars/' . $filter . '/image14.jpg',
    //                                                         '/images/stars/' . $filter . '/image15.jpg'
    //                                                         ]]);
    //     }elseif ($filter == "20al") {
    //         $results = $star_repository->findAll();
    //         $distances = [];
    //         foreach ($results as $result) {
    //             if ($result->getDistance() < 20) {
    //                 array_push($distances, $result->getDistance());
    //             }
    //         }
    //         $allStars = $star_repository->findBy(['distance' => $distances]);
    //     }elseif ($filter == "100al") {
    //         $distances = [];
    //         $results = $star_repository->findAll();
    //         foreach ($results as $result) {
    //             if ($result->getDistance() > 20 && $result->getDistance() < 100) {
    //                 array_push($distances, $result->getDistance());
    //             }
    //         }
    //         $allStars = $star_repository->findBy(['distance' => $distances]);
    //     }elseif ($filter == "1000al") {
    //         $results = $star_repository->findAll();
    //         $distances = [];
    //         foreach ($results as $result) {
    //             if ($result->getDistance() > 100 && $result->getDistance() <= 1000) {
    //                 array_push($distances, $result->getDistance());
    //             }
    //         }
    //         $allStars = $star_repository->findBy(['distance' => $distances]);
    //     }elseif ($filter == "1001al") {
    //         $results = $star_repository->findAll();
    //         $distances = [];
    //         foreach ($results as $result) {
    //             if ($result->getDistance() > 1000) {
    //                 array_push($distances, $result->getDistance());
    //             }
    //         }
    //         $allStars = $star_repository->findBy(['distance' => $distances]);
    //     }elseif ($filter == "5sun") {
    //         $results = $star_repository->findAll();
    //         $sizes = [];
    //         foreach ($results as $result) {
    //             if ($result->getSize() < 5) {
    //                 array_push($sizes, $result->getDistance());
    //             }
    //         }
    //         $allStars = $star_repository->findBy(['distance' => $sizes]);
    //     }elseif ($filter == "20sun") {
    //         $results = $star_repository->findAll();
    //         $sizes = [];
    //         foreach ($results as $result) {
    //             if ($result->getSize() > 5 && $result->getSize() <= 20) {
    //                 array_push($sizes, $result->getDistance());
    //             }
    //         }
    //         $allStars = $star_repository->findBy(['distance' => $sizes]);
    //     }elseif ($filter == "100sun") {
    //         $results = $star_repository->findAll();
    //         $sizes = [];
    //         foreach ($results as $result) {
    //             if ($result->getSize() > 20 && $result->getSize() <= 100) {
    //                 array_push($sizes, $result->getDistance());
    //             }
    //         }
    //         $allStars = $star_repository->findBy(['distance' => $sizes]);
    //     }elseif ($filter == "101sun") {
    //         $results = $star_repository->findAll();
    //         $sizes = [];
    //         foreach ($results as $result) {
    //             if ($result->getSize() > 100) {
    //                 array_push($sizes, $result->getDistance());
    //             }
    //         }
    //         $allStars = $star_repository->findBy(['distance' => $sizes]);
    //     } else {
    //         $allStars = $star_repository->findAll();
    //     }

    //     $stars = array_slice($allStars, 10 * ($page - 1), 10);

    //     $filterName = [
    //         0 => '',
    //         'red' => 'Etoiles rouges',
    //         'yellow' => 'Etoiles jaunes',
    //         'white' => 'Etoiles blanches',
    //         'blue' => 'Etoiles bleues',
    //         '20al' => 'Etoiles à moins de 20 années lumière',
    //         '100al' => 'Etoiles à moins de 100 années lumière',
    //         '1000al' => 'Etoiles à moins de 1000 années lumière',
    //         '1001al' => 'Etoiles à plus de 1000 années lumière',
    //         '5sun' => 'Etoiles faisant moins de 5 fois la taille du soleil',
    //         '20sun' => 'Etoiles faisant de 5 à 20 fois la taille du soleil',
    //         '100sun' => 'Etoiles faisant de 20 à 100 fois la taille du soleil',
    //         '101sun' => 'Etoiles faisant plus de 100 fois la taille du soleil'
    //     ];
    //     return $this->render('stars/index.html.twig', ['stars' => $stars, 'page' => $page, 'allStars' => $allStars, 'filter' => $filter, 'filterName' => $filterName]);
    // }

    // ----------------------- Create a new product (star). ---------------------------
    /**
    * @Route("/stars/new", name = "star_create")
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @return response
    */


    //  Two dependances need two be injected here: Request to add the form datas to the function and objectManager to be able to use $manager for saving the datas.
    public function create_new_star (Request $request, EntityManagerInterface $manager) {

        // Use FORMBUILDER the forms tool.
        // Create a new instance of the stars class:
        $star = new Stars();        

        $form = $this->createForm(CreateStarType::class, $star); // As I called the Form class I just created, I need to import it with a "use". I also link it to my $star_create object.

        // Then add the form's data with handleRequest and save it with the manager object:

        $form->handleRequest($request);

        // Check if the form is secured.
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $star->setAuthor($user);

            include '_StarsController_filter_conditions.php';
            
            $star->setFilterColor($star_color_category)
                ->setFilterSize($star_size_category)           
                ->setFilterDistance($star_distance_category)
                ->setFilterPlanetsNumber($star_planets_number_category)
                ->setFilterConstellation($constellations[array_search($star->getConstellation(), $constellations)][0])
                ->setFilterPrice($star_price_category)
                ->setFilterDiscount('D' . $Star->getDiscount())
                ;

            foreach ($star->getOtherImages() as $image) {
                $image->setStarsID($star);
                $manager->persist($image);
            }



            // Check if it's submitted and valid (the informations are correct).
            // if yes, save in DB. For this ask Doctrine to save with the $manager object.
            // Do the same that for injecting fixtures: use persist and flush.
            $manager->persist($star);
            $manager->flush();

            // Add a flash message
            $this->addFlash('success', "L'étoile <strong>{$star->getTitle()}</strong> a bien été créée."); //The first parameter is random, doesn't matter the name you give. The second one is the message you wanna show.

            // Then redirect to the page we want to go next. Here the star I just created:
            return $this->redirectToRoute('app_stars_knowmore', ['id' => $star->getId()]); //The method redirecToRoute offer to go to an other page. Here I use the just created title to go to the corresponding page as I do in knowMore function below.


        }


        return $this->render('stars/new.html.twig', ['form' => $form->createView()]); // <= Ask symfony to create the view on html.
    }


    // ----------------------- Modifiate article. ---------------------------
    
    /**
    *
    * @Route("/stars/{id}/edit", name="stars_edit")
    * @Security("is_granted('ROLE_USER') and user == star.getAuthor() or is_granted('ROLE_ADMIN')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @return Response
    */

    public function edit (Stars $star, Request $request, EntityManagerInterface $manager, ImagesRepository $repository) {
        // Create the form with the CreateStarType class containing the form model I created.
        $form = $this->createForm(CreateStarType::class, $star);

        

        // HandleRequest is needed to read data outside of superglobals get and post.
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $star->setAuthor($user);
            
            include '_StarsController_filter_conditions.php';
            
            $star->setFilterColor($star_color_category)
                ->setFilterSize($star_size_category)           
                ->setFilterDistance($star_distance_category)
                ->setFilterPlanetsNumber($star_planets_number_category)
                ->setFilterConstellation($constellations[array_search($star->getConstellation(), $constellations)][0])
                ->setFilterPrice($star_price_category)
                ->setFilterDiscount('D' . $Star->getDiscount())
                ;
            
            $images = $repository->findBy(["starsID" => $star->getId()],);
            
            // Remove the corresponding already registered stars.
            foreach ($images as $image) {
                $manager->remove($image);
            }

            // For each image to add, give it the star id and save.
            foreach ($star->getOtherImages() as $image) {

                $image->setStarsID($star);
                $manager->persist($image);
            }

            $manager->persist($star);
            $manager->flush();

            $this->addFlash('success', "L'étoile <strong>{$star->getTitle()}</strong> a bien été modifiée.");

            return $this->redirectToRoute('app_stars_knowmore', ['id' => $star->getId()]);
        }

        return $this->render("stars/edit.html.twig",["form"=> $form->createView(),"star" => $star]);
    }

    // ----------------------- Focus on 1 product. ---------------------------
    /**
    * Use a route with a parameter to send differents informations in function of the name of the route.
    * @Route("/stars/{id}", name="app_stars_knowmore")
    * 
    */

     public function knowMore($id, CommentRepository $comment_repository, StarsRepository $star_repository): Response {

        // I select the informations corresponding to the id.
        // Below I use the findOneByX selection. I make id to send the corresponding datas corresponding to the id in the shape of an array.

        $star = $star_repository->findOneById($id);
        $comments = $comment_repository->findAll();
        return $this->render('stars/knowMore.html.twig', ['comments' => $comments, 'star' => $star, 'commentToEdit' => 1]);
    }

    // ----------------------- Remove product. ---------------------------
    /**
    * @Route("/stars/{id}/remove", name="star_remove")
    * @Security("is_granted('ROLE_USER') and user == star.getAuthor() or is_granted('ROLE_ADMIN')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param Stars $star
    * @param EntityManagerInterface $manager
    * @return response
    */

    public function removeStar(EntityManagerInterface $manager, Stars $star): Response {

        // Delete the linked object before deleting the star:
        // Delete comments and answers:
        $comments = $star->getComments();
        foreach ($comments as $comment) {
            $Answers = $comment->getAnswers();
            foreach ($Answers as $answer) {
                $manager->remove($answer);
            }
            $manager->remove($comment);
        }

        // Delete images:
        $images = $star->getOtherImages();
        foreach ($images as $image) {
            $manager->remove($image);
        }

        $manager->remove($star);
        $manager->flush();
        $this->addFlash('success', "L'étoile <strong>{$star->getTitle()}</strong> a bien été supprimée.");
        return $this->redirectToRoute('stars/index.html.twig', ['page' => 1, 'filter' => 0]);
    }

}