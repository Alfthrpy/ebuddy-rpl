<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.122.0">

    @include('partials.styles')
    @stack('style')

    <title>{{ $title }} | Home</title>
</head>

<body>
    @include('partials.navbar')

    @yield('base')


    @include('partials.footer')
    @include('partials.scripts')
    @stack('script')
</body>

</html>