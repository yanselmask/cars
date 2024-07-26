<section class="container mb-5 pb-lg-5">
    <div class="row align-items-center justify-content-lg-start justify-content-center flex-lg-nowrap gy-4">
        @if(isset($data['image']))
        <div class="col-lg-9">
            <img class="rounded-3" src="{{ Storage::url($data['image']) }}" alt="{{ $data['title'] }}">
        </div>
        @endif
        <div class="col-lg-4 ms-lg-n5 col-sm-9 text-lg-start text-center">
            <div class="ms-lg-n5 pe-xl-5">
                <h1 class="mb-lg-4 text-light">{{ $data['title'] }}</h1>
                <p class="mb-4 pb-lg-3 fs-lg text-light opacity-70">{{ $data['description'] }}</p>
                <a class="btn btn-lg btn-{{ $data['btn_color'] ?? 'primary' }} w-sm-auto w-100"
                    href="{{ $data['btn_link'] }}" target="{{ $data['btn_target'] }}">
                    {!! $data['btn_text'] !!}
                </a>
            </div>
        </div>
    </div>
</section>
