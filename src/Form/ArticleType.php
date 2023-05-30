<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class , [
                "label" => "Titre",
                "attr" => ["placeholder" => "Votre titre..", "class" => "text-primary"]
            ])
            ->add('intro', TextType::class , [
                "label" => "Introduction",
                "attr" => ["placeholder" => "En quelques mots.."]
            ])
            ->add('content', TextareaType::class , [
                "label" => "Contenu",
                "attr" => ["placeholder" => "..."]
            ])
            ->add('image', TextType::class , [
                "label" => "URL de l'image",
                "attr" => ["placeholder" => "https://..."]            
            ])
            ->add('author', EntityType::class , [
                "class" => User::class,
                "choice_label" => "fullname"
            ])
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);

    }
}
