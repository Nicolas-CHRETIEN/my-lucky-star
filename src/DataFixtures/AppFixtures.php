<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Stars;
use App\Entity\Images;
use App\Entity\Answers;
use App\Entity\Comment;
use Cocur\Slugify\Slugify;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Create an array with the datas to import:

        $StarsData = [
            'Altaïr', 'Mirach', 'Hamal', 'Arcturus', 'Canopus', 'Miaplacidus', 'Aspidiske', 'Caph', 'Rigil Kentaurus', 'Hadar', 'Toliman', 'Menkent', 'Aldéramin', 'Capella', 'Gienah', 'Mimosa', 'Acrux', 'Gacrux', 'Deneb', 'Eltanin', 'Achernar', 'Pollux', 'Alhéna', 'Sirius', 'Adhara', 'Wezen', 'Aludra', 'Alioth', 'Alkaïd', 'Phecda', 'Tiaki', 'Alphard', 'Régulus', 'Véga', 'Rigel', 'Bételgeuse', 'Bellatrix', 'Alnilam', 'Peacock', 'Enif', 'Scheat', 'Markab', 'Mirfak', 'Algol', 'Procyon', 'Kochab', 'Ankaa', 'Fomalhaut', 'Naos', 'Kaus Australis', 'Nunki', 'Antarès', 'Shaula', 'Sargas', 'Dschubba', 'Larawag', 'Aldébaran', 'Elnath', 'Atria', 'Alsephina'
        ];

        $Constellation = ['Andromède', 'La Balance', 'L\'Aigle', 'L\'Autel', 'La Baleine', 'Le Bélier', 'La Boussole', 'Le Bouvier', 'Le Burin', 'Le Caméléon', 'Le Cancer', 'Le Capricorne', 'La Carène', 'Cassiopée', 'Le Centaure', 'Céphée', 'La Chevelure de Bérénice', 'Les Chiens de chasse', 'Le Cocher', 'La Colombe', 'Le Compas', 'Le Corbeau', 'La Coupe', 'La Couronne australe', 'La Couronne boréale', 'La Croix du Sud', 'Le Cygne', 'Le Dauphin', 'La Dorade', 'Le Dragon', 'L\'Écu de Sobieski', 'L\'Éridan', 'La Flèche', 'Le Fourneau', 'Les Gémeaux', 'La Girafe', 'Le Grand Chien', 'La Grande Ourse', 'La Grue', 'Hercule', 'L\'Horloge', 'L\'Hydre', 'L\'Hydre mâle', 'L\'Indien', 'Le Lézard', 'La Licorne', 'Le Lièvre', 'Le Lion', 'Le Loup', 'Le Lynx', 'La Lyre', 'La Machine', 'pneumatique', 'Le Microscope', 'La Mouche', 'L\'Octant', 'L\'Oiseau de paradis', 'Ophiuchus', 'Orion', 'Le Paon', 'Pégase', 'Le Peintre', 'Persée', 'Le Petit Cheval', 'Le Petit Chien', 'Le Petit Lion', 'Le Petit Renard', 'La Petite Ourse', 'Le Phénix', 'Le Poisson austral', 'Le Poisson volant', 'Les Poissons', 'La Poupe', 'La Règle', 'Le Réticule', 'Le Sagittaire', 'Le Scorpion', 'Le Sculpteur', 'Le Serpentaire', 'Le Sextant', 'La Table', 'Le Taureau', 'Le Télescope', 'Le Toucan', 'Le Triangle', 'Le Triangle austral', 'Le Verseau', 'La Vierge', 'Les Voiles'
        ];

        $image_generator = [
            'red' => ["/images/stars/red/image1", "/images/stars/red/image2", "/images/stars/red/image3", "/images/stars/red/image4", "/images/stars/red/image5", "/images/stars/red/image6", "/images/stars/red/image7", "/images/stars/red/image8", "/images/stars/red/image9", "/images/stars/red/image10", "/images/stars/red/image11", "/images/stars/red/image12", "/images/stars/red/image13", "/images/stars/red/image14", "/images/stars/red/image15"],

            'blue' => ["/images/stars/blue/image1", "/images/stars/blue/image2", "/images/stars/blue/image3", "/images/stars/blue/image4", "/images/stars/blue/image5", "/images/stars/blue/image6", "/images/stars/blue/image7", "/images/stars/blue/image8", "/images/stars/blue/image9", "/images/stars/blue/image10", "/images/stars/blue/image11", "/images/stars/blue/image12", "/images/stars/blue/image13", "/images/stars/blue/image14", "/images/stars/blue/image15"],

            'white' => ["/images/stars/white/image1", "/images/stars/white/image2", "/images/stars/white/image3", "/images/stars/white/image4", "/images/stars/white/image5", "/images/stars/white/image6", "/images/stars/white/image7", "/images/stars/white/image8", "/images/stars/white/image9", "/images/stars/white/image10", "/images/stars/white/image11", "/images/stars/white/image12", "/images/stars/white/image13", "/images/stars/white/image14", "/images/stars/white/image15"],

            'yellow' => ["/images/stars/yellow/image1", "/images/stars/yellow/image2", "/images/stars/yellow/image3", "/images/stars/yellow/image4", "/images/stars/yellow/image5", "/images/stars/yellow/image6", "/images/stars/yellow/image7", "/images/stars/yellow/image8", "/images/stars/yellow/image9", "/images/stars/yellow/image10", "/images/stars/yellow/image11", "/images/stars/yellow/image12", "/images/stars/yellow/image13", "/images/stars/yellow/image14", "/images/stars/yellow/image15"]
        ];

        $color = ['red', 'blue', 'white', 'yellow'];
        $discount = [0, 0, 10, 20, 30, 50];


        $faker = Factory::create('FR-fr');
        $slugify = new Slugify();
        $users = [];
        $images = [];
        // Create a loop for User class:
        for ($index1 = 0; $index1 < 60; $index1++) {
            $user = new User();
            $already_used_avatars = [];
            $random_avatar_image = rand(1, 25);
            if (in_array($random_avatar_image, $already_used_avatars)) {
                $index1--;
            } else {
            $firstname = $faker->firstname;
            $lastname = $faker->lastname;
            $user->setFirstname(strtolower($firstname))
                ->setLastname(strtoupper($lastname))
                ->setEmail($faker->email)
                ->setIntroduction($faker->sentence())
                ->setDescription($faker->paragraph(5))
                ->setAvatar("/images/avatar/" . $random_avatar_image . ".jpg")
                ->setSlug(strtolower(mb_substr($firstname, 0, 1) . $lastname))
                ->setRoles([])
                ->setPassword(password_hash("password", PASSWORD_DEFAULT))
                ;

                array_push($already_used_avatars, $random_avatar_image);
                $manager->persist($user);
                $users[]=$user;
            }
        }



        // Create a loop for Star class:
        for ($index2 = 0; $index2 < 200; $index2++) {

            $Star = new Stars();
            $choosen_color = $color[rand(0, 3)];
            $random_main_image_number = rand(0, 14);
            $already_used_images = [$random_main_image_number];
            $choosen_image = $image_generator[$choosen_color][$random_main_image_number];
            $title = $StarsData[rand(0, 59)];
            $slug = $slugify->slugify($title);
            $smallDescription = $faker->paragraph(2);
            $description = $faker->paragraph(12);
            $Star->setTitle($title)
                ->setDistance(rand(5, 3000))
                ->setSmallDescription($smallDescription)
                ->setDescription($description)
                ->setImage($choosen_image . ".jpg")
                ->setSize(rand(1, 150))
                ->setPlanetsNumber(rand(1, 20))
                ->setConstellation($Constellation[rand(0, 88)])
                ->setPrice(mt_rand(10005,50000) * 100000)
                ->setDiscount($discount[mt_rand(0,5)])
                ->setAuthor($users[rand(0, 24)])
                ;

            // Persist is the first method to be used to enter datas in database. Flush is the second one.
            $manager->persist($Star);
            $stars[]=$Star;

            for ($index3 = 1; $index3 <= mt_rand(2, 5); $index3++) {
                $image = new Images();
                $random_secondary_image_number = rand(0, 14);
                if (in_array($random_secondary_image_number, $already_used_images)) {
                    $index3--;
                } else {
                    $image->setUrl($image_generator[$choosen_color][$random_secondary_image_number] . ".jpg")
                            ->setCaption("image " . $title)
                            ->setStarsID($Star)
                    ;
                    
                    array_push($already_used_images, $random_secondary_image_number);
                    $manager->persist($image);
                }
            }

            
        }

        // Create a loop for Comments class:
        for ($index4 = 0; $index4 < 500; $index4++) {
            $comment = new Comment;
            $comment->setUserId($users[rand(0, (sizeof($users) - 1))])
                    ->setStarId($stars[rand(0, (sizeof($stars) - 1))])
                    ->setMessage($faker->sentence(rand(1, 5)))
                    ->setDate($faker->dateTimeBetween('-100 days', '-50 days'))
                    ->setEdit($faker->dateTimeBetween('-50 days', '-1 days'))
                    ;
            
            $manager->persist($comment);

            // Create a loop for Answers class:
            for ($index5 = 0; $index5 < rand(0, 5); $index5++) {
                $answer = new Answers;
                $answer->setComment($comment)
                        ->setUserId($users[rand(0, (sizeof($users) - 1))])
                        ->setMessage($faker->sentence(rand(1, 5)))
                        ->setDate($faker->dateTimeBetween('-100 days', '-50 days'))
                        ->setEdit($faker->dateTimeBetween('-50 days', '-1 days'))
                        ->setTarget('comment')
                        ->setTargetName($comment->getUserId()->getFirstname() . " " . $comment->getUserId()->getLastname())
                        ;
                $manager->persist($answer);
            }
        }


        //  Flush:  Requests the server to send its currently buffered output to the browser.
        $manager->flush();
    }
}
