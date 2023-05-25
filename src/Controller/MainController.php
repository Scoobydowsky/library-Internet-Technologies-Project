<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/',name: 'app_homepage')]
    public function homepage():Response
    {
        //jezeli osoba nie jest zalogowana przekieruj na login.html.twig
        // informacja na temat zalogowanej osoby
        return $this->render('homepage.html.twig');
    }

    #[Route('/login',name: 'app_login')]
    public function loginPage():Response
    {

        return $this->render('login.html.twig');
    }

    //TODO BELOW
    #[Route('/settings',name: 'app_settings')]
    public function settingsPage():Response
    {

        return $this->render('homepage.html.twig');
    }

    #[Route('/search/{searching}', name:'app_search')]
    public function search(string $searching):Response
    {
        if($searching != null){

        }
        return $this->render(':books:search.html.twig',['lookingFor'=>$searching]);
    }



}