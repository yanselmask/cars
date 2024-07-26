<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @notifyCss

    <!-- Vendor Styles-->
    <link rel="stylesheet" media="screen" href="{{ asset('theme/css/simplebar.min.css') }}" />
    <link rel="stylesheet" media="screen" href="{{ asset('theme/css/tiny-slider.css') }}" />

    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{ asset('theme/css/theme.min.css') }}">

    @stack('css-libs')

    <!-- Favicon and Touch Icons-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ site_favicon() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ site_favicon() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ site_favicon() }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="msapplication-TileColor" content="#766df4">
    <meta name="theme-color" content="#ffffff">

    @stack('seo')

     <title>{{ $title ?? gs('site_name') }}</title>

</head>

<body class="bg-dark">
    <!-- Page Content -->
    <main class="page-wrapper">
        @include('notify::components.notify')
        <!-- HEADER -->
        <x-header />
        <!-- SLOT -->
        {{ $slot }}
    </main>
    <!-- FOOTER -->
    <x-footer />
    <!-- Back to top button--><a class="btn-scroll-top" href="#top" data-scroll><span
            class="btn-scroll-top-tooltip text-muted fs-sm me-2">{{ __('Top') }}</span><i
            class="btn-scroll-top-icon fi-chevron-up"> </i></a>
    <!-- Vendor scrits: js libraries and plugins-->
    <script src="{{ asset('theme/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('theme/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/js/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ asset('theme/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('theme/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('theme/js/jarallax.min.js') }}"></script>
    <script src="{{ asset('theme/js/rellax.min.js') }}"></script>

    @stack('js-libs')
    <script>
        const btns = document.querySelectorAll('.btn-favorite');
        const btnscompare = document.querySelectorAll('.btn-compare');
        if (btns) {
            btns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    togglePath(btn.getAttribute('data-listing'), @js(route('add.favorite.listing')))
                })
            })
        }

        if (btnscompare) {
            btnscompare.forEach((btn) => {
                btn.addEventListener('click', () => {
                    togglePath(btn.getAttribute('data-listing'), @js(route('add.compare.listing')))
                })
            })
        }

        const togglePath = async (id, url) => {
            try {
                const request = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': @js(csrf_token()),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        listing: id
                    })
                });
                const response = await request.json();
                if (response.message) {
                    location.reload();
                }
            } catch (error) {
                console.log(error);
            }
        }
    </script>
    <!-- Main theme script-->
    <script src="{{ asset('theme/js/theme.min.js') }}"></script>
    @notifyJs
</body>

</html>
