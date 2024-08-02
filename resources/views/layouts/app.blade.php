<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('seo')

    @include('layouts.partials.vendor_css')

    <title>{{ $title ?? gs('site_name') }}</title>
</head>
<body class="bg-dark">
    <!-- Page Content -->
    <main class="page-wrapper">
        <!-- HEADER -->
        <x-header />
        <!-- SLOT -->
        {{ $slot }}
    </main>
    <!-- FOOTER -->
    <x-footer />
    @include('layouts.partials.vendor')
</body>
</html>
