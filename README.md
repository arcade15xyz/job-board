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

and then from `DatabaseSeeder.php` seed the database with dummy data.

## Laravel Debugbar

[The documentation for larave Debugbar](https://github.com/barryvdh/laravel-debugbar?tab=readme-ov-file#debugbar-for-laravel)
To install the DebugBar
```
composer require barryvdh/laravel-debugbar --dev
```
This slows the app but helps in debugging should only work in development phase.


