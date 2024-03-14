<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://static.vecteezy.com/system/resources/previews/000/623/682/original/agriculture-business-logo-template-unique-green-vector-image.jpg">
    @yield('links')
    @yield('title')
    @vite('./resources/css/app.css')
</head>
<body class="font-poppins relative">

    @yield('alertDialog')
    <header class="w-full h-auto">
        @include('client.components.header')
    </header>

    <main class="w-full h-screen">
        <div class="w-[70%] h-full mx-auto">
            @yield('content')
        </div>
    </main>

    <footer>
        @include('client.components.footer')
    </footer>

    @yield('scripts')
    
</body>
</html>