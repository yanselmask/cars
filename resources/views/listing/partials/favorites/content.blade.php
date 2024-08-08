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
