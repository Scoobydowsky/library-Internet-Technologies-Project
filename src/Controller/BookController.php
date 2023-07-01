<?php

namespace App\Controller;

use App\Entity\AuthorEntity;
use App\Entity\BookEntity;
use App\Entity\BookReservationEntity;
use App\Entity\BorrowHistoryEntity;
use App\Entity\Sessions;
use App\Entity\UserEntity;
use App\Repository\BookReservationEntityRepository;
use App\Service\UserCheckService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BookController extends AbstractController
{
    #[Route('/book/list',name:'app_book_list')]
    public function bookList(EntityManagerInterface $entityManager):Response
    {
        //pobierz listę z db
        $bookRepository = $entityManager->getRepository(BookEntity::class);
        $book = $bookRepository->findAll();

        return $this->render('books/list.html.twig',[
            'books'=>$book
        ]);
    }

    #[Route('book/view/{id}',name: 'app_book_page')]
    public function bookPage(int $id, EntityManagerInterface $entityManager):Response
    {
        //pobierz dane po id z DBs
            $bookRepository = $entityManager->getRepository(BookEntity::class);
            $book = $bookRepository->findOneBy(['id'=>$id]);
            $authorRepository = $entityManager->getRepository(AuthorEntity::class);
            $author = $authorRepository->findOneBy(['id'=>$book->getAuthorID()]);
            $authorString = $author->getName()." ".$author->getSurname();

        //pobierz historię wypożyczeń
        $borrowRepository = $entityManager->getRepository(BorrowHistoryEntity::class);
        $borrowsHistory = $borrowRepository->findBy(['BookId'=>$id]);

        return $this->render('books/page.html.twig',
        [
            'book'=>[
                'title'=>$book->getTitle(),
                'author'=> $authorString,
                'date'=>$book->getReleaseDate()->format('d-m-Y'),
                'ISBN'=>$book->getISBN(),
                'description'=>$book->getDescription()
            ],
            'borrows'=> $borrowsHistory
        ]);
    }

    #[Route('book/edit/{id}', name: 'app_book_book_edit')]
    public function bookEdit(int $id, EntityManagerInterface $entityManager):Response
    {
        //pobierz dane ksiazki
        $bookRepository = $entityManager->getRepository(BookEntity::class);
        $book = $bookRepository->findOneBy(['id'=>$id]);


        return $this->render('books/book_edit.html.twig',[
            'book'=>[
                'title'=>$book->getTitle(),
                'date'=>$book->getReleaseDate()->format('Y-m-d'),
                'date'=>$book->getReleaseDate()->format('Y-m-d'),
                'ISBN'=>$book->getISBN(),
                'description'=>$book->getDescription()
            ],
        ]);
    }

    #[Route('book/reservate/{id}', name: 'app_book_book_edit')]
    public function bookReservation(int $id, EntityManagerInterface $entityManager, Request $request, UrlGeneratorInterface $urlGenerator)
    {
        //sprawdzenie czy ksiazka jest dostępna
            $borrowRepository = $entityManager->getRepository(BorrowHistoryEntity::class);
            $reservationRepository = $entityManager->getRepository(BookReservationEntity::class);
            $bookIsBorrowed = $borrowRepository->findOneBy([
                'ReturnDate'=> null,
                'BookID'=>$id
            ]);
            $bookIsResevated = $reservationRepository->findOneBy([
                'BookID'=>$id
            ]);
        //jezeli tak to wypożycz
            if(!$bookIsBorrowed && !$bookIsResevated){
                $reservation = new BookReservationEntity();
                $reservation->setBookID($id);

                $token = $request->cookies->get('auth_token');
                if($token){
                    $session = $entityManager->getRepository(Sessions::class);
                    if($session->findOneBy(['auth_token' => $token])){
                        $userID = $session->findOneBy(['auth_token' => $token]);
                        $userRepo = $entityManager->getRepository(UserEntity::class);
                        $user = $userRepo->findOneBy(['id'=>$userID->getUserId()]);
                    }
                }
                $reservation->setUserID($user->getId());
                $entityManager->persist($reservation);
                $entityManager->flush();

            }
            else{
                //jezeli nie zablokuj (zabezpieczenie bedzie na poziomie twig)
              return $this->render('homepage.html.twig');
            }
        return $this->render('homepage.html.twig');
    }
    #[Route('book/borrow/{id}', name: 'app_book_book_borrow')]
    public function bookBorrow(int $id, EntityManagerInterface $entityManager, Request $request, UrlGeneratorInterface $urlGenerator)
    {
        //sprawdzenie czy użytkownik to bibliotekarz
        $token = $request->cookies->get('auth_token');
        if($token){
            $session = $entityManager->getRepository(Sessions::class);
            if($session->findOneBy(['auth_token' => $token])){
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id'=>$userID->getUserId()]);
            }
        }

        if($user->isIsLibrarian()){
            //pozwol na wypozyczenie
            

            //usuń z tabeli borrow
        }
        else{
            //jezeli nie zablokuj (zabezpieczenie bedzie na poziomie twig)
            return $this->render('homepage.html.twig');
        }
        return $this->render('homepage.html.twig');
    }
}