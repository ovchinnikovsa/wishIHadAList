# WISH <i>i had a</i> LIST

### Description
It's my vision of wish list website.

### Instalation

Run app:

1. Put `.env` from .env.example in /src with ur vars
2. Install app
    ```bash 
    dokcer compose build
    ```
3. Run app
    ```bash 
    dokcer compose up -d
    ```
4. Run db migration
   1. Enter `app` container 
        ```bash 
        dokcer compose exce app bash
        ```
   2. Run migration
      ```bash
      php artisan migrate 
      ```
   3 Run seed
      ```bash
      php artisan db:seed 
      ```
