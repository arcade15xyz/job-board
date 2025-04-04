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
When we want **Debugbar** to not work simply change `APP_DEBUG=false` in `.env`.

## Setting Up Tailwind CSS using Vite (and Node)

[INSTALLATION GUIDE](https://tailwindcss.com/docs/installation/framework-guides/laravel/vite)

## Layouts using Components

[Building layout Guides](https://laravel.com/docs/11.x/blade#building-layouts)

🚀. First make a components

```
php artisan make:component Layout --view
```

🚀. Code a layout

```php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Job Board</title>




        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body>
        {{ $slot }}
    </body>
</html>
```

`{{ $slot }}` defines the place where a component(a view code) can be inserted.  
Then in `views/jobs/index.blade.php`

```php
<x-layout>
    @foreach($jobs as $job)
        <div>
            {{ $job->title }}
        </div>
    @endforeach
</x-layout>
```

This is sent in `{{ $slot }}`using `<x-layout></x-layout>`. And now in routes

```php
    Route::resource('jobs', JobController::class)
        ->only(['index']);
```

and finally in controller

```php
    Route::resource('jobs', JobController::class)
        ->only(['index']);
```

## Job Pages and Card components

[Guide on Card](https://laravel.com/docs/11.x/blade#components)

In `index.blade.php`

```php
<x-layout>
    @foreach($jobs as $job)
        <x-card class="mb-4">
            {{ $job->title }}
        </x-card>
    @endforeach
</x-layout>

```

we are making _card component_ in there we use

```php
<div>
    <div {{ $attributes->class(['rounded-md border border-slate-300 bg-white p-4 shadow-sm']) }}>
        {{ $slot }}
    </div>
</div>
```

now we are adding or merging class using `$attribute->class(['rounded-md border border-slate-300 bg-white p-4 shadow-sm'])`

## Jobs Page: Tag Component & Job info

now we made a component `tag.blade.php` which is built for _tags_ and reuse of the code. like we can see in `index.blade.php`.  
In `index.blade.php`

```php
    <x-tag>{{ Str::ucfirst($job->experience) }}</x-tag>
    <x-tag>{{ $job->category }}</x-tag>
```
