<?php $title = "Vue :: GeoChart"; ?>

@extends('layouts/index') 

@section('content') 
    <div class="text-center">
        <i class="fab fa-vuejs fa-4x text-white"></i>
    </div>
    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">
        <div class="text-center text-white text-3xl">
            GeoChart
        </div>
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center" id="vuejs-geochart">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
    </div>
@stop 

@Push('custom_js')
    <script type="text/javascript" src="{{mix ('js/vue.js')}}"></script>
@endpush