<?php

namespace App\DataFixtures;

use App\Entity\UserEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new UserEntity();
        $user -> setLogin('JanKowalski');
        $user -> setPassword('haslo');
        $user -> setIsAdmin(false);
        $user -> setIsLibrarian(false);

        $manager->persist($user);

        $librarian = new UserEntity();
        $librarian -> setLogin('JKsiazek');
        $librarian -> setPassword('ksiazka');
        $librarian -> setIsAdmin(false);
        $librarian -> setIsLibrarian(true);

        $manager->persist($librarian);

        $admin = new UserEntity();
        $admin -> setLogin('PanAdmin');
        $admin -> setPassword('test');
        $admin -> setIsAdmin(true);
        $admin -> setIsLibrarian(false);

        $manager->persist($admin);

        $manager->flush();
    }
}
