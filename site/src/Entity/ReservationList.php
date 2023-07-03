<?php

namespace App\Entity;

use App\Repository\ReservationListRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationListRepository::class)]
class ReservationList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $UserID = null;

    #[ORM\Column]
    private ?int $BookID = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $reservationTime = null;

    #[ORM\Column(nullable: true)]
    private ?int $ConfirmedBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserID(): ?int
    {
        return $this->UserID;
    }

    public function setUserID(int $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }

    public function getBookID(): ?int
    {
        return $this->BookID;
    }

    public function setBookID(int $BookID): self
    {
        $this->BookID = $BookID;

        return $this;
    }

    public function getReservationTime(): ?\DateTimeInterface
    {
        return $this->reservationTime;
    }

    public function setReservationTime(\DateTimeInterface $reservationTime): self
    {
        $this->reservationTime = $reservationTime;

        return $this;
    }

    public function getConfirmedBy(): ?int
    {
        return $this->ConfirmedBy;
    }

    public function setConfirmedBy(int $ConfirmedBy): self
    {
        $this->ConfirmedBy = $ConfirmedBy;

        return $this;
    }
}
