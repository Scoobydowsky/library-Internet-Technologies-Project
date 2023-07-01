<?php

namespace App\Entity;

use App\Repository\BookReservationEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookReservationEntityRepository::class)]
class BookReservationEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $BookID = null;

    #[ORM\Column]
    private ?int $UserID = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUserID(): ?int
    {
        return $this->UserID;
    }

    public function setUserID(int $UserID): self
    {
        $this->UserID = $UserID;

        return $this;
    }
}
