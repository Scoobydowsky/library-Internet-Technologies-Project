<?php

namespace App\Service;

use App\Entity\Sessions;
use App\Entity\UserEntity;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class UserCheckService
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function checkUser($token = null): array|null
    {
        //jezeli token istnieje sprawdź czy istnieje użytkownik przypisany do tokenu
        if ($token) {
            $session = $this->entityManager->getRepository(Sessions::class);
            if ($session->findOneBy(['auth_token' => $token])) {
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $this->entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id' => $userID]);
                dd($user);
                if ($user) {
                    return $this->redirectToRoute('app_homepage', [
                        "user" => $user
                    ]);
                }
            }
            return null;
        }
    }
}