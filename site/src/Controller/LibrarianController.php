<?php

namespace App\Controller;

use App\Entity\BookEntity;
use App\Entity\Sessions;
use App\Entity\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibrarianController extends AbstractController
{

    #[Route('librarian/book/list', name: 'app_librarian_book_modify_list')]
    public function bookModifyDeleteView(Request $request,EntityManagerInterface $entityManager):Response
    {
        $token = $request->cookies->get('auth_token');
        if ($token) {
            $session = $entityManager->getRepository(Sessions::class);
            if ($session->findOneBy(['auth_token' => $token])) {
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id' => $userID->getUserId()]);
            }
        }
        //pobierz listę z db
        $bookRepository = $entityManager->getRepository(BookEntity::class);
        $book = $bookRepository->findAll();

        return $this->render('librarian/book_list_modify_delete.html.twig', [
            'books' => $book,
            'user' => $user
        ]);
    }
}