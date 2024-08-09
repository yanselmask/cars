<meta name="msapplication-TileColor" content="#766df4">
<meta name="theme-color" content="#ffffff">
<!-- Vendor Styles-->
<link rel="stylesheet" media="screen" href="{{ asset('theme/css/simplebar.min.css') }}" />
<link rel="stylesheet" media="screen" href="{{ asset('theme/css/tiny-slider.css') }}" />
<link rel="stylesheet" media="screen" href="https://unpkg.com/nprogress@0.2.0/nprogress.css" />
@stack('css-libs')
<!-- Main Theme Styles + Bootstrap-->
<link rel="stylesheet" media="screen" href="{{ asset('theme/css/theme.min.css') }}">
<style>
    .listing-list.featured::before,
    .listing-list.certified::before,
    .listing-list.certified-featured::before
    {
        position: absolute;
        left: 0;
        bottom: 0;
        padding: 5px 12px;
        border-radius: .5rem;
        z-index: 1000;
    }
    .listing-list.featured::before
    {
        content: "{{__('Featured')}}";
        background-color: var(--fi-primary);
    }
    .listing-list.certified::before
    {
        content: "{{__('Certified')}}";
        background-color: var(--fi-success);
    }
    .listing-list.certified-featured::before
    {
        content: "{{__('Featured and certified')}}";
        background-color: var(--fi-light);
        color: var(--fi-dark);
    }
    .featured
    {
        border: 1.5px solid var(--fi-primary) !important;
    }
    .certified
    {
        border: 1.5px solid var(--fi-success) !important;
    }
    .certified-featured
    {
        border: 2px solid var(--fi-light) !important;
    }
</style>
@stack('css-end')
<!-- Favicon and Touch Icons-->
<link rel="apple-touch-icon" sizes="180x180" href="{{ site_favicon() }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ site_favicon() }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ site_favicon() }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">
