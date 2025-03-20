<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SimpleApp</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100 text-[#1b1b18]">
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl whitespace-nowrap dark:text-white">Simple <b>App</b> </span>
            </a>
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                @if (session('admin'))
                <a href="{{ route('admin') }}" class="text-sm  text-gray-500 dark:text-white hover:underline">Admin Dashboard <i class="fa-solid fa-up-right-from-square ml-2"></i></a>
                @endif
                <a href="{{ route('logout') }}" class="text-sm  text-blue-600 dark:text-blue-500 hover:underline">Logout</a>
            </div>
        </div>
    </nav>

    <main class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center py-8">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{ Auth::user()->avatar }}" alt="Bonnie image" />
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</span>
                <span class="text-white mb-2">Times logged: {{ Auth::user()->login_count }}</span>
            </div>
        </div>
    </main>
</body>

</html>