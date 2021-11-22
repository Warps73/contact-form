<?php

namespace App\Form;

use App\Entity\ContactMessage;
use App\Form\DataTransformer\RetrieveExistingContactUserTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

class ContactType extends AbstractType
{
    private RetrieveExistingContactUserTransformer $transformer;

    public function __construct(RetrieveExistingContactUserTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'contactUser',
                ContactUserType::class,
                ['constraints' => new Valid()]
            )
            ->add(
                'message',
                TextareaType::class,
            )
            ->add(
                'name',
                TextType::class,

            )
            ->get('contactUser')
            ->addModelTransformer(
                $this->transformer
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactMessage::class,
        ]);
    }
}
