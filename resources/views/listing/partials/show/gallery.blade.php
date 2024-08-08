<div class="tns-carousel-wrapper">
    <div class="tns-slides-count text-light"><i class="fi-image fs-lg me-2"></i>
        <div class="ps-1"><span class="tns-current-slide fs-5 fw-bold"></span><span
                class="fs-5 fw-bold">/</span><span class="tns-total-slides fs-5 fw-bold"></span></div>
    </div>
    <div class="tns-carousel-inner"
         data-carousel-options="{&quot;navAsThumbnails&quot;: true, &quot;navContainer&quot;: &quot;#thumbnails&quot;, &quot;gutter&quot;: 12, &quot;responsive&quot;: {&quot;0&quot;:{&quot;controls&quot;: false},&quot;500&quot;:{&quot;controls&quot;: true}}}">
        @foreach ($listing->media as $photo)
            <div><img loading="lazy" class="rounded-3" src="{{ $photo->getUrl('single') }}"
                      alt="{{ __('Image') }}">
            </div>
        @endforeach
    </div>
</div>
<ul class="tns-thumbnails" id="thumbnails">
    @foreach ($listing->media as $photo)
        <li class="tns-thumbnail">
            <img src="{{ $photo->getUrl('thumb') }}"  alt="{{ __('Thumbnail') }}" />
        </li>
    @endforeach
    @if ($listing->video_link)
        <li class="tns-thumbnail">
            <a class="d-flex flex-column align-items-center justify-content-center w-100 h-100 bg-faded-light rounded text-light text-decoration-none"
               href="{{ $listing->video_link }}" data-bs-toggle="lightbox" data-video="true">
                <i class="fi-play-circle fs-5"></i>
                <span class="opacity-70 mt-1">{{ __('Play video') }}</span>
            </a>
        </li>
    @endif
</ul>
