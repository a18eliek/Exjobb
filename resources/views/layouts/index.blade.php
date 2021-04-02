<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }} - a18eliek :: Exjobb</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{mix ('css/all.css')}}" rel="stylesheet">
        <script type="text/javascript" src="{{mix ('js/app.js')}}"></script>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            @include('layouts/header')

            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 w-9/12">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0 mt-6">
                    <h1 class="text-gray-900 dark:text-white text-3xl">{{ $title }}</h1>
                </div>
                
                <div class="mt-6 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    @yield('content')
                </div>
                @include('layouts/footer')
            </div>
        </div>
        @stack('custom_js')
    </body>
</html>