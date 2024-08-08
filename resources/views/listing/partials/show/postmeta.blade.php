<div class="d-flex flex-wrap border-top border-light fs-sm text-light pt-4 pb-5 pb-md-2">
    <div class="border-end border-light pe-3 me-3">
                        <span class="opacity-70">{{ __('Published') }}:
                            <strong>{{ $listing->date }}</strong></span>
    </div>
    <div class="border-end border-light pe-3 me-3">
        <span class="opacity-70">{{ __('Ad number') }}: <strong>{{ $listing->id }}</strong></span>
    </div>
    <div class="opacity-70">{{ __('Views') }}: <strong>{{ $listing->views }}</strong></div>
</div>
