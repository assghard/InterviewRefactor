<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="Author" content="{{ env('APP_NAME') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        @if(env('APP_ENV') != 'production')
            <meta name="robots" content="noindex, nofollow" />
        @endif

        @section('meta')

        @show

        <title>@section('title')@show</title>

        @stack('style')
    </head>
    <body>
        @include('layouts.partials.header')
        <main id="app">
            <div class="container">
                @include('layouts.partials.notifications')
            </div>

            @yield('content')

            @include('layouts.partials.footer')
        </main>

        @stack('scripts')
    </body>
</html>
