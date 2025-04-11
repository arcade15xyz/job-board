<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Job Board</title>


        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class=" mx-auto mt-10 max-w-2xl text-slate-700 bg-linear-to-r/decreasing from-indigo-200 to-teal-300">
        <nav class="mb-8 flex justify-between text-lg font-medium">
            <ul class="flex space-x-2">
                <li>
                    <a href="{{ route('jobs.index') }}">Home</a>
                </li>
            </ul>
            <ul class="flex space-x-2">
                @auth
                    <li>
                        <a href="{{ route('my-job-applications.index') }}">
                            {{ auth()->user()->name?? 'Anynomus'}}: Applications
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('auth.destroy') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>Logout</button>
                        </form>
                    </li>
                @else
                    <a href="{{ route('auth.create') }}">Sign in</a>
                @endauth
            </ul>
        </nav>
        @if (session('error'))
            <div role="alert" class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75">
                {{ session('error') }}
            </div>
        @elseif (session('success'))
            <div role="alert" class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75" >
                <p class=" font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        {{ $slot }}

    </body>
</html>
