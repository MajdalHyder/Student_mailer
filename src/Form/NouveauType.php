<?php

namespace App\Form;

use App\Entity\Etudiant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NouveauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'mapped' => false,
                'required' => true
            ])
            ->add('prenom', TextType::class, [
                'mapped' => false,
                'required' => true
            ])
            ->add('mail', EmailType::class, [
                'mapped' => false,
                'required' => true
            ])
            ->add('convention', TextType::class, [
                'mapped' => false,
                'required' => true
            ])
            ->add('nbHeur', IntegerType::class, [
                'label' => "Nombre des heures",
                'mapped' => false,
                'required' => true
            ])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
