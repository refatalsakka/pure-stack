<?php

namespace App\Form;

use App\Form\Model\ContactFormModel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('number', NumberType::class, [
                'label' => 'number',
                'required' => false
            ])
            ->add('message', TextareaType::class, [
                'label' => 'message',
                'required' => true,
            ])
            ->add('_csrf_token', HiddenType::class, [
                'mapped' => false,
            ])
            ->add('g-recaptcha-response', HiddenType::class, [
                'mapped' => false,
            ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactFormModel::class,
            "csrf_protection" => false
        ]);
    }
}
