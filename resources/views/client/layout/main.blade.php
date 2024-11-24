<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://newtechvietnam.com/wp-content/uploads/2024/01/LOGO-1.png">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/assets/css/chat.min.css"> --}}
    @yield('links')
    @yield('title')
    @vite('./resources/css/app.css')
</head>

{{-- @php
    
$api = 'http://127.0.0.1:5557/apiRecomend?id=1';
$id = 1;
$data = file_get_contents($api);
$response_data = json_decode($data);
// dd($response_data);
$user_data = $response_data->data;
dd($user_data);

@endphp --}}
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
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
    <script>
        var botmanWidget = {
            title: 'NewTech VietNam',
            aboutText: 'Botman',
            introMessage: "Xin chào, Tôi có thể giúp gì cho bạn? nhập 'bắt đầu' để bắt đầu cuộc trò chuyện",
            desktopWidth: 300,
            desktopHeight: 370
        };
    </script>

    {{-- <div id="rasa-chat-widget" data-websocket-url="https://your-rasa-url-here/"></div>
    <script src="https://unpkg.com/@rasahq/rasa-chat" type="application/javascript"></script> --}}

    {{-- @include('client.components.chatbot') --}}

   
    
    {{-- @vite('./resources/js/client/test.js') --}}

    @vite('./resources/js/client/recomend.js')
</body>
</html>