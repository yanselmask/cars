<div class="position-relative py-4 mb-2">
    <a class="btn btn-icon btn-light-primary text-primary rounded-circle position-absolute start-50 top-50 translate-middle zindex-5" href="{{$data['content']}}" data-bs-toggle="lightbox" data-video="true" style="width: 4.5rem; height: 4.5rem;">
        <i class="fi-play-filled fs-sm"></i>
    </a>
    <img class="opacity-60 rounded-3" src="{{Storage::url($data['image'])}}" alt="{{__('Video cover')}}">
</div>

@pushonce('css-libs')
    <link rel="stylesheet" href="{{asset('theme/css/lightgallery-bundle.min.css')}}">
@endpushonce
@pushonce('js-libs')
        <script src="{{asset('theme/js/lightgallery.min.js')}}"></script>
        <script src="{{asset('theme/js/lg-fullscreen.min.js')}}"></script>
        <script src="{{asset('theme/js/lg-zoom.min.js')}}"></script>
        <script src="{{asset('theme/js/lg-video.min.js')}}"></script>
        <script src="{{asset('theme/js/lg-thumbnail.min.js')}}"></script>
@endpushonce
