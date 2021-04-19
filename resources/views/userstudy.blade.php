<?php $title = "Användarstudie"; ?>

@extends('layouts/index') 

@section('content') 

    <div class="p-6">
        <div class="text-center text-white text-3xl">
            Stapeldiagram
        </div>
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center" id="react-chart">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
    </div>

    <div class="p-6">
        <div class="text-center text-white text-3xl">
            GeoChart
        </div>
        <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm text-center" id="react-geochart">
            <i class="fas fa-spinner fa-spin"></i>
        </div>
    </div>
@stop 

@Push('custom_js')
    <script type="text/javascript" src="{{mix ('js/react.js')}}"></script>
@endpush