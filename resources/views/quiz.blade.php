<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Quiz</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{mix ('css/all.css')}}" rel="stylesheet">
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 w-9/12">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <h1 class="text-gray-900 dark:text-white text-3xl">Quiz</h1>
                </div>
                
                <div class="mt-4 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div>
                        <div class="p-6 content-center">
                            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center ">
                                {{ Form::open(array('url' => 'quiz/save')) }}
                                <h2 class="text-gray-900 dark:text-white text-2xl">Please select from a scale of 1-6</h2>
                                <div class="mt-4 bg-black dark:bg-gray-500shadow sm:rounded-lg">
                                    {{ Form::radio('scale', '1') }}
                                    {{ Form::radio('scale', '2') }}
                                    {{ Form::radio('scale', '3') }}
                                    {{ Form::radio('scale', '4') }}
                                    {{ Form::radio('scale', '5') }}
                                    {{ Form::radio('scale', '6') }}
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>

                    </div>
                </div>

                <div class="justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="ml-4 text-center text-sm text-gray-500 sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
 
        <script type="text/javascript" src="js/app.js"></script>
    </body>
</html>
