<?php

namespace App\Controller;

use App\Entity\BookEntity;
use App\Entity\BorrowHistory;
use App\Entity\ReservationList;
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

    #[Route('librarian/book/borrow/{id}', name: 'app_librarian_book_borrow')]
    public function bookBorrow(int $id, Request $request, EntityManagerInterface $entityManager):Response
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
        if($user->isIsLibrarian()){
            $reservationRepository = $entityManager->getRepository(ReservationList::class);
            //znajdz rezerwacje tej ksiązki bez potwierdzenia
            $reservation = $reservationRepository->findOneBy(['BookID'=>$id, 'ConfirmedBy'=> null]);
            $borrow = new BorrowHistory();
            $bookRepository = $entityManager->getRepository(BookEntity::class);
            $book = $bookRepository->findOneBy(['id'=>$id]);
            $currentDate = new \DateTime();
            //pobierz rezerwację i ustaw wypozyczenie
            $reservation->setConfirmedBy($user->getID());
            $book->setReservation(false)
                ->setBorrowed(true);

            $borrow->setBookID($id)
                ->setUserID($reservation->getUserID())
                ->setLibrarianID($user->getId())
                ->setBorrowDate($currentDate);

            $entityManager->persist($reservation);
            $entityManager->persist($book);
            $entityManager->persist($borrow);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_book_list');
    }


}