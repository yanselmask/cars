<div class="d-sm-flex align-items-center justify-content-between pb-4 mb-2">
    <div class="d-flex align-items-center me-sm-4">
        <label class="fs-sm text-light me-2 pe-1 text-nowrap" for="sort">
            <i class="fi-arrows-sort mt-n1 me-2"></i>{{ __('Sort by') }}:
        </label>
        <select id="sort" class="form-select form-select-light form-select-sm me-sm-4">
            <option value="desc" @selected(request()->query('sort') == 'desc')>{{ __('Newest') }}</option>
            <option value="asc" @selected(request()->query('sort') == 'asc')>{{ __('Oldest') }}</option>
            <option value="price_low" @selected(request()->query('sort') == 'price_low')>{{ __('Price: Low - High') }}
            </option>
            <option value="price_hight" @selected(request()->query('sort') == 'price_hight')>{{ __('Price: Hight - Low') }}
            </option>
            <option value="popular" @selected(request()->query('sort') == 'popular')>{{ __('Popular') }}</option>
        </select>
        <div class="d-none d-md-block border-end border-light" style="height: 1.25rem;"></div>
        <div class="d-none d-sm-block fw-bold text-light opacity-70 text-nowrap ps-md-4">
            <i class="fi-switch-horizontal me-2" style="cursor: pointer;" id="to-compare"></i>
            <span class="align-middle compareCount">{{ __('Compare (:qty)', ['qty' => auth()?->user()?->comparedListings()->count() ?? 0 ]) }}</span>
        </div>
        <div class="d-flex d-sm-none">
            <a class="nav-link nav-link-light px-2 {{ request()->query('view') == 'list' || request()->query('view') == 'grid' || (!request()->query('view') && config('listing.listing_result_view') == 'list' ?? !request()->query('view') && config('listing.listing_result_view') == 'grid') ? 'active' : '' }}"
               onclick="addLinkQuery('list', 'view')" href="javascript:;"
               data-bs-toggle="tooltip" title="{{ __('List view') }}">
                <i class="fi-list"></i>
            </a>
            <a class="nav-link nav-link-light px-2 {{ request()->query('view') == 'map' || !request()->query('view') && config('listing.listing_result_view') == 'map' ? 'active' : '' }}"
               onclick="addLinkQuery('map', 'view')" href="javascript:;"
               data-bs-toggle="tooltip" title="{{ __('Map view') }}">
                <i class="fi-map-pin"></i>
            </a>
            <a class="nav-link nav-link-light px-2 {{ request()->query('view') == 'short' || !request()->query('view') && config('listing.listing_result_view') == 'short' ? 'active' : '' }}"
               onclick="addLinkQuery('short', 'view')" href="javascript:;"
               data-bs-toggle="tooltip" title="{{ __('Short view') }}">
                <i class="fi-play-circle"></i>
            </a>
        </div>
    </div>
    <div class="d-none d-sm-flex">
        <a class="nav-link nav-link-light px-2 {{ request()->query('view') == 'list' || !request()->query('view') && config('listing.listing_result_view') == 'list' ? 'active' : '' }}"
           onclick="addLinkQuery('list', 'view')" href="javascript:;"
           data-bs-toggle="tooltip" title="{{ __('List view') }}">
            <i class="fi-list"></i>
        </a>
        <a class="nav-link nav-link-light px-2 {{ request()->query('view') == 'grid' || !request()->query('view') && config('listing.listing_result_view') == 'grid' ? 'active' : '' }}"
           onclick="addLinkQuery('grid', 'view')" href="javascript:;"
           data-bs-toggle="tooltip" title="{{ __('Grid view') }}">
            <i class="fi-grid"></i>
        </a>
        <a class="nav-link nav-link-light px-2 {{ request()->query('view') == 'map' || !request()->query('view') && config('listing.listing_result_view') == 'map' ? 'active' : '' }}"
           onclick="addLinkQuery('map', 'view')" href="javascript:;"
           data-bs-toggle="tooltip" title="{{ __('Map view') }}">
            <i class="fi-map-pin"></i>
        </a>
        <a class="nav-link nav-link-light px-2 {{ request()->query('view') == 'short' || !request()->query('view') && config('listing.listing_result_view') == 'short' ? 'active' : '' }}"
           onclick="addLinkQuery('short', 'view')" href="javascript:;"
           data-bs-toggle="tooltip" title="{{ __('Short view') }}">
            <i class="fi-play-circle"></i>
        </a>
    </div>
</div>
