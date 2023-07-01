<?php

namespace App\DataFixtures;

use App\Entity\AuthorEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $author1 = new AuthorEntity();
        $author1
            ->setName("C.S")
            ->setSurname('Lewis');

        $author2 = new AuthorEntity();
        $author2
            ->setName('John Ronald Reuel')
            ->setSurname('Tolkien');

        $author3 = new AuthorEntity();
        $author3
            ->setName("Robert C.")
            ->setSurname("Martin");

        $author4 = new AuthorEntity();
        $author4
            ->setName("Stephen")
            ->setSurname("King");

        #load data
        $manager->persist($author1);
        $manager->persist($author2);
        $manager->persist($author3);
        $manager->persist($author4);
        $manager->flush();
    }
}
