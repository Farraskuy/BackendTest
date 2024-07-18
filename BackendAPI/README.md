# Sistem Peminjaman Buku menggunakan API Laravel

## Kebutuhan

-   PHP >= 7.4
-   Composer
-   Laravel 8.x
-   MySQL

## Setup Project For Development

### `Fast setup`

```bash
    git clone https://github.com/Farraskuy/BackendTest.git

    composer install

    copy .env.example .env

    php artisan key:generate

    # configure your .env
    # create database then migrate database table
    php artisan migrate

    php artisan serve

    # test project
    php artisan test
```

### `step by step setup`

```bash
    # Clone project
    git remote add origin https://github.com/Farraskuy/BackendTest.git

    # install dependencies
    composer install

    # copy env then setup your local env
    copy .env.example .env

    # generate laravel app key
    php artisan key:generate

    # configure your .env
    # create database then migrate database table
    php artisan migrate

    # run project
    php artisan serve

    # test project
    php artisan test
```

## Testing

Buat testing:

- Members may not borrow more than 2 books
- Borrowed books are not borrowed by other members
- Member is currently not being penalized

- The returned book is a book that the member has borrowed
- If the book is returned after more than 7 days, the member will be subject to a penalty. Member with penalty cannot able to borrow the book for 3 days

- Shows all existing books and quantities
- Books that are being borrowed are not counted

- Shows all existing members
- The number of books being borrowed by each member
