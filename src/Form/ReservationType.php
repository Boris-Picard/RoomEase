<?php

namespace App\Form;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Enum\ReservationStatusEnum;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'label' => 'Select a date to reserve the room',
                'widget' => 'single_text',
                'attr' => [
                    'min' => (new \DateTime())->modify('+1 day')->format('Y-m-d'),
                ]
            ])
            ->add('time', TimeType::class, [
                'label' => 'Select an hour to return the room',
                'widget' => 'choice',
                'hours' => [8, 12, 16],
                'minutes' => [0, 15, 30, 45],
                'input' => 'datetime',
            ])
            // ->add('users', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'id',
            // ])
            ->add('rooms', EntityType::class, [
                'label' => 'Select a Room',
                'class' => Room::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('r')
                        ->where('r.status = :status')
                        ->setParameter('status', ReservationStatusEnum::Available->value)
                        ->orderBy('r.name', 'ASC');
                },
                'choice_label' => function (Room $room): string {
                    return 'Room : ' . $room->getName() . ' - ' . 'Capacity : ' . $room->getCapacity();
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
