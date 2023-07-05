<?php

namespace App\Controller;

use App\Entity\AuthorEntity;
use App\Entity\BookEntity;
use App\Entity\BorrowHistory;
use App\Entity\ReservationList;
use App\Entity\Sessions;
use App\Entity\UserEntity;
use App\Form\BookAddType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book/list', name: 'app_book_list')]
    public function bookList(EntityManagerInterface $entityManager, Request $request): Response
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

        return $this->render('books/list.html.twig', [
            'books' => $book,
            'user' => $user
        ]);
    }

    #[Route('book/view/{id}', name: 'app_book_page')]
    public function bookPage(int $id, EntityManagerInterface $entityManager, Request $request): Response
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
        //pobierz dane po id z DBs
        $bookRepository = $entityManager->getRepository(BookEntity::class);
        $book = $bookRepository->findOneBy(['id' => $id]);
        $authorRepository = $entityManager->getRepository(AuthorEntity::class);
        $author = $authorRepository->findOneBy(['id' => $book->getAuthorID()]);
        $authorString = $author->getName() . " " . $author->getSurname();

        // if ($user->isIsLibrarian()) {
            $queryBuilder = $entityManager->createQueryBuilder();

            $query = $queryBuilder
                ->select('bh.id', 'bh.bookID', 'u.login as user_login', 'lu.login as librarian_login', 'bh.borrowDate', 'bh.returnDate')
                ->from(BorrowHistory::class, 'bh')
                ->join(UserEntity::class, 'u', 'WITH', 'bh.userID = u.id')
                ->join(UserEntity::class, 'lu', 'WITH', 'bh.librarianID = lu.id')
                ->where('bh.bookID = :bookId')
                ->setParameter('bookId', $id)
                ->getQuery();

            $bookHistory = $query->getArrayResult();

        // }

        return $this->render('books/page.html.twig',
            [
                'book' => [
                    'id' => $book->getId(),
                    'reservation' => $book->isReservation(),
                    'borrowed' => $book->isBorrowed(),
                    'title' => $book->getTitle(),
                    'author' => $authorString,
                    'date' => $book->getReleaseDate()->format('d-m-Y'),
                    'ISBN' => $book->getISBN(),
                    'description' => $book->getDescription()
                ],
                'user' => $user,
                'borrowHistory'=>$bookHistory
            ]);
    }

    #[Route('book/add', name: 'app_book_add')]
    public function bookAdd(Request $request, EntityManagerInterface $entityManager): Response
    {
        $token = $request->cookies->get('auth_token');
        if ($token) {
            $session = $entityManager->getRepository(Sessions::class);
            if ($session->findOneBy(['auth_token' => $token])) {
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id' => $userID->getUserId()]);
            }
            if ($user->isIsLibrarian()) {
                $book = new BookEntity();

                $form = $this->createForm(BookAddType::class, $book);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $entityManager->persist($book);
                    $entityManager->flush();

                    return $this->redirectToRoute('app_librarian_book_modify_list');
                }

            }
        }
        return $this->render('books/add_book.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('book/edit/{id}', name: 'app_book_book_edit')]
    public function bookEdit(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $token = $request->cookies->get('auth_token');
        if ($token) {
            $session = $entityManager->getRepository(Sessions::class);
            if ($session->findOneBy(['auth_token' => $token])) {
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id' => $userID->getUserId()]);
            } else {
                return $this->redirectToRoute('app_homepage');
            }
            if ($user->isIsLibrarian()) {
                $bookRepository = $entityManager->getRepository(BookEntity::class);
                $book = $bookRepository->findOneBy(['id' => $id]);

                $form = $this->createForm(BookAddType::class, $book);

                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $entityManager->flush();


                    return $this->redirectToRoute('app_librarian_book_modify_list');
                }

            } else {
                return $this->redirectToRoute('app_homepage');
            }

        }
        return $this->render('books/book_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('book/delete/{id}', name: 'app_book_delete')]
    public function bookDelete(int $id, EntityManagerInterface $entityManager, Request $request): Response
    {
        $token = $request->cookies->get('auth_token');
        if ($token) {
            $session = $entityManager->getRepository(Sessions::class);
            if ($session->findOneBy(['auth_token' => $token])) {
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id' => $userID->getUserId()]);
            } else {
                return $this->redirectToRoute('app_homepage');
            }
            if ($user->isIsLibrarian()) {
                $bookRepository = $entityManager->getRepository(BookEntity::class);
                $book = $bookRepository->findOneBy(['id' => $id]);

                if ($book->isBorrowed()) {
                    echo "Nie mozna usunąć wypożyczonej książki";
                } else {
                    $entityManager->remove($book);
                    $entityManager->flush();
                }

            } else {
                return $this->redirectToRoute('app_homepage');
            }
        }
        return $this->redirectToRoute('app_librarian_book_modify_list');
    }

    #[Route('book/reservate/{id}', name: 'app_book_reservate')]
    public function bookMakeReservation(int $id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $token = $request->cookies->get('auth_token');
        if ($token) {
            $session = $entityManager->getRepository(Sessions::class);
            if ($session->findOneBy(['auth_token' => $token])) {
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id' => $userID->getUserId()]);
            } else {
                return $this->redirectToRoute('app_homepage');
            }
            if ($user) {
                $bookRepository = $entityManager->getRepository(BookEntity::class);
                $book = $bookRepository->findOneBy(['id' => $id]);
                if (!$book->isReservation()) {
                    $reservationRepository = $entityManager->getRepository(ReservationList::class);
                    $reservationInHistory = $reservationRepository->findOneBy(['BookID' => $id]);
                    // jezeli jest zarezerwowana ale rezerwacja nie jest "potwierdzona" przez bibliotekarza
                    if ($reservationInHistory && !$reservationInHistory->getConfirmedBy()) {
                        //Ksiązka już zarezerwowana i wypożyczona
                    }
                    // jezeli nie jest zarezerwowana albo (jest zarezerwowana i potwierdzona przez bibliotekarza)
                    if ((!$reservationInHistory) || ($reservationInHistory && $reservationInHistory->getConfirmedBy())) {
                        $reservation = new ReservationList();
                        $currentDate = new \DateTime();
                        $reservation->setReservationTime($currentDate)
                            ->setBookID($id)
                            ->setUserID($user->getId());

                        $book->setReservation(true);

                        $entityManager->persist($reservation);
                        $entityManager->persist($book);
                        $entityManager->flush();

                        return $this->redirectToRoute('app_book_list');
                    }
                }
            }

        }
        if ($user->isIsLibrarian()) {
            return $this->redirectToRoute('app_librarian_book_list');
        }
        else
        return $this->redirectToRoute('app_book_list');
    }



}