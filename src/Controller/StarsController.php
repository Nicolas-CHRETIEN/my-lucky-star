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
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class StarsController extends AbstractController {

    // ----------------------- Select the datas from the DB and pass them to the products page. ---------------------------
    /**
     * @Route("/stars", name="app_stars")
     */

    public function index(StarsRepository $repository): Response {

        // Add the repository in argument of the function is the same than if we use the get repository method to select datas from Stars class:
        // $repository = $this->getDoctrine()->getRepository(Stars::class);

        $stars = $repository->findAll();

        // combine and shuffle the results of two selections.

        // Red dwarfs
        $redDwarfs = array_merge($repository->findBy(["image" => "/images/stars/image4.jpg"]), $repository->findBy(["image" => "/images/stars/image10.jpg"]));
        shuffle($redDwarfs);

        // Red giants
        $redGiants = array_merge($repository->findBy(["image" => "/images/stars/image1.jpg"]), $repository->findBy(["image" => "/images/stars/image5.jpg"]));
        shuffle($redGiants);

        // Yellow
        $yellow = array_merge($repository->findBy(["image" => "/images/stars/image2.jpg"]), $repository->findBy(["image" => "/images/stars/image9.jpg"]));
        shuffle($yellow);

        // blue giants
        $blueGiants = array_merge($repository->findBy(["image" => "/images/stars/image3.jpg"]), $repository->findBy(["image" => "/images/stars/image7.jpg"]));
        shuffle($blueGiants);

        // white dwarfs
        $whiteDwarfs = array_merge($repository->findBy(["image" => "/images/stars/image6.jpg"]), $repository->findBy(["image" => "/images/stars/image8.jpg"]));
        shuffle($whiteDwarfs);

        return $this->render('stars/index.html.twig', ['stars' => $stars, 'redDwarfs' => $redDwarfs, 'redGiants' => $redGiants, 'yellow' => $yellow, 'blueGiants' => $blueGiants, 'whiteDwarfs' => $whiteDwarfs]);
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


    // ----------------------- Create a new product (star). ---------------------------
    /**
     * @Route("/stars/new", name = "star_create")
     * @return response
     */


    //  Two dependances need two be injected here: Request to add the form datas to the function and objectManager to be able to use $manager for saving the datas.
    public function create_new_star (Request $request, EntityManagerInterface $manager) {

        // Use FORMBUILDER the forms tool.
        // Create a new instance of the stars class:
        $star = new Stars();
        // Create the form:

        // --------------------------------- If a form clas hasn't already been created, we would need to do all this: -------------------------------

        // $form = $this->createFormBuilder($star_create)
        //             ->add('title')
        //             ->add('slug')
        //             ->add('distance')
        //             ->add('smallDescription')
        //             ->add('description')
        //             ->add('image')
        //             ->add('size')
        //             ->add('planetsnumber')
        //             ->add('constellation')
        //             ->add('price')
        //             ->add('discount')
        //             ->add('save', SubmitType::class, ['label' => 'Ajouter une étoile', 'attr' => ['class' =>'btn btn-warning']]) // SubmitType is a class, so we need to declare it like this: ::class and to import it with a use above.

        //             // Create the form with getForm.
        //             ->getForm();

        // ---------------------------- But as I created a Form class for this form I only have to add: ----------------------------------

        
        

        $form = $this->createForm(CreateStarType::class, $star); // As I called the Form class I just created, I need to import it with a "use". I also link it to my $star_create object.

        // Then add the form's data with handleRequest and save it with the manager object:

        $form->handleRequest($request);

        // Check if the form is secured.
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $star->setAuthor($user);

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

     public function knowMore($id, StarsRepository $repository): Response {

        // I select the informations corresponding to the id.
        // Below I use the findOneByX selection. I make id to send the corresponding datas corresponding to the id in the shape of an array.

        $star = $repository->findOneById($id);
        return $this->render('stars/knowMore.html.twig', ['star' => $star]);
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
    * @Route("/starsType/lifeDuration", name = "app_lifeDuration")
    */

    public function life_duration(StarsRepository $repository): Response {

        $stars = $repository->findAll();

        return $this->render('starsType/category.html.twig', ['stars' => $stars]);
    }

    // ----------------------- life end stars. ---------------------------
    /**
    *
    * @Route("/starsType/lifeEnd", name = "app_lifeEnd")
    */

    public function life_end(StarsRepository $repository): Response {

        $stars = $repository->findAll();

        return $this->render('starsType/category.html.twig', ['stars' => $stars]);
    }

    // ----------------------- My account. ---------------------------
    /**
    *
    * @Route("/myAccount", name = "app_myAccount")
    */

    public function my_account(StarsRepository $repository): Response {

        $stars = $repository->findAll();

        return $this->render('starsType/category.html.twig', ['stars' => $stars]);
    }


}