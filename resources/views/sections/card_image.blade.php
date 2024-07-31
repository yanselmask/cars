@if ($data['image_position'] == 'left')
    <section class="container mb-5 pb-lg-5 pb-2 pb-sm-3">
        <div class="row gy-4 align-items-lg-center">
            @if ($img = $data['image'])
                <div class="col-md-6">
                    <img loading="lazy" class="rounded-3" src="{{ Storage::url($img) }}" alt="{{ $data['title'] }}">
                </div>
            @endif
            <div class="col-lg-5 offset-lg-1 col-md-6 text-md-start text-center">
                <h2 class="mb-md-4 text-light">{{ $data['title'] }}</h2>
                <p class="mb-4 pb-md-3 text-light opacity-70">{{ $data['description'] }}</p>
                <a class="btn btn-primary w-sm-auto w-100" href="{{ $data['btn_link'] }}"
                    target="{{ $data['btn_target'] }}">
                    {!! $data['btn_text'] !!}
                </a>
            </div>
        </div>
    </section>
@else
    <section class="container mb-5 pb-lg-5 pb-2 pb-sm-3">
        <div class="row gy-4 align-items-lg-center">
            <div class="col-lg-5 col-md-6 order-md-1 order-2 text-md-start text-center">
                <h2 class="mb-md-4 text-light">{{ $data['title'] }}</h2>
                <p class="mb-4 pb-md-3 text-light opacity-70">{{ $data['description'] }}</p>
                <a class="btn btn-primary w-sm-auto w-100" href="{{ $data['btn_link'] }}"
                    target="{{ $data['btn_target'] }}">
                    {!! $data['btn_text'] !!}
                </a>
            </div>
            @if ($img = $data['image'])
                <div class="col-md-6 offset-lg-1 order-md-2 order-1">
                    <img loading="lazy" class="rounded-3" src="{{ Storage::url($img) }}" alt="{{ $data['title'] }}">
                </div>
            @endif
        </div>
    </section>
@endif
