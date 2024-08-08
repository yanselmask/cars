<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h2 class="h3 text-light mb- mb-sm-0">{{ __('Compares') }}</h2>
    @auth
        @if(auth()->user()->comparedListings()->count())
        <a onclick="return confirm(@js(__('Are you sure you want to clean this list?')))" class="btn btn-xs" href="{{route('remove.compares')}}">{{__('X Clear compares')}}</a>
        @endif
    @endauth
</div>
