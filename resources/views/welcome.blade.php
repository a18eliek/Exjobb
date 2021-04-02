<?php $title = "Pandemic data with Vue & React"; ?>

@extends('layouts/index') 

@section('content') 
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <a class="flex items-center" href="{{ URL::to('react') }}">
                <i class="fab fa-react fa-4x text-white"></i>
                <div class="ml-4 text-lg leading-7 font-semibold"><div class="text-gray-900 dark:text-white">React Charts</div></div>
            </a>

            <div class="pt-3 text-gray-600 dark:text-gray-400 text-sm text-center" id="react-chart">
                <i class="fas fa-spinner fa-spin"></i>
            </div>
            
            <div class="pt-4 text-gray-600 dark:text-gray-400 text-sm text-center" id="react-geochart">
                <i class="fas fa-spinner fa-spin"></i>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
            <a class="flex items-center" href="{{ URL::to('vue') }}">
                <i class="fab fa-vuejs fa-4x text-white"></i>
                <div class="ml-4 text-lg leading-7 font-semibold"><div class="text-gray-900 dark:text-white">Vue.js Charts</div></div>
            </a>

            <div class="pt-3 text-gray-600 dark:text-gray-400 text-sm text-center">
                <div class="text-gray-600 dark:text-gray-400 text-sm text-center" id="vuejs-chart">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
            </div>

            <div class="pt-4 text-gray-600 dark:text-gray-400 text-sm text-center">
                <div class="text-gray-600 dark:text-gray-400 text-sm text-center" id="vuejs-geochart">
                    <i class="fas fa-spinner fa-spin"></i>
                </div>
            </div>
        </div>
    </div>

@stop 

@Push('custom_js')
    <script type="text/javascript" src="{{mix ('js/vue.js')}}"></script>
    <script type="text/javascript" src="{{mix ('js/react.js')}}"></script>
@endpush