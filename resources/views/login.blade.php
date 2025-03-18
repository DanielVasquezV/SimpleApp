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
    <body class="bg-slate-100 text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <p class="text-[5rem] animate-pulse">Welcome!</p>
        <a href="{{ route('login-google') }}"  class="bg-slate-600 text-white rounded-2xl p-3 cursor-pointer"><i class="fa-brands fa-google mr-2"></i>  Login with Google</a>
    </body>
</html>
