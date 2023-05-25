<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Stars;
use App\Entity\Images;
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


        $faker = Factory::create('FR-fr');

        // Create a loop:
        for ($index = 0; $index < 60; $index++) {

            $Star = new Stars();
            $random_image_number = rand(1, 24);
            $smallDescription = $faker->paragraph(2);
            $description = $faker->paragraph(12);
            $Star->setTitle($StarsData[rand(0, 59)])
                ->setDistance(rand(50, 3000))
                ->setSmallDescription($smallDescription)
                ->setDescription($description)
                ->setImage("/images/stars/image" . $random_image_number . ".jpg")
                ->setSize(rand(1, 24))
                ->setPlanetsNumber(rand(1, 14))
                ->setConstellation($Constellation[rand(0, 88)])
                ->setPrice(mt_rand(10005,50000) * 100000)
                ->setDiscount(mt_rand(0,5) / 10)
                ;

            // Persist is the first method to be used to enter datas in database. Flush is the second one.
            $manager->persist($Star);

            for ($index2 = 1; $index2 <= mt_rand(2, 5); $index2++) {
                $image = new Images();
                $random_image_number = rand(1, 24);
                $image->setUrl("/images/stars/image" . $random_image_number . ".jpg")
                        ->setCaption("image star")
                        ->setStarsID($Star)
                ;
                
                $manager->persist($image);
            }

            
        }
        //  Flush:  Requests the server to send its currently buffered output to the browser.
        $manager->flush();
    }
}
