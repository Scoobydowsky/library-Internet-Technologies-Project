<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book/list',name:'app_book_list')]
    public function bookList():Response
    {
        //pobierz listę z db

        //zapisz do array

        return $this->render('books/list.html.twig',[
            //tutaj przekaż array wraz z statusami
        ]);
    }

    #[Route('book/view/{id}',name: 'app_book_page')]
    public function bookPage(int $id):Response
    {
        //pobierz dane po id z DBs
        if($id == 1){
            $bookData = [
                'title'=>'Opowieści z Narni',
                'date'=>'2005-12-08',
                'author'=>'Lewis C.S.',
                'ISBN' => '69312571',
                'description'=>'Słynna powieść C.S. Lewisa „Lew, czarownica i stara szafa. Opowieści z Narnii."
                 zaliczana jest do kategorii literatury dziecięcej. Młodzi czytelnicy odkryją dzięki niej magiczny świat, który znajduje się po drugiej stronie tytułowej szafy.'
            ];
        }


        return $this->render('books/page.html.twig',
        [
            'book'=>$bookData,
            //tutaj zmienne do przekazania na stronę ksiązki
        ]);
    }
}