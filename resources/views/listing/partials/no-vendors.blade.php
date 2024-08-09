@props([
    'content' => __('We have not found results for your search.')
])
<section class="d-flex align-items-center position-relative min-vh-20">
    <!-- Bg overlay--><span
        class="position-absolute top-50 start-50 translate-middle zindex-1 rounded-circle mt-sm-0 mt-n5"
        style="width: 50vw; height: 50vw; background-color: rgba(83, 74, 117, 0.3); filter: blur(6.4vw);"></span>
    <!-- Overlay content-->
    <div class="container d-flex justify-content-center position-relative zindex-5 text-center">
        <div class="col-lg-8 col-md-10 col-12 px-0">
            <h1 class="display-1 mb-lg-5 mb-4 text-light">{{__('Oops')}}!</h1>
            <div class="ratio ratio-16x9 mx-auto mb-lg-5 mb-4 py-4" style="max-width: 556px;">
                <lottie-player class="py-4" src="{{asset('theme/json/animation-car-finder-404.json')}}" background="transparent"
                               speed="1" loop autoplay></lottie-player>
            </div>
            <p class="h2 mb-lg-5 mb-4 pb-2 text-light">{{ $content }}</p>
        </div>
    </div>
</section>
@push('js-libs')
    <script src="{{asset('theme/js/lottie-player.js')}}"></script>
@endpush
