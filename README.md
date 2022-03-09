# News Api

```shell
composer install
```
```shell
cp .env.example .env
```

```shell
php artisan db:migrate
```

optional:

```shell
php artisan db:seed
```

## Console commands

To run the server:

```shell
php -S localhost:8000 -t public
```

To fetch last articles:

```shell
php artisan articles:fetch {q} {--page=1} {--size=100}
```

To run parser for all queries:

```shell
php artisan schedule:run
```

## Api

```http request
GET api/articles
        ?page=1
        &per_page=20
        &date=2022-03-08
        &source=somesource
        &query_used=bitcoin
        &q=fulltextsearch
```
where:

 - query_used - is a query used during parse
 - date - is published date
 - q - is a fulltext search against title and content

