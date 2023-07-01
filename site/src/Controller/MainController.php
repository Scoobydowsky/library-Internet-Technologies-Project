<?php

namespace App\Controller;

use App\Entity\Sessions;
use App\Entity\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/',name: 'app_homepage')]
    public function homepage(Request $request ,EntityManagerInterface $entityManager):Response
    {
        $token = $request->cookies->get('auth_token');
        if($token){
            $session = $entityManager->getRepository(Sessions::class);
            if($session->findOneBy(['auth_token' => $token])){
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id'=>$userID->getUserId()]);
                return $this->render('homepage.html.twig',[
                    'user'=>$user
                ]);
            }
        }

        return $this->render('homepage.html.twig');
    }

    //TODO BELOW

    #[Route('/search/{searching}', name:'app_search')]
    public function search(string $searching):Response
    {
        if($searching != null){

        }
        return $this->render(':books:search.html.twig',['lookingFor'=>$searching]);
    }

    public function CheckUser(Request $request , EntityManagerInterface $entityManager) : array
    {


    }

}