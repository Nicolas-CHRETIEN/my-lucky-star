<?php
$Constellations = [
    ['And', 'Andromède'],
    ['Ant', 'Machine Pneumatique'],
    ['Aps', 'Oiseau de Paradis'],
    ['Aql', 'Aigle'],
    ['Aqr', 'Verseau'],
    ['Ara', 'Autel'],
    ['Ari', 'Bélier'],
    ['Aur', 'Cocher'],
    ['Boo', 'Bouvier'],
    ['Cae', 'Burin'],
    ['Cam', 'Girafe'],
    ['Cap', 'Capricorne'],
    ['Car', 'Carène'],
    ['Cas', 'Cassiopée'],
    ['Cen', 'Centaure'],
    ['Cep', 'Céphée'],
    ['Cet', 'Baleine'],
    ['Cha', 'Caméléon'],
    ['Cir', 'Compas'],
    ['CMa', 'Grand Chien'],
    ['CMi', 'Petit Chien'],
    ['Cnc', 'Cancer'],
    ['Col', 'Colombe'],
    ['Com', 'Chevelure de Bérénice'],
    ['CrA', 'Couronne Australe'],
    ['CrB', 'Couronne Boréale'],
    ['Crt', 'Coupe'],
    ['Cru', 'Croix du Sud'],
    ['Crv', 'Corbeau'],
    ['CVn', 'Chiens de Chasse'],
    ['Cyg', 'Cygne'],
    ['Del', 'Dauphin'],
    ['Dor', 'Dorade'],
    ['Dra', 'Dragon'],
    ['Equ', 'Petit Cheval'],
    ['Eri', 'Eridan'],
    ['For', 'Fourneau'],
    ['Gem', 'Gémeaux'],
    ['Gru', 'Grue'],
    ['Her', 'Hercule'],
    ['Hor', 'Horloge'],
    ['Hya', 'Hydre Femelle'],
    ['Hyi', 'Hydre Mâle'],
    ['Ind', 'Indien'],
    ['Lac', 'Lézard'],
    ['Leo', 'Lion'],
    ['Lep', 'Lièvre'],
    ['Lib', 'Balance'],
    ['LMi', 'Petit Lion'],
    ['Lup', 'Loup'],
    ['Lyn', 'Lynx'],
    ['Lyr', 'Lyre'],
    ['Men', 'Table'],
    ['Mic', 'Microscope'],
    ['Mon', 'Licorne'],
    ['Mus', 'Mouche'],
    ['Nor', 'Règle'],
    ['Oct', 'Octant'],
    ['Oph', 'Ophiuchus'],
    ['Ori', 'Orion'],
    ['Pav', 'Paon'],
    ['Peg', 'Pégase'],
    ['Per', 'Persée'],
    ['Phe', 'Phénix'],
    ['Pic', 'Peintre'],
    ['PsA', 'Poisson Austral'],
    ['Psc', 'Poissons'],
    ['Pup', 'Poupe'],
    ['Pyx', 'Boussole'],
    ['Ret', 'Réticule'],
    ['Scl', 'Sculpteur'],
    ['Sco', 'Scorpion'],
    ['Sct', 'Écu de Sobieski'],
    ['Ser', 'Serpent'],
    ['Sex', 'Sextant'],
    ['Sge', 'Flèche'],
    ['Sgr', 'Sagittaire'],
    ['Tau', 'Taureau'],
    ['Tel', 'Télescope'],
    ['TrA', 'Triangle Austral'],
    ['Tri', 'Triangle'],
    ['Tuc', 'Toucan'],
    ['UMa', 'Grande Ourse'],
    ['UMi', 'Petite Ourse'],
    ['Vel', 'Voiles'],
    ['Vir', 'Vierge'],
    ['Vol', 'Poisson Volant'],
    ['Vul', 'Petit Renard']
];

$ConstellationsFilter = [
    'And',
    'Ant',
    'Aps',
    'Aql',
    'Aqr',
    'Ara',
    'Ari',
    'Aur',
    'Boo',
    'Cae',
    'Cam',
    'Cap',
    'Car',
    'Cas',
    'Cen',
    'Cep',
    'Cet',
    'Cha',
    'Cir',
    'CMa',
    'CMi',
    'Cnc',
    'Col',
    'Com',
    'CrA',
    'CrB',
    'Crt',
    'Cru',
    'Crv',
    'CVn',
    'Cyg',
    'Del',
    'Dor',
    'Dra',
    'Equ',
    'Eri',
    'For',
    'Gem',
    'Gru',
    'Her',
    'Hor',
    'Hya',
    'Hyi',
    'Ind',
    'Lac',
    'Leo',
    'Lep',
    'Lib',
    'LMi',
    'Lup',
    'Lyn',
    'Lyr',
    'Men',
    'Mic',
    'Mon',
    'Mus',
    'Nor',
    'Oct',
    'Oph',
    'Ori',
    'Pav',
    'Peg',
    'Per',
    'Phe',
    'Pic',
    'PsA',
    'Psc',
    'Pup',
    'Pyx',
    'Ret',
    'Scl',
    'Sco',
    'Sct',
    'Ser',
    'Sex',
    'Sge',
    'Sgr',
    'Tau',
    'Tel',
    'TrA',
    'Tri',
    'Tuc',
    'UMa',
    'UMi',
    'Vel',
    'Vir',
    'Vol',
    'Vul',
];

// Star color filter:
if (str_contains($star->getImage(), 'red')) {
    $star_color_category = 'red';
} elseif (str_contains($star->getImage(), 'yellow')) {
    $star_color_category = 'yellow';
} elseif (str_contains($star->getImage(), 'white')) {
    $star_color_category = 'white';
} elseif (str_contains($star->getImage(), 'blue')) {
    $star_color_category = 'blue';
} else {
    echo "ERROR image url not correct.";
    echo $star->getImage();
}
// Star size filter:
if ($star->getSize() <= 5) {
    $star_size_category = '5sun';
} elseif ($star->getSize() <= 20) {
    $star_size_category = '20sun';
} elseif ($star->getSize() <= 100) {
    $star_size_category = '100sun';
} elseif ($star->getSize() > 100) {
    $star_size_category = '101sun';
} else {
    echo "ERROR star distance not correct.";
}
// Star distance filter:
if ($star->getDistance() <= 20) {
    $star_distance_category = '20al';
} elseif ($star->getDistance() <= 100) {
    $star_distance_category = '100al';
} elseif ($star->getDistance() <= 1000) {
    $star_distance_category = '1000al';
} elseif ($star->getDistance() > 1000) {
    $star_distance_category = '1001al';
} else {
    echo "ERROR star distance not correct.";
}
// Star planets number filter:
if ($star->getPlanetsNumber() <= 5) {
    $star_planets_number_category = 'p5';
} elseif ($star->getPlanetsNumber() <= 10) {
    $star_planets_number_category = 'p10';
} elseif ($star->getPlanetsNumber() <= 15) {
    $star_planets_number_category = 'p15';
} elseif ($star->getPlanetsNumber() > 15) {
    $star_planets_number_category = 'p20';
} else {
    echo "ERROR star planets number not correct.";
}
// Star price filter:
if ($star->getPrice() <= 1000000000) {
    $star_price_category = '1KM';
} elseif ($star->getPrice() <= 2000000000) {
    $star_price_category = '2KM';
} elseif ($star->getPrice() <= 4000000000) {
    $star_price_category = '4KM';
} elseif ($star->getPrice() > 4000000000) {
    $star_price_category = '5KM';
} else {
    echo "ERROR star price not correct.";
}
?>