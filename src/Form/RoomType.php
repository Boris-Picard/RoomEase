<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => 'Enter a valid name',
                "constraints" => [
                    new NotBlank([
                        'message' => 'Name cannot be blank.',
                    ]),
                    new Length([
                        "min" => 2,
                        "minMessage" => "Name must be at least {{ limit }} characters long.",
                    ]),
                ],
                "attr" => [
                    "placeholder" => "House"
                ]
            ])
            ->add('capacity', IntegerType::class, [
                "label" => 'Enter a valid capacity',
                "constraints" => [
                    new NotBlank([
                        'message' => 'Capacity cannot be blank.',
                    ]),
                    new Type([
                        'type' => 'integer',
                        'message' => 'Capacity must be an integer.',
                    ]),
                ],
                "attr" => [
                    "placeholder" => "10"
                ]
            ])
            ->add('equipment', TextareaType::class, [
                "label" => 'Describe the equipment',
                "constraints" => [
                    new NotBlank([
                        'message' => 'Description cannot be blank.',
                    ]),
                    new Length([
                        "min" => 15,
                        "minMessage" => "Description must be at least {{ limit }} characters long.",
                    ]),
                ],
                "attr" => [
                    "placeholder" => "List of equipment or description"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
    }
}
