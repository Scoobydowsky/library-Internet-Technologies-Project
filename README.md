# Bajo Jajo - system biblioteczny
### Projekt zaliczeniowy z Technologii Internetowych
Autorzy: Tomasz Woytkowiak, Filip Plociennik, Dawid Pieczynski

## Użyte technologie:
- PHP w/Symfony
- HTML w/Twig
- CSS w/Bootstrap 5
- Docker

## Features:
### 3 typy użytowników: Czytelnik, Bibliotekrz, Administrator.

### Czytelnik może:
- przeglądać katalog dostępnych książek
- wyświetlić szczegóły pojednczych książek
- rezerwować książki
- wyświetlić historię swoich wyporzyczeń
### Bibliotekrz może: 
- wyświetlić listę książek zarezerwowanych i wyporzyczonych
- wyporzyczać i przyjmować zwroty książek
- wyświetlać historię wyporzyczenia pojedynczych książek
- wyświetlić pełen katalog dostępnych książek
- dodawać i usuwać książki z katalogu
- edytować szczegóły książek (tytuł, autor, data wydania, ISBN, opis)
### Administrator może:
- wyświetlić katalog książek
- wyświetlić listę zarejestrowanych użytkowników
- dodawać i usuwać użytkowników każdego typu

### W pełni responsywny layout.

# Lista komend

## Startowanie kontenera

`docker compose up -d --build`

## Zatrzymanie kontenera

`docker compose down`

## Przeglądanie logów

`docker compose logs -f`

# Przykładowy plik .env

```
MYSQL_ROOT_PASSWORD=haslo_roota
MYSQL_DATABASE=nazwa_bazy_danych
APP_ENV=srodowisko_symfony
APP_SECRET=secret_symfony
```
