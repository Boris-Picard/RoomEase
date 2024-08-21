<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column(length: 255)]
    private ?string $equipments = null;

    #[ORM\OneToOne(targetEntity: Reservation::class, mappedBy: 'room')]
    private ?Reservation $reservation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getEquipments(): ?string
    {
        return $this->equipments;
    }

    public function setEquipments(string $equipments): static
    {
        $this->equipments = $equipments;

        return $this;
    }
    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?string $reservation): static
    {
        $this->reservation = $reservation;

        return $this;
    }
}
