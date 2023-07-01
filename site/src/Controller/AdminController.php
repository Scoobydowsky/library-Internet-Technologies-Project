<?php

namespace App\Controller;

use App\Entity\Sessions;
use App\Entity\UserEntity;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin',name:'app_admin_panel')]
    public function adminPanel():Response
    {

        return $this->render('admin/menu.html.twig');
    }

    #[Route('admin/add-new-user', name: 'app_admin_adduser')]
    public function addUser():Response
    {


        return $this->render('admin/user/add_user.html.twig');
    }

    #[Route('admin/show/users', name:'app_admin_showusers')]
    public function showUsers(EntityManagerInterface $entityManager, Request $request):Response
    {
        $token = $request->cookies->get('auth_token');
        if($token){
            $session = $entityManager->getRepository(Sessions::class);
            if($session->findOneBy(['auth_token' => $token])){
                $userID = $session->findOneBy(['auth_token' => $token]);
                $userRepo = $entityManager->getRepository(UserEntity::class);
                $user = $userRepo->findOneBy(['id'=>$userID->getUserId()]);
            }
            if($user->isIsAdmin()){
                $users= $entityManager->getRepository(UserEntity::class);
                $list = $users->findAll();
                return $this->render('admin/user/users.html.twig',[
                    'users'=>$list,
                    'user'=>$user
                ]);
            }else{
                return $this->redirectToRoute('app_login');
            }
        }else{
            return $this->redirectToRoute('app_login');
        }
    }
}