<x-app-layout title="{{ 'Compares - ' . gs('site_name') }}">
    <section class="container mt-5 py-5">
          <!-- Breadcrumb -->
            @include('listing.partials.compares.breadcrumb')
          <!-- Title -->
            @include('listing.partials.compares.title')
          <!-- Content -->
            @include('listing.partials.compares.content')
    </section>
</x-app-layout>
