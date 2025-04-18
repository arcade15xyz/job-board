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

To make components

```
php artisan make:component Card --view
```

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

## Job Page: Job Card & Link Button Components

**Checkout following files**  
`link-button.blade.php`  
`job-card.blade.php`  
and other see in the commit  
and to send values we are using `:` with the parameter name.like `:href={"route(jobs.show), $job"}

## Breadcrumbs for navigation

## Filtering Jobs: Tailwind form plugin & Text Input

Install Tailwind form plugin

```
npm install @tailwindcss/forms
```

thats how the plugins are installed

## Filtering Jobs: Form & Searching for Text in Job Posts

## Filtering Jobs: Min and Max Salary

## Filtering Radio Button Filters

## Filtering Radio Group component

## Filtering : Configuring Labels and Talking about Arrays in php

## Filtering jobs: Clearing the Input

## Refactor time: Gradient Background, Styling Button, Adding Alpine.js

## Refactor Time: Plain Vanilla JavaScript to Alpine.js

## Refactor Filtering backend logic

in replace use regular expression
`request\('([a-z_]+)'\)` for `$filter['([a-z_]+)']`

done in following files

1. JobController.php
2. OfferedJob.php

## Employer : Model, Migration, Relation

## Employer: Factory and seeder

## Employer: Searching by Employer Name

When filtering on a nested relationship use the below:

```php
    ->orWhereHas('employer', function ($query) use ($search) {
        $query->where(column: 'company_name', operator: 'like', value: '%' . $search . '%');
    });
```

## Employer: Other Employer Jobs on the Job Page

## Authentication Sign in Form

## Authentication Sign in Logic

## Applying for jobs : model ,migrations, factory and relations

## Applying for jobs: Controller, Routing and Application Form

## Applying for Jobs:The Logic

## Applying for Jobs: The Job Policy

**To build a policy**

```
php artisan make:policy JobPolicy --model=OfferedJob
```

## Applying for Job: already applied or not

## File Uploads: Uploading Files

Lets first check `config\filesystems.php` in there there are files related configurations.  
Now send these command in the _Terminal_

```
php artisan make:migration AddCvPathToJobApplicationsTable
```

and in _migration_ file add this `cv_path` in `job_applications`

```php
    public function up(): void
    {
        Schema::table('job_applications', function (Blueprint $table) {
            $table->string('cv_path')->nullable();
        });
    }
```

This command adds a new column `cv_path` to the `job_applications` table.  
Then in `JobApplication` model add `'cv_path'` in `$fillable`.  
Then finally in `JobApplicationController`

```php
   public function store(Request $request, OfferedJob $job)
    {
        Gate::authorize('apply', $job);

        $validateData = $request->validate([
            'expected_salary' => 'required|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);


        /**
         * storing the files
         */
        $file = $request->file('cv');
        $path = $file->store('cvs', 'local');


        $job->jobApplications()->create(
            [
                'user_id' => $request->user()->id,
                'expected_salary' => $validateData['expected_salary'],
                'cv_path'=>$path
            ]
        );
        return redirect()->route('jobs.show', $job)
            ->with('success', 'Job application submitted.');
    }
```

Like above the files are stored in `storage\app\private\cvs`.  
Then finally in `<form>`
add the `enctype="multipart/form-data"` after that the data will be sent as request.

## Soft Deletes

soft deletes in Laravel lets you “delete” records without actually removing them from the database. Instead, Laravel sets a deleted_at timestamp — this allows you to:

1. Hide the record from normal queries

2. Restore it later if needed

3. Maintain foreign key relationships without breaking things

first lets make a new migration

```
php artisan make:migration AddSoftDeletesToJobsTable
```

In this migration now

```
php artisan migrate
```

then in migration

```php
$table->softDeletes(); // adds a deleted_at column
```

then in model

```php
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferedJob extends Model
{
    use HasFactory, SoftDeletes;

    // ...
}
```

To include soft deleted:

```php
OfferedJob::withTrashed()->get();
```

To only get soft deleted jobs:

```php
OfferedJob::onlyTrashed()->get();
```

To restore:

```php
$job->restore();
```
