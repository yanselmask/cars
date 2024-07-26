<section class="container pt-4 pb-5 py-sm-5">
    <div class="tns-carousel-wrapper">
        <div class="tns-carousel-inner d-block d-md-flex"
            data-carousel-options='{"controlsContainer": "#external-controls", "nav": false, "gutter": 20, "autoHeight": true}'>
            @foreach ($data['grids'] as $grid)
                <!-- Slide 1-->
                <div>
                    <div class="card card-body p-sm-5 card-light h-100">
                        <div class="row align-items-center py-3 py-sm-0">
                            <div class="col-md-4 col-xl-3 mb-4 pb-3 mb-md-0 pb-md-0 text-center text-md-start">
                                <h2 class="text-light">{{ $grid['title'] }}</h2>
                                <p class="fs-lg text-light opacity-70 pb-md-4">
                                    {{ $grid['description'] }}
                                </p>
                                <a class="btn btn-primary" href="{{ $grid['btn_link'] }}"
                                    target="{{ $grid['btn_target'] }}">
                                    {!! $grid['btn_text'] !!}
                                </a>
                            </div>
                            <div class="col-md-8 col-xl-9">
                                <div class="row row-cols-2 row-cols-lg-4 gy-4 gx-3 gx-sm-4">
                                    @foreach ($grid['products'] as $product)
                                    <a class="col text-light text-decoration-none" href="{{$product['link']}}">
                                        <img class="d-block mb-2 mx-auto" src="{{Storage::url($product['image'])}}"
                                            width="168" alt="{{$product['title']}}" />
                                        <div class="fw-bold text-center pt-1">
                                            {{$product['title']}}
                                        </div>
                                    </a>
                                      @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- External carousel controls-->
    <div class="tns-carousel-controls tns-carousel-light pt-4 pb-2" id="external-controls">
        <button class="me-3" type="button">
            <i class="fi-chevron-left"></i>
        </button>
        <button type="button"><i class="fi-chevron-right"></i></button>
    </div>
</section>
