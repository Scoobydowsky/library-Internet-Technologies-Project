<?php

namespace App\Entity;

use App\Repository\BorrowHistoryEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BorrowHistoryEntityRepository::class)]
class BorrowHistoryEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $UserID = null;

    #[ORM\Column]
    private ?int $BookID = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $BorrowDate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $ReturnDate = null;

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

    public function getBorrowDate(): ?\DateTimeInterface
    {
        return $this->BorrowDate;
    }

    public function setBorrowDate(\DateTimeInterface $BorrowDate): self
    {
        $this->BorrowDate = $BorrowDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->ReturnDate;
    }

    public function setReturnDate(?\DateTimeInterface $ReturnDate): self
    {
        $this->ReturnDate = $ReturnDate;

        return $this;
    }
}
