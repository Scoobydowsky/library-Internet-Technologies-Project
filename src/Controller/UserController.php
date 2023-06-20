<?php

namespace App\Controller;


use App\Entity\Sessions;
use App\Entity\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\Response;

class UserController extends AbstractController
{
    #[Route('/login', name: "app_login", methods: ["GET", "POST"])]
    public function login(Request $request, EntityManagerInterface $entityManager)
        {

            //pobierz token
            $token = $request->cookies->get('auth_token');
            //jezeli token istnieje sprawdź czy istnieje użytkownik przypisany do tokenu
            if($token){
                $session = $entityManager->getRepository(Sessions::class);
                if($session->findOneBy(['auth_token' => $token])){
                    $userID = $session->findOneBy(['auth_token' => $token]);
                    $userRepo = $entityManager->getRepository(UserEntity::class);
                    $user = $userRepo->findOneBy(['id'=>$userID]);
                    if($user){
                        return $this->redirectToRoute('app_homepage');
                    }
                }
            }

            if($request->isMethod('POST')){
                $username = $request->request->get('username');
                $password= $request->request->get('password');


                $userRepository= $entityManager->getRepository(UserEntity::class);
                $user= $userRepository->findOneBy(['login'=>$username]);

                if(!$user || $password !== $user->getPassword()){
                    throw $this->createAccessDeniedException('Nieprawidłowe dane logowania!');
                }

                $token = uniqid();

                $response= $this->redirectToRoute('app_homepage');
                $response->headers->setCookie(new Cookie('auth_token',$token));
                $session = new Sessions();
                $session->setAuthToken($token);
                $session->setUserId(
                    $user->getId()
                );

                $entityManager->persist($session);
                $entityManager->flush();
                $response->send();

                return $response;
            }

            return $this->render('login.html.twig');
        }


}