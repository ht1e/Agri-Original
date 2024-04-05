<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/storage/Images/logo/logo.png">
    <title>Document</title>
    @vite('./resources/css/app.css')
</head>
<body class="flex flex-row">
    <aside class="basis-1/6 z-10 h-screen border-r">
        @include('Admin.components.sidebar')
    </aside>
    <div class="basis-5/6 flex flex-col h-screen">
        <header class="w-full h-10 basis-10">
            @include('Admin.components.header')
        </header>
        <main class="grow">
            <div class="content-dashboard w-full h-full">
                @yield('content')
            </div>
        </main>
    </div>
    <footer>
        @include('Admin.components.footer')
    </footer>
    @yield('scripts')
</body>
</html>

