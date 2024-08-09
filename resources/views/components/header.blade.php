<header class="navbar navbar-expand-lg navbar-dark fixed-top" data-scroll-header>
    <div class="container">
        @if(site_logo())
        <a class="navbar-brand me-3 me-xl-4" href="{{ route('home') }}">
            <img class="d-block" src="{{ site_logo() }}" width="116" alt="{{ config('app.name') }}">
        </a>
        @endif
            @if (!menu('mobile-menu'))
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDarkNav" aria-controls="navbarDarkNav" aria-expanded="false" aria-label="{{__('Toggle navigation')}}"><span class="navbar-toggler-icon"></span></button>
            @endif
        @if (config('listing.show_signin_button'))
            @guest
                <a class="btn btn-link btn-light btn-sm d-none d-lg-block order-lg-3"
                    href="{{ getPath('vendor',true) }}">
                    <i class="fi-user me-2"></i>{{ __('Sign in') }}</a>
            @endguest
        @endif
        @if (config('listing.show_sell_car_button'))
            @auth
                @role('Super Admin')
                    <a class="btn btn-link btn-light btn-sm d-none d-lg-block order-lg-3"
                       href="{{ getPath('admin',true) }}">
                        <i class="fi-user me-2"></i>{{ __('Dashboard') }}</a>
                @else
                    <a class="btn btn-link btn-light btn-sm d-none d-lg-block order-lg-3"
                       href="{{ auth()->user()->isSeller() ? getPath('vendor', true) : getPath('vendor', true) . 'edit-profile' }}">
                        <i class="fi-user me-2"></i>{{ __('Dashboard') }}</a>
                @endrole
            @if (auth()->user()->canPublishListing())
                        @role('Super Admin')
                        <a class="btn btn-primary btn-sm ms-2 order-lg-3"
                           href="{{ getPath('admin', true) . 'listings/create' }}">
                            <i class="fi-plus me-2"></i>{{ __('Sell car') }}
                        </a>
                    @else
                        <a class="btn btn-primary btn-sm ms-2 order-lg-3"
                            href="{{ getPath('vendor', true) . 'listings/create' }}">
                            <i class="fi-plus me-2"></i>{{ __('Sell car') }}
                        </a>
                        @endrole
            @endif
            @endauth
        @endif
        <!-- MENU -->
            <x-menu menu="header" />
    </div>
</header>
