<?php

namespace App\Service;

use App\Entity\Sessions;
use App\Entity\UserEntity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class UserCheckService
{
    public function checkUser():array|bool
    {
        $request = new Request();
        $entityManager = EntityManagerInterface();
        //sprawdz cookie
        $token = $request->cookies->get('auth_token');
        if($token){
            $session = $entityManager->getRepository(Sessions::class);
            //sprawdz czy w db jest token zapisany z id uzytkownka
            if($session->findOneBy(['auth_token' => $token])){
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id'=>$userID->getUserId()]);
                return $user;
            }
        }
        return false;
    }
}