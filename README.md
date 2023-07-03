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

### TODO ON THE FRONT

- templates/books/list.html.twig (account for different user types)
- templates/admin/users.html.twig ✅
- templates/books/add_book.html.twig ✅
- templates/books/edit_book.html.twig ✅
- templates/base.html.twig (account for different user types) ✅
- templates/user/books_history.html.twig
- templates/books/search.html.twig
- change page titles

### TO FIX ON THE BACK

- search does not exist
- viewing books does not work again :')
- add_book form renders 'reservation' and 'borrowed' checkboxes for some reason
- add_books does not know if user is logged in or not
