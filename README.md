# SCRAPIFY 

## Getting started

### Requirements

1. You must have [PHP](https://www.php.net/) installed.
1. You must have [Composer](https://getcomposer.org/) installed.
1. You must have [Node.js](https://nodejs.org/) installed.
1. You must have [PYTHON](https://www.python.org/) installed.


### Setting up your Laravel app

1. Install your composer dependencies:

    ```shell
    composer install
    ```

1. Create the `.env` file:

    ```shell
    cp .env.example .env
    ```

1. Bootstrap the default [SQLite](https://www.sqlite.org/index.html) database and add it to your `.env` file:

    ```shell
    touch storage/db.sqlite
    ```

    **NOTE**: Once you create the database file, make sure to update your `DB_DATABASE` and `PYTHON_PATH` variables in `.env` since Laravel requires a full path to the file.

1. Generate an `APP_KEY` for your app:

    ```shell
    php artisan key:generate
    ```

1. Create the necessary  tables in your database:

    ```shell
    php artisan migrate
    ```

### Setup

```shell
  npm install
```

### Install library python needed

1. beautifulsoup4:

    ```shell
    pip install beautifulsoup4
    ```

1. requests :

    ```shell
    pip install requests
    ```

1. lxml:

    ```shell
    pip install lxml
    ```

### Run App


```shell
  php artisan serve
```

```shell
  npm run dev
```


