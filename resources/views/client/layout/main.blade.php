<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://newtechvietnam.com/wp-content/uploads/2024/01/LOGO-1.png">
    @yield('links')
    @yield('title')
    @vite('./resources/css/app.css')
</head>
<body class="font-poppins relative">

    @yield('alertDialog')
    <header class="w-full h-auto">
        @include('client.components.header')
    </header>

    <main class="w-full ">
        <div class="w-[70%] min-h-screen mx-auto">
            @yield('content')
        </div>
    </main>

    <footer class="">
        @include('client.components.footer')
    </footer>

    @yield('scripts')
    
</body>
</html>