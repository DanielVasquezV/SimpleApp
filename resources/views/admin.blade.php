<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    
    <title>SimpleApp</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Styles -->
    @vite('resources/css/app.css')

    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>

<body>
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
            <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl whitespace-nowrap dark:text-white">Simple <b>App</b> </span>
            </a>
            <div class="flex items-center space-x-6 rtl:space-x-reverse">
                <a href="{{ route('home') }}" class="text-sm  text-gray-500 dark:text-white hover:underline">Back to home <i class="fa-solid fa-home ml-2"></i></a>
                <a href="{{ route('logout') }}" class="text-sm  text-blue-600 dark:text-blue-500 hover:underline">Logout</a>
            </div>
        </div>
    </nav>
    <main>
        <div class="my-3 w-[80%] m-auto block">
            <span class="text-slate-500">Users</span>
            <p class="font-bold text-3xl text-slate-800">All</p>
            <hr>
        </div>
        <div class="w-[80%] m-auto block">
            <table id="usersTable">
                <thead>
                    <tr>
                        <th>Number of logins</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Last login time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->login_count }}</td>
                            <td><img src="{{ $user->avatar }}" alt="Avatar" class="h-[24px] w-[24px] rounded-full"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->last_login }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="my-3 w-[80%] m-auto block">
            <span class="text-slate-500">Users</span>
            <p class="font-bold text-3xl text-slate-800">Logins</p>
            <hr>
        </div>
        <div class="w-[80%] m-auto block">
            <table id="loginsTable">
                <thead>
                    <tr>
                        <th>Login time</th>
                        <th>Picture</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Host Domain</th>
                        <th>Locale</th>
                        <th>ID</th>
                        <th>Verified Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logins as $login)
                        <tr>
                            <td>{{ $login->login_time }}</td>
                            <td><img src="{{ $login->user->avatar }}" alt="Avatar" class="h-[24px] w-[24px] rounded-full"></td>
                            <td>{{ $login->user->name }} ({{ $login->user->family_name }}, {{ $login->user->given_name }})</td>
                            <td>{{ $login->user->email }}</td>
                            <td>{{ $login->user->workspace_domain }}</td>
                            <td>{{ $login->user->locale ?? '-' }}</td>
                            <td>{{ $login->user->external_id }}</td>
                            <td>
                                @if($login->user->email_verified)
                                    <i class="fas fa-check-circle text-green-500"></i> 
                                @else
                                    <i class="fas fa-times-circle text-red-500"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>