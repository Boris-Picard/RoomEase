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

    #[ORM\OneToOne(mappedBy: 'id_room', cascade: ['persist', 'remove'])]
    private ?Reservation $id_reservation = null;

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

    public function getIdReservation(): ?Reservation
    {
        return $this->id_reservation;
    }

    public function setIdReservation(?Reservation $id_reservation): static
    {
        // unset the owning side of the relation if necessary
        if ($id_reservation === null && $this->id_reservation !== null) {
            $this->id_reservation->setIdRoom(null);
        }

        // set the owning side of the relation if necessary
        if ($id_reservation !== null && $id_reservation->getIdRoom() !== $this) {
            $id_reservation->setIdRoom($this);
        }

        $this->id_reservation = $id_reservation;

        return $this;
    }
}
