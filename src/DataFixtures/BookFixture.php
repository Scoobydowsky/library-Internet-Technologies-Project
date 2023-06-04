<?php

namespace App\DataFixtures;

use App\Entity\BookEntity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $book1 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '16-10-1950');
        $book1
            ->setTitle('Opowiesci z Narni: Lew, czarownica i stara szafa')
            ->setAuthorID(2)
            ->setReleaseDate($releaseDate)
            ->setISBN('9788372781758')
            ->setDescription(' "Lew, Czarownica i stara szafa" to pierwszy tom cyklu "Opowieści z Narnii" autorstwa C.S. Lewisa. Kultowa seria książek dla dzieci, stworzona przez profesora z Oksfordu, od lat niesie nieprzemijalne wartości. Uczy także rozwijać wyobraźnię kolejnych pokoleń młodych czytelników.')
            ->setReservation(false)
            ->setBorrowed(false);

        $manager->persist($book1);

        $book2 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '07-11-2014');
        $book2
            ->setTitle('Hobbit')
            ->setAuthorID(2)
            ->setReleaseDate($releaseDate)
            ->setISBN('9788324156623')
            ->setDescription(' "Hobbit" to niesamowita powieść fantasy napisana przez J.R.R. Tolkiena. Akcja rozgrywa się w magicznym świecie Śródziemia i skupia się na przygodach Bilba Bagginsa, małego hobbita. Bilbo wyrusza w niezwykłą podróż razem z grupą krasnoludów, mającą za zadanie odzyskać skarb zagarnięty przez smoka Smauga. Przez pełne niebezpieczeństw i spotkania z różnymi istotami, Bilbo odkrywa w sobie odwagę i niezwykłe umiejętności. "Hobbit" to opowieść o przyjaźni, odwadze i odkrywaniu własnych granic w świecie pełnym magii i przygód. Ta klasyczna książka przyciąga czytelników wszystkich wieków i pozostaje niezapomnianą podróżą przez wyobraźnię i fantastyczne światy Tolkiena.')
            ->setReservation(false)
            ->setBorrowed(false);

        $manager->persist($book2);
        $book3 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '01-04-2013');
        $book3
            ->setTitle('Koniec człowieczeństwa')
            ->setAuthorID(1)
            ->setReleaseDate($releaseDate)
            ->setISBN('9788366748163')
            ->setDescription('Koniec człowieczeństwa, uznawany za jedną z najważniejszych – obok Chrześcijaństwa po prostu – książek C.S. Lewisa na temat etyki, to błyskotliwa i brawurowo napisana apologia uniwersalnego prawa moralnego. Wychodząc od problemu edukacji i odnosząc się do dziedzictwa różnych kultur, Lewis pokazuje, że istnieje jeden, wspólny i niezmienny kodeks moralny, który możemy odnaleźć zarówno w Biblii, jak pięknych wersach Eddy poetyckiej czy w zasadach Tao. Prawo moralne od zawsze wpisane jest w serce człowieka, a wszelkie próby sztucznego modyfikowania go, stwarzania „nowego człowieka” czy „pokonania ludzkiej natury” oznaczają walkę z samym człowieczeństwem. Każdy z trzech esejów, które składają się na ten tom: Ludzie bez torsów, Droga i Koniec człowieczeństwa, to prawdziwa intelektualna przygoda oraz niezapomniane duchowe spotkanie z autorem Zaskoczonego Radością i Problemu cierpienia.')
            ->setReservation(false)
            ->setBorrowed(false);

        $manager->persist($book3);
        $book4 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '01-12-1990');
        $book4
            ->setTitle('Listy starego diabła do młodego')
            ->setAuthorID(1)
            ->setReleaseDate($releaseDate)
            ->setISBN('9788380087897')
            ->setDescription('W "Listach starego diabła do młodego" piekielna ekscelencja, podsekretarz stanu w piekle, wymienia urzędowe listy ze swoim podwładnym, bratankiem, młodszym diabłem, który ma okazać swoje zdolności w służbie kusicielskiej. Za tym humorem, dowcipem, elegancją, za tą dociekliwością i przewrotnością kryją się ważne przesłania i pytania. Najważniejsze z nich to pytanie o rolę i miejsce zła w świecie stworzonym przez Boga.')
            ->setReservation(false)
            ->setBorrowed(false);
        $manager->persist($book4);
        $book5 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '01-01-2021');
        $book5
            ->setTitle('Władca Pierścieni. Powrót Króla')
            ->setAuthorID(2)
            ->setReleaseDate($releaseDate)
            ->setISBN(9788382024906)
            ->setDescription('Trzeci i zarazem ostatni tom znanej na całym świecie powieści "Władca Pierścieni". Jeżeli dwa pierwsze tomy przypadły Ci do gustu, to koniecznie musisz sięgnąć po tom 3, kończący całą opowieść. A jeśli jeszcze nie miałeś okazji zapoznać się z "Władcą Pierścieni", to powinieneś to zmienić.
"Powrót króla. Władca Pierścieni. Tom 3" autorstwa J.R.R. Tolkiena to trzeci tom, obejmujący księgę piątą i szóstą powieści. Księga piąta zatytułowana została przez Tolkiena "Wojna o Pierścień", księga szósta natomiast to "Powrót króla".
W trzecim tomie powieści walka o Śródziemie powoli zbliża się do końca. Władca Ciemności gromadzi swoje armie, a jego przerażający cień sięga coraz dalej. Przeciwko niemu stają połączone armie ludzi, elfów, krasnoludów oraz entów. Frodo i Sam kontynuują swoją misję i w dalszym ciągu wędrują w głąb Mordoru, aby zrealizować najważniejszy cel. Muszą zniszczyć Jedyny Pierścień. Czy im się to uda? Jak zakończy się ostateczna bitwa pomiędzy siłami ciemności a tymi, którzy walczą o Śródziemie?')
            ->setReservation(false)
            ->setBorrowed(false);
        $manager->persist($book5);
        $book6 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '01-01-1981');
        $book6
            ->setTitle('Listy')
            ->setAuthorID(2)
            ->setReleaseDate($releaseDate)
            ->setISBN(9788382020267)
            ->setDescription('Książka zabiera czytelnika w podróż przez całą pierwszą połowę XX wieku, od I wojny światowej do późniejszych dziesięcioleci, ukazując obraz wielkiego pisarza daleki od utrwalonych o nim stereotypów jako autorze, który uciekając od współczesności, schronił się w świecie swojej wyobraźni, czy przedstawiających Tolkiena jako znużonego światem, odizolowanego w uniwersyteckim świecie naukowca.')
            ->setReservation(false)
            ->setBorrowed(false);
        $manager->persist($book6);
        $book7 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '01-01-1998');
        $book7
            ->setTitle('Worek kości')
            ->setAuthorID(4)
            ->setReleaseDate($releaseDate)
            ->setISBN(9788367513944)
            ->setDescription('Cztery lata po tragicznej śmierci żony autor bestsellerów, Mike Noonan, przeżywa kryzys twórczy. Niezdolny do pisania, wypalony psychicznie i prześladowany wspomnieniami, postanawia wrócić do miejsca, w którym kiedyś spędził z żoną najszczęśliwsze dni życia, do domu nad jeziorem we wschodnim Maine.
Wkrótce po przyjeździe zostaje wciągnięty w konflikt między młodą wdową a jej teściem, lokalnym magnatem, który chce zyskać prawo do opieki nad trzyletnią wnuczką. Mike, widząc w dziewczynce córkę, której pozbawił go los, nie waha się, po której stanąć stronie w coraz bardziej zaciekłym sporze. Dramatyzmu sytuacji nadaje atmosfera w domu… najwyraźniej nawiedzanym.
A zmarła żona Mike’a najwyraźniej chce mu coś przekazać.')
            ->setReservation(false)
            ->setBorrowed(false);
        $manager->persist($book7);
        $book8 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '01-01-1994');
        $book8
            ->setTitle('Cztery pory roku')
            ->setAuthorID(4)
            ->setReleaseDate($releaseDate)
            ->setISBN(9788367513456)
            ->setDescription('Cztery minipowieści, które dowodzą, że Stephen King jest nie tylko mistrzem grozy – równie dobrze radzi sobie z prozą obyczajową i sensacyjną.
SKAZANI NA SHAWSHANK
Więzień odsiadujący karę dożywocia za podwójne – niepopełnione – zabójstwo obmyśla plan ucieczki. Tak misterny, że może zwieść nie tylko sadystycznych strażników, ale i towarzyszy. Ekranizacja tego utworu, z Timem Robbinsem i Morganem Freemanem w rolach głównych, otrzymała 7 nominacji do Oscarów.
POJĘTNY UCZEŃ
Hitlerowski zbrodniarz ukrywający się pod przybranym nazwiskiem w amerykańskim miasteczku znajduje „godnego” siebie ucznia w osobie trzynastoletniego chłopca. Filmowa adaptacja tej minipowieści nosi tytuł Uczeń szatana.
CIAŁO
Czterech nastolatków wyrusza w drogę wzdłuż torów, by po raz pierwszy w życiu zobaczyć zwłoki. Filmowa wersja tego utworu o dojrzewaniu, z udziałem Kiefera Sutherlanda i Richarda Dreyfussa, ukazała się jako Stań przy mnie.
METODA ODDYCHANIA
Historia makabrycznego porodu, który pewien lekarz z talentem do snucia opowieści odebrał w wigilijny wieczór.')
            ->setReservation(false)
            ->setBorrowed(false);
        $manager->persist($book8);
        $book9 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '01-09-1996');
        $book9
            ->setTitle('Zielona Mila')
            ->setAuthorID(4)
            ->setReleaseDate($releaseDate)
            ->setISBN(9788367513937)
            ->setDescription('Akcja powieści, zbliżonej klimatem do głośnej noweli tego samego autora, Skazani na Shawshank, toczy się w Ameryce lat 30. Jej bohaterowie to więźniowie oczekujący na wykonanie kary śmierci i pilnujący ich strażnicy. Wśród przebywających w więzieniu Cold Mountain skazańców znajduje się nieobliczalny, niezwykle agresywny młodociany zabójca William Wharton; jest Eduard Delacroix, niepozorny Francuz z Luizjany, który zgwałcił, zabił młodą dziewczynę i dla zatarcia śladów spalił kolejnych sześć osób. Jest wreszcie skazany za brutalny mord na dwóch małych dziewczynkach John Coffey, zagadkowy olbrzym o wiecznie załzawionych oczach, obdarzony niezwykłą mocą. Co łączy tych ludzi? Tę zagadkę usiłuje rozwiązać główny klawisz, Paul Edgecombe, wierzący w niewinność Coffeya. Zieloną Milę zekranizował w 1999 roku Frank Darabont; główną rolę zagrał Tom Hanks.')
            ->setReservation(false)
            ->setBorrowed(false);
        $manager->persist($book9);
        $book10 = new BookEntity();
        $releaseDate = \DateTime::createFromFormat('d-m-Y', '19-02-2010');
        $book10
            ->setTitle('Czysty kod. Podręcznik dobrego programisty')
            ->setAuthorID(3)
            ->setReleaseDate($releaseDate)
            ->setISBN(9788383223452)
            ->setDescription('Poznaj najlepsze metody tworzenia doskonałego kodu

Jak pisać dobry kod, a zły przekształcić w dobry?
Jak formatować kod, aby osiągnąć maksymalną czytelność?
Jak implementować pełną obsługę błędów bez zaśmiecania logiki kodu?
O tym, ile problemów sprawia niedbale napisany kod, wie każdy programista. Nie wszyscy jednak wiedzą, jak napisać ten świetny, "czysty" kod i czym właściwie powinien się on charakteryzować. Co więcej - jak odróżnić dobry kod od złego? Odpowiedź na te pytania oraz sposoby tworzenia czystego, czytelnego kodu znajdziesz właśnie w tej książce. Podręcznik jest obowiązkową pozycją dla każdego, kto chce poznać techniki rzetelnego i efektywnego programowania.

W książce Czysty kod. Podręcznik dobrego programisty szczegółowo omówione zostały zasady, wzorce i najlepsze praktyki pisania czystego kodu. Podręcznik zawiera także kilka analiz przypadków o coraz większej złożoności, z których każda jest doskonałym ćwiczeniem porządkowania zanieczyszczonego bądź nieudanego kodu. Z tego podręcznika dowiesz się m.in., jak tworzyć dobre nazwy, obiekty i funkcje, a także jak tworzyć testy jednostkowe i korzystać z programowania sterowanego testami. Nauczysz się przekształcać kod zawierający problemy w taki, który jest solidny i efektywny.')
            ->setReservation(false)
            ->setBorrowed(false);
        $manager->persist($book10);

        $manager->flush();
    }
}
