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
