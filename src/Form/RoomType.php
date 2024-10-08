<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label" => 'Enter a valid name',
                "attr" => [
                    "placeholder" => "House"
                ]
            ])
            ->add('capacity', IntegerType::class, [
                "label" => 'Enter a valid capacity',
                "attr" => [
                    "placeholder" => "10"
                ]
            ])
            ->add('imageName', FileType::class, [
                'label' => 'Add an image of the room (only JPEG)',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid JPEG image',
                    ])
                ],
            ])
            ->add('equipment', TextareaType::class, [
                "label" => 'Describe the equipment',
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
