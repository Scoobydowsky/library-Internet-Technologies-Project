<?php

namespace App\Entity;

use App\Repository\BookEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookEntityRepository::class)]
class BookEntity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, options: ["collation" => "utf8mb4_unicode_ci"])]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column]
    private ?string $ISBN = null;

    #[ORM\Column(type: Types::TEXT , options: ["collation" => "utf8mb4_unicode_ci"] )]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $authorID = null;

    #[ORM\Column]
    private ?bool $reservation = null;

    #[ORM\Column]
    private ?bool $borrowed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getISBN(): ?int
    {
        return $this->ISBN;
    }

    public function setISBN(int $ISBN): self
    {
        $this->ISBN = $ISBN;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthorID(): ?int
    {
        return $this->authorID;
    }

    public function setAuthorID(int $authorID): self
    {
        $this->authorID = $authorID;

        return $this;
    }

    public function isReservation(): ?bool
    {
        return $this->reservation;
    }

    public function setReservation(bool $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function isBorrowed(): ?bool
    {
        return $this->borrowed;
    }

    public function setBorrowed(bool $borrowed): self
    {
        $this->borrowed = $borrowed;

        return $this;
    }
}
