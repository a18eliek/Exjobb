<?php $title = "Pandemic data with Vue & React"; ?>

@extends('layouts/index') 

@section('content') 
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <a class="flex items-center" href="{{ URL::to('react') }}">
                <i class="fab fa-react fa-4x text-white"></i>
                <div class="ml-4 text-lg leading-7 font-semibold"><div class="text-gray-900 dark:text-white">React Charts</div></div>
            </a>
            <p class="text-center text-white">
                Please select what charts you want to take a look at:
            </p>
            <div class="text-center flex">
                <a class="flex-1 mt-4 mr-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-lg" href="{{ URL::to('react/geochart') }}">
                    <i class="fab fa-react fa-1x text-white"></i> GeoChart
                </a>
                
                <a class="flex-1 mt-4 mr-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-lg" href="{{ URL::to('react/barchart') }}">
                    <i class="fab fa-react fa-1x text-white"></i> BarChart
                </a>

                <a class="flex-1 mt-4 mr-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-lg" href="{{ URL::to('react') }}">
                    <i class="fab fa-react fa-1x text-white"></i> Both
                </a>
            </div>
        </div>

        <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
            <a class="flex items-center" href="{{ URL::to('vue') }}">
                <i class="fab fa-vuejs fa-4x text-white"></i>
                <div class="ml-4 text-lg leading-7 font-semibold"><div class="text-gray-900 dark:text-white">Vue.js Charts</div></div>
            </a>

            <p class="text-center text-white">
                Please select what charts you want to take a look at:
            </p>
            <div class="text-center flex">
                <a class="flex-1 mt-4 mr-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-lg" href="{{ URL::to('vue/geochart') }}">
                    <i class="fab fa-vuejs fa-1x text-white"></i> GeoChart
                </a>
                
                <a class="flex-1 mt-4 mr-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-lg" href="{{ URL::to('vue/barchart') }}">
                    <i class="fab fa-vuejs fa-1x text-white"></i> BarChart
                </a>

                <a class="flex-1 mt-4 mr-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-lg" href="{{ URL::to('vue') }}">
                    <i class="fab fa-vuejs fa-1x text-white"></i> Both
                </a>
            </div>
        </div>
    </div>

@stop 