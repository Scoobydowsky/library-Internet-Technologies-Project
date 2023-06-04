<?php

namespace App\Controller;

use App\Entity\AuthorEntity;
use App\Entity\BookEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('books/page.html.twig',
        [
            'book'=>[
                'title'=>$book->getTitle(),
                'author'=> $authorString,
                'date'=>$book->getReleaseDate()->format('d-m-Y'),
                'ISBN'=>$book->getISBN(),
                'description'=>$book->getDescription()
            ],
        ]);
    }
}