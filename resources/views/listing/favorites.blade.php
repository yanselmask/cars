<x-app-layout title="{{ 'Favorites - ' . gs('site_name') }}">
    <section class="container mt-5 py-5">
        <!-- Breadcrumb-->
        <x-breadcrumb active="{{__('Favorites')}}" :routes="[
            [
                'name' => 'Home',
                'link' => route('home'),
            ],
        ]" />
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h2 class="h3 text-light mb- mb-sm-0">{{ __('Favorites') }}</h2>
        </div>
        <div class="row">
            @forelse ($listings as $listing)
                <div class="col-sm-12 col-md-4 col-lg-4 mb-4">
                    <x-listing-grid :listing="$listing" />
                </div>
            @empty
                <h3 class="text-white text-center">{{ __('You don\'t have a list in favorites') }}</h3>
            @endforelse
            @if($listings != [])
            {{ $listings->links() }}
                @endif
        </div>
    </section>
</x-app-layout>
