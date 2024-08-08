<div class="d-flex align-items-center">
    <div class="text-light fw-bold text-nowrap pe-1 mb-2">{{ __('Share') }}:</div>
    <div class="d-flex"><a
            class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2 ms-2"
            href="https://www.facebook.com/sharer/sharer.php?u={{ request()->url() }}"
            data-bs-toggle="tooltip" title="{{ __('Share with Facebook') }}"><i
                class="fi-facebook"></i></a><a
            class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2 ms-2"
            href="https://twitter.com/intent/tweet?url={{ request()->url() }}&text={{ $post->description }}"
            data-bs-toggle="tooltip" title="{{ __('Share with Twitter') }}"><i
                class="fi-twitter"></i></a><a
            class="btn btn-icon btn-translucent-light btn-xs rounded-circle mb-2 ms-2"
            href="https://www.linkedin.com/sharing/share-offsite/?url={{ request()->url() }}"
            data-bs-toggle="tooltip" title="{{ __('Share with LinkedIn') }}"><i
                class="fi-linkedin"></i></a></div>
</div>
