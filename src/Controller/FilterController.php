<?php

namespace App\Controller;

use App\Repository\StarsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class FilterController extends AbstractController {

    // ----------------------- Render the products needed for the product file with no filter and the corresponding page. ---------------------------
    /**
    * @Route("/page/{page}/stars", name="app_stars")
    */

    public function noFilter ($page, StarsRepository $star_repository): Response {
        $allstars = $star_repository->findAll();
        $stars = array_slice($allstars, 10 * ($page - 1), 10);
        
        return $this->render('stars/index.html.twig', ['page' => $page, 'stars' => $stars, 'allstars' => $allstars]);
    }

    // ----------------------- Render the products needed for the product file with filter at the corresponding page. ---------------------------------

    /**
    * @Route("/page/{page}/filter/{filter}/stars", name="app_stars_filter")
    */

    public function filter ($page, $filter, StarsRepository $star_repository): Response {

        // Create an array with the current filters selected.
        $possibilitiesFilters = [
            'filterColor' => ['red', 'yellow', 'white', 'blue'],
            'filterSize' => ['5sun', '20sun', '100sun', '101sun'],
            'filterDistance' => ['20al', '100al', '1000al', '1001al'],
            'filterPlanetsNumber' => ['p5', 'p10', 'p15', 'p20'],
            'filterConstellation' => ['And','Ant', 'Aps', 'Aql', 'Aqr', 'Ara', 'Ari', 'Aur', 'Boo', 'Cae', 'Cam', 'Cap', 'Car', 'Cas', 'Cen', 'Cep', 'Cet', 'Cha', 'Cir', 'CMa', 'CMi', 'Cnc', 'Col', 'Com', 'CrA', 'CrB', 'Crt', 'Cru', 'Crv', 'CVn', 'Cyg', 'Del', 'Dor', 'Dra', 'Equ', 'Eri', 'For', 'Gem', 'Gru', 'Her', 'Hor', 'Hya', 'Hyi', 'Ind', 'Lac', 'Leo', 'Lep', 'Lib', 'LMi', 'Lup', 'Lyn', 'Lyr', 'Men', 'Mic', 'Mon', 'Mus', 'Nor', 'Oct', 'Oph', 'Ori', 'Pav', 'Peg', 'Per', 'Phe', 'Pic', 'PsA', 'Psc', 'Pup', 'Pyx', 'Ret', 'Scl', 'Sco', 'Sct', 'Ser', 'Sex', 'Sge', 'Sgr', 'Tau', 'Tel', 'TrA', 'Tri', 'Tuc', 'UMa', 'UMi', 'Vel', 'Vir', 'Vol', 'Vul'],
            'filterPrice' => ['1M', '2M', '4M', '5M'],
            'filterDiscount' => ['D10', 'D20', 'D30', 'D50']
        ];

        $keys = [];
        $values = [];

        foreach ($possibilitiesFilters as $key => $value) {
            for ($index=0; $index < sizeof($possibilitiesFilters[$key]); $index++) { 
                if (str_contains($filter, $value[$index])) {
                    array_push($keys, $key);
                    array_push($values, $value[$index]);
                }
            }
        }
        $currentFilters = array_combine($keys, $values);
        
        $allstars = $star_repository->findBy($currentFilters);

        $stars = array_slice($allstars, 10 * ($page - 1), 10);
        
        return $this->render('stars/filters.html.twig', ['page' => $page, 'stars' => $stars, 'allstars' => $allstars, 'currentFilters' => $currentFilters, 'filter' => $filter]);
    }
}
