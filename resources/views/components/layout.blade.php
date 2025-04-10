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
                        {{ auth()->user()->name?? 'Anynomus'}}
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
            <div class=" text-sm bg-modal-red text-slate-50 max-w-1/2 text-center mx-auto p-1.5 border border-red-900 rounded-md font-extrabold">
                {{ session('error') }}
            </div>
        @endif
        {{ $slot }}

    </body>
</html>
