<?php

namespace App\Form;

use App\Entity\Product;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextareaType::class,$this->getConfiguration("Nom", "Saisissez le nom du produit"))
            ->add('slug', TextType::class, $this->getConfiguration("Adresse web","Tapez l'adrese web (automatique)", [
                'required' => false
            ]))
            ->add('content', TextareaType::class, $this->getConfiguration( "Descritpion", "Donnez une description du produit"))
            ->add('price', MoneyType::class, $this->getConfiguration("Prix", "Saisissez le prix du produit"))
            ->add('favorite')
            ->add('color', ChoiceType::class,$this->getConfiguration("Couleur", "Choisissez la couleur du produit", [
                'choices' => [
                    'red' => 'rouge',
                    'green' => 'vert',
                    'blue' => 'bleu',
                    'orange' => 'orange',
                    'yellow' => 'yellow',
                ],'multiple' =>true,
            ]))
            ->add('image', UrlType::class, $this->getConfiguration("Image", "Donnez l'adresse URL de l'image"))
            ->add('discount', IntegerType::class, $this->getConfiguration("Promotion", "Indiquez le pourcentage de remise du produit"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
