# JOB BOARD APP

<hr>

## Start

```
laravel new job-board
```

```
php artisan make:model OfferedJob -mf
```

This command build a model and a factory for the model

Then let's make a controller

```
php artisan make:controller JobController --model=OfferedJob --resource
```

and then from `DatabaseSeeder.php` seed the database with dummy data
`
