<header class="navbar navbar-expand-lg navbar-dark fixed-top" data-scroll-header>
    <div class="container">
        @if(site_logo())
        <a class="navbar-brand me-3 me-xl-4" href="{{ route('home') }}">
            <img class="d-block" src="{{ site_logo() }}" width="116" alt="{{ config('app.name') }}">
        </a>
        @endif
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @if (config('listing.show_signin_button'))
            @guest
                <a class="btn btn-link btn-light btn-sm d-none d-lg-block order-lg-3"
                    href="{{ config('app.url') . '/' . config('listing.vendor_path') }}">
                    <i class="fi-user me-2"></i>{{ __('Sign in') }}</a>
            @endguest
        @endif
        @if (config('listing.show_sell_car_button'))
            @auth
            <a class="btn btn-link btn-light btn-sm d-none d-lg-block order-lg-3"
                    href="{{ config('app.url') . '/' . config('listing.vendor_path') }}">
                    <i class="fi-user me-2"></i>{{ __('Dashboard') }}</a>
            @if (auth()->user()->canPublishListing())
                <a class="btn btn-primary btn-sm ms-2 order-lg-3"
                    href="{{ config('app.url') . '/' . config('listing.vendor_path') . '/listings/create' }}">
                    <i class="fi-plus me-2"></i>{{ __('Sell car') }}
                </a>
            @endif
            @endauth
        @endif
        <!-- MENU -->
        <x-menu :menu='$menu' />
    </div>
</header>
