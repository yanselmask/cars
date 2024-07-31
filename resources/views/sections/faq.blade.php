<section class="container mb-5 pb-2 pb-lg-5">
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="d-flex flex-column text-md-start text-center">
                <div class="order-md-1 order-2 mx-md-0 mx-auto mb-md-5 mb-4" style="max-width: 416px;">
                    <h2 class="mb-md-3 mb-2 text-light">{{ $data['title'] }}</h2>
                    <p class="mb-4 pb-md-2 text-light opacity-70">{{ $data['description'] }}</p>
                    <a class="btn btn-primary w-sm-auto w-100" href="{{ $data['btn_link'] }}"
                        target="{{ $data['btn_target'] }}">
                        {!! $data['btn_text'] !!}
                    </a>
                </div>
                @if ($img = $data['image'])
                    <div class="order-md-2 order-1"><img loading="lazy" src="{{ Storage::url($img) }}" alt="{{ $data['title'] }}">
                    </div>
                @endif
            </div>
        </div>
        <!-- Accordion-->
        <div class="col-md-6 offset-lg-1">
            <div class="accordion accordion-light" id="accordionFAQ">
                @foreach ($data['faqs'] as $faq)
                    <!-- Acordion item-->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                            <button class="accordion-button @if(!$faq['is_open']) collapsed @endif" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="true"
                                aria-controls="collapse-{{ $loop->index }}">
                                {{ $faq['title'] }}
                            </button>
                        </h2>
                        <div class="accordion-collapse collapse @if($faq['is_open']) show @endif" aria-labelledby="heading-{{ $loop->index }}"
                            data-bs-parent="#accordionFAQ" id="collapse-{{ $loop->index }}">
                            <div class="accordion-body text-light opacity-70">
                                {{ $faq['description'] }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
