<?php

namespace App\Form;

use App\Entity\Abonnement;
use App\Entity\Compteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contrat')
            ->add('date')
            ->add('cumulAnc')
            ->add('cumulNouv')
            ->add('compteur', EntityType::class, [
                'class' => Compteur::class,
                'choice_label' => 'numero'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
