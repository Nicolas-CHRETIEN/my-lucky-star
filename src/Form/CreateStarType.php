<?php

namespace App\Form;

use App\Entity\Stars;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CreateStarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('distance')
            ->add('smallDescription')
            ->add('description', TextareaType::class)
            ->add('image', FileType::class)
            ->add('size')
            ->add('planetsNumber', RangeType::class, ['attr' => ['min' => 0,'max' => 20],])
            ->add('constellation', ChoiceType::class, ['choices' => ['Andromède' => 'Andromède', 'La Balance' => 'La Balance', 'L\'Aigle' => 'L\'Aigle', 'L\'Autel' => 'L\'Autel', 'La Baleine' => 'La Baleine', 'Le Bélier' => 'Le Bélier', 'La Boussole' => 'La Boussole', 'Le Bouvier' => 'Le Bouvier', 'Le Burin' => 'Le Burin', 'Le Caméléon' => 'Le Caméléon', 'Le Cancer' => 'Le Cancer', 'Le Capricorne' => 'Le Capricorne', 'La Carène' => 'La Carène', 'Cassiopée' => 'Cassiopée', 'Le Centaure' => 'Le Centaure', 'Céphée' => 'Céphée', 'La Chevelure de Bérénice' => 'La Chevelure de Bérénice', 'Les Chiens de chasse' => 'Les Chiens de chasse', 'Le Cocher' => 'Le Cocher', 'La Colombe' => 'La Colombe', 'Le Compas' => 'Le Compas', 'Le Corbeau' => 'Le Corbeau', 'La Coupe' => 'La Coupe', 'La Couronne australe' => 'La Couronne australe', 'La Couronne boréale' => 'La Couronne boréale', 'La Croix du Sud' => 'La Croix du Sud', 'Le Cygne' => 'Le Cygne', 'Le Dauphin' => 'Le Dauphin', 'La Dorade' => 'La Dorade', 'Le Dragon' => 'Le Dragon', 'L\'Écu de Sobieski' => 'L\'Écu de Sobieski', 'L\'Éridan' => 'L\'Éridan', 'La Flèche' => 'La Flèche', 'Le Fourneau' => 'Le Fourneau', 'Les Gémeaux' => 'Les Gémeaux', 'La Girafe' => 'La Girafe', 'Le Grand Chien' => 'Le Grand Chien', 'La Grande Ourse' => 'La Grande Ourse', 'La Grue' => 'La Grue', 'Hercule' => 'Hercule', 'L\'Horloge' => 'L\'Horloge', 'L\'Hydre' => 'L\'Hydre', 'L\'Hydre mâle' => 'L\'Hydre mâle', 'L\'Indien' => 'L\'Indien', 'Le Lézard' => 'Le Lézard', 'La Licorne' => 'La Licorne', 'Le Lièvre' => 'Le Lièvre', 'Le Lion' => 'Le Lion', 'Le Loup' => 'Le Loup', 'Le Lynx' => 'Le Lynx', 'La Lyre' => 'La Lyre', 'La Machine' => 'La Machine', 'pneumatique' => 'pneumatique', 'Le Microscope' => 'Le Microscope', 'La Mouche' => 'La Mouche', 'L\'Octant' => 'L\'Octant', 'L\'Oiseau de paradis' => 'L\'Oiseau de paradis', 'Ophiuchus' => 'Ophiuchus', 'Orion' => 'Orion', 'Le Paon' => 'Le Paon', 'Pégase' => 'Pégase', 'Le Peintre' => 'Le Peintre', 'Persée' => 'Persée', 'Le Petit Cheval' => 'Le Petit Cheval', 'Le Petit Chien' => 'Le Petit Chien', 'Le Petit Lion' => 'Le Petit Lion', 'Le Petit Renard' => 'Le Petit Renard', 'La Petite Ourse' => 'La Petite Ourse', 'Le Phénix' => 'Le Phénix', 'Le Poisson austral' => 'Le Poisson austral', 'Le Poisson volant' => 'Le Poisson volant', 'Les Poissons' => 'Les Poissons', 'La Poupe' => 'La Poupe', 'La Règle' => 'La Règle', 'Le Réticule' => 'Le Réticule', 'Le Sagittaire' => 'Le Sagittaire', 'Le Scorpion' => 'Le Scorpion', 'Le Sculpteur' => 'Le Sculpteur', 'Le Serpentaire' => 'Le Serpentaire', 'Le Sextant' => 'Le Sextant', 'La Table' => 'La Table', 'Le Taureau' => 'Le Taureau', 'Le Télescope' => 'Le Télescope', 'Le Toucan' => 'Le Toucan', 'Le Triangle' => 'Le Triangle', 'Le Triangle austral' => 'Le Triangle austral', 'Le Verseau' => 'Le Verseau', 'La Vierge' => 'La Vierge', 'Les Voiles' => 'Les Voiles',],])
            ->add('price', MoneyType::class)
            ->add('discount', ChoiceType::class, ['choices' => [0 => 0, 10 => 10, 20 => 20, 30 => 30, 50 => 50,],])
            ->add('save', SubmitType::class, ['label' => 'Ajouter une étoile', 'attr' => ['class' => 'btn btn-warning']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stars::class,
        ]);
    }
}
