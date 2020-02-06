<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,
                $this->getConfiguration("Prénom", "Votre prénom..."))
            ->add('lastName', TextType::class,
                $this->getConfiguration("Nom", "Votre nom de famille...") )
            ->add('email', EmailType::class,
                $this->getConfiguration("Email", "Votre email"))
            ->add('picture', UrlType::class,
                $this->getConfiguration("Photo de profil", "URL de l'image de votre avatar"))
            ->add('hash', PasswordType::class,
                $this->getConfiguration("Mot de passe", "Choisissez un bon mot de passe !"))
            ->add('introduction', TextType::class,
                $this->getConfiguration("Introduction", "Vos centres d'intéret,marques,categories de produits préférées, quelques mots..."))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
