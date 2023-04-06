<?php

namespace App\Form;

use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheSirenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('siren', TextType::class)
            ->add('recherheSiren', SubmitType::class)
        ;

        $builder->addEventListener(
            FormEvents::POST_SUBMIT,
            [$this, 'onPostSubmit']
        );
    }

    public function onPostSubmit(FormEvent $evenement)
    {
        $form = $evenement->getForm();
        $siren = $form->getData()['siren'];

        if(empty($siren)) {
            $form->addError(new FormError('Le numéro Siren est obligatoire'));
        }  
    }
}