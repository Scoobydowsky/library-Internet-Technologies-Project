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

    public function checkUser(Request $request, EntityManagerInterface $entityManager): array|null
    {
        $token = $request->cookies->get('auth_token');
        if ($token) {
            $session = $entityManager->getRepository(Sessions::class);
            if ($session->findOneBy(['auth_token' => $token])) {
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id' => $userID->getUserId()]);
                return $user;
            }else{
                return null;
            }
        }else{
            return null;
        }
    }
}