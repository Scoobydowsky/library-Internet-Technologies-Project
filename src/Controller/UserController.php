<?php

namespace App\Controller;


use App\Entity\Sessions;
use App\Entity\UserEntity;
use App\Service\UserCheckService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserController extends AbstractController
{
    public function __construct(UrlGeneratorInterface $router, UserCheckService $userCheck)
    {
        $this->router = $router;
        $this->userCheck = $userCheck;
    }

    #[Route('/login', name: "app_login", methods: ["GET", "POST"])]
    public function login(Request $request, EntityManagerInterface $entityManager)
    {
        //pobierz token
        $token = $request->cookies->get('auth_token');
        //jezeli token istnieje sprawdź czy istnieje użytkownik przypisany do tokenu
        if ($token) {
            $session = $entityManager->getRepository(Sessions::class);
            if ($session->findOneBy(['auth_token' => $token])) {
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id' => $userID->getUserId()]);
                if ($user) {
                    return $this->redirectToRoute('app_homepage', [
                        "user" => $user
                    ]);
                }
            }
        }

        if ($request->isMethod('POST')) {
            $username = $request->request->get('username');
            $password = $request->request->get('password');


            $userRepository = $entityManager->getRepository(UserEntity::class);
            $user = $userRepository->findOneBy(['login' => $username]);

            if (!$user || $password !== $user->getPassword()) {
                throw $this->createAccessDeniedException('Nieprawidłowe dane logowania!');
            }

            $token = uniqid();

            $response = $this->redirectToRoute('app_homepage');
            $response->headers->setCookie(new Cookie('auth_token', $token));
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

    #[Route('/logout', name: "app_logout")]
    public function logout(Request $request, EntityManagerInterface $entityManager): Response
    {
        $token = $request->cookies->get('auth_token');
        if ($token) {
            //usunięcie sesji z db
            $session = $entityManager->getRepository(Sessions::class)->findOneBy(['auth_token' => $token]);
            if ($session) {
                $entityManager->remove($session);
                $entityManager->flush();
            }
            //usunięcie tokena
            $homepageUrl = $this->router->generate('app_homepage');
            $response = new RedirectResponse($homepageUrl);
            $response->headers->clearCookie('auth_token');
            return $response;

        } else {
            echo "Nie byłeś zalogowany nie ładnie...-> Zmienić na jakiś ładny redirect";
        }
        return $this->redirectToRoute('app_homepage');
    }

    #[Route('/settings', name: 'app_settings')]
    public function settingsPage(Request $request, EntityManagerInterface $entityManager): Response
    {
        $token = $request->cookies->get('auth_token');
        if ($token) {
            $session = $entityManager->getRepository(Sessions::class);
            if ($session->findOneBy(['auth_token' => $token])) {
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id' => $userID->getUserId()]);
                return $this->render('user/settings.html.twig', [
                    'user' => $user
                ]);
            }
        }

        return $this->redirectToRoute('app_login');
    }

}