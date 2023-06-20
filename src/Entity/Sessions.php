<?php

namespace App\Entity;

use App\Repository\SessionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionsRepository::class)]
class Sessions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $auth_token = null;

    #[ORM\Column]
    #[ORM\OneToOne(targetEntity: UserEntity::class, inversedBy: "session")]
    #[ORM\JoinColumn(name: "user_id", referencedColumnName: "id")]
    private ?int $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthToken(): ?string
    {
        return $this->auth_token;
    }

    public function setAuthToken(string $auth_token): self
    {
        $this->auth_token = $auth_token;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }
}
