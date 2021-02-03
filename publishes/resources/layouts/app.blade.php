@extends('adminlte::page')

@section('css')
    <link rel="stylesheet" href="{{ asset('dist/css/vendor.css')}} ">
@stop

@section('js')
    @parent
    <script type="text/javascript">
        var _token = '{!! csrf_token() !!}';
        var _url = '{!! url("/") !!}';
    </script>
    <script src="{{ asset('dist/js/vendor.js')}}"></script>
    <script src="{{ asset('dist/js/cms.js')}}"></script>
    @stack('javascript')
    @yield('javascript')
@stop