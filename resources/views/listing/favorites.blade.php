<x-app-layout title="{{ 'Favorites - ' . gs('site_name') }}">
    <section class="container mt-5 py-5">
        <!-- Breadcrumb -->
        @include('listing.partials.favorites.breadcrumb')
        <!-- Title -->
        @include('listing.partials.favorites.title')
        <!-- Content -->
        @include('listing.partials.favorites.content')
    </section>
</x-app-layout>
