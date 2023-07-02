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

- templates/admin/users.html.twig
- templates/books/add_book.html.twig
- templates/books/search.html.twig
- templates/user/books_history.html.twig
- templates/books/list.html.twig (account for different user types)
- templates/base.html.twig (account for different user types)
