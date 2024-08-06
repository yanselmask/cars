
<!-- Loading placeholders example -->
@if($view == 'grid')
<div class="card card-light border-0 shadow placeholder-loading d-none" aria-hidden="true">
    <div class="position-relative placeholder-wave">
        <div class="card-img-top placeholder ratio ratio-16x9"></div>
        <i class="fi-image position-absolute top-50 start-50 translate-middle fs-1 opacity-40"></i>
    </div>
    <div class="card-body">
        <h5 class="card-title placeholder-glow">
            <span class="placeholder col-6"></span>
        </h5>
        <p class="card-text placeholder-glow">
            <span class="placeholder placeholder-sm col-7 me-2"></span>
            <span class="placeholder placeholder-sm col-4"></span>
            <span class="placeholder placeholder-sm col-4 me-2"></span>
            <span class="placeholder placeholder-sm col-6"></span>
            <span class="placeholder placeholder-sm col-8"></span>
        </p>
        <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6 placeholder-wave"></a>
    </div>
</div>
@else
<!-- Light card on dark background: Horizontal -->
<div class="card card-light card-hover card-horizontal mb-3 placeholder-loading d-none">
    <div class="card-img-top placeholder ratio ratio-16x9"></div>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between pb-1">
                <span class="placeholder placeholder-sm col-1 me-2"></span>
            </div>
            <h3 class="h6 mb-1">
                <span class="placeholder placeholder-sm col-7 me-2 text-light"></span>
            </h3>
            <span class="placeholder placeholder-sm col-2 me-2 text-light"></span>
            <div class="fs-sm text-light">
                <span class="placeholder placeholder-sm col-2 me-2 text-light"></span>
            </div>
            <div class="border-top border-light mt-3 pt-3">
                <div class="row g-2">
                    <div class="col me-sm-1">
                        <div class="bg-dark rounded text-center w-100 h-100 p-2">
                            <span class="placeholder placeholder-sm col-2 me-2 text-light"></span>
                        </div>
                    </div>
                    <div class="col me-sm-1">
                        <div class="bg-dark rounded text-center w-100 h-100 p-2">
                            <span class="placeholder placeholder-sm col-2 me-2 text-light"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="bg-dark rounded text-center w-100 h-100 p-2">
                            <span class="placeholder placeholder-sm col-2 me-2 text-light"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
