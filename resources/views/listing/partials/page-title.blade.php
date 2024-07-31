<div class="d-flex align-items-center justify-content-between pb-4 mb-2">
    <h1 class="text-light me-3 mb-0">{{ __('Search listing') }}</h1>
    <div class="text-light">
        <i class="fi-car fs-lg me-2"></i>
        <span class="align-middle">{{ __(':qty offers', ['qty' => $listings->total()]) }}</span>
    </div>
</div>
