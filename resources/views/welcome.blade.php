<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Exjobb</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{mix ('css/all.css')}}" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
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
                    <h1 class="text-gray-900 dark:text-white text-3xl">Exjobb - a18eliek</h1>
                </div>
                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6">
                            <div class="flex items-center">
                                <i class="fab fa-react fa-4x" style="color: white"></i>
                                <div class="ml-4 text-lg leading-7 font-semibold"><div class="text-gray-900 dark:text-white">React.js Test output</div></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center" id="react-test">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="flex items-center">
                                <i class="fab fa-vuejs fa-4x" style="color: white"></i>
                                <div class="ml-4 text-lg leading-7 font-semibold"><div class="text-gray-900 dark:text-white">Vue.js Test output</div></div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center" id="vuejs-test">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0">
                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center" id="react-chart">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center" id="vuejs-chart">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
                            <div class="ml-12">
                                <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center" id="vuejs-geochart">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
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
