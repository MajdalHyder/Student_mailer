<?php

namespace App\Form;

use App\Entity\Convention;
use App\Entity\Etudiant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttestaionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Etudiant', EntityType::class, [
                'class' => Etudiant::class,
                'mapped' => false,
                'choice_label' => function(Etudiant $etudiant) {
                return $etudiant->getPrenom() . ' ' . $etudiant->getNom();
                }
            ])

            ->add('Convention', TextType::class, [
                'disabled' => true,

            ])
            ->add('Attestation', TextareaType::class, [
                'required' => true,
                'mapped' => false,
            ])
            ->add('save', SubmitType::class)
        ;
        /*
         *
        $builder->get('Etudiant')->addEventListener(
            FormEvents::PRE_SUBMIT,
            function (FormEvent $event)
            {
                $data = $event->getData();
                $form = $event->getForm();
                //$form->get("Convention");
                dd($event->getData());
            }
        );*/

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
