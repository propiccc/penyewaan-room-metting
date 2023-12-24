<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="{{asset('build/assets/app-800ca8d0.js')}}"></script>
    <link rel="stylesheet" href="{{asset('build/assets/app-26f72382.css')}}">

    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('VITE_MIDRANS_CLIENT_KEY') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title')</title>
</head>
    <body class="scrollbar-none">
        @include('Components.NavbarPemesanan')
        @yield('content')
        @yield('scripts')
    </body>
<style>
    .scrollbar-none::-webkit-scrollbar {
        display: none;
    }
</style>

</html>
