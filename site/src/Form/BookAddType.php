<?php

namespace App\Form;

use App\Entity\AuthorEntity;
use App\Entity\BookEntity;
use App\Repository\AuthorEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookAddType extends AbstractType
{


    public function __construct(AuthorEntityRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $authors = $this->authorRepository->findAll();
        foreach ($authors as $author) {
            $authorChoices[$author->getName() . ' ' . $author->getSurname()] = $author->getId() ;
        }

        $builder
            ->add('title')
            ->add('release_date')
            ->add('ISBN')
            ->add('description')
            ->add('authorId', ChoiceType::class, [
                'choices' => $authorChoices,
                'placeholder' => 'Wybierz autora',
            ])
            ->add('reservation')
            ->add('borrowed')
            ->add('submit', SubmitType::class, [
            'label' => 'Dodaj',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookEntity::class,
        ]);
    }
}