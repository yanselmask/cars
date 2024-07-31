 <section class="container pt-4 pt-md-5">
     <div class="d-sm-flex align-items-center justify-content-between">
         <h2 class="h3 text-light mb-2 mb-sm-0">{{ $data['title'] }}</h2>
         @if ($data['btn_text'])
             <a class="btn btn-link btn-light fw-normal px-0" href="{{ $data['btn_link'] }}"
                 target="{{ $data['btn_target'] }}">{{ $data['btn_text'] }}
                 <i class="fi-arrow-long-right fs-sm mt-0 ps-1 ms-2"></i>
             </a>
         @endif
     </div>
     <div class="row">
         <div class="col-md-5 col-lg-4 offset-lg-1 pt-4 mt-2 pt-md-5 mt-md-3">
             @foreach (collect($data['list'])->slice(0,3) as $item)
                 <div class="d-flex pb-4 pb-md-5 mb-2">
                     <i class="{{$item['icon']}} lead text-primary mt-1 order-md-2"></i>
                     <div class="text-md-end ps-3 ps-md-0 pe-md-3 order-md-1">
                         <h3 class="h6 text-light mb-1">{{$item['title']}}</h3>
                         <p class="fs-sm text-light opacity-70 mb-0">
                             {{$item['description']}}
                         </p>
                     </div>
                 </div>
             @endforeach
         </div>
         <div class="col-md-2 d-none d-md-block">
             <div class="position-relative mx-auto h-100" style="max-width: 5rem; min-height: 26rem">
                 <div class="rellax content-overlay pt-5" data-rellax-percentage="0.5">
                     <img loading="lazy" class="pt-3 mt-5" src="{{asset('theme/img/car.svg')}}" alt="{{__('Car')}}" />
                 </div>
                 <div class="position-absolute top-0 start-50 translate-middle-x h-100 overflow-hidden">
                     <img loading="lazy" src="{{asset('theme/img/road-line.svg')}}" width="2" alt="{{__('Road line')}}" />
                 </div>
             </div>
         </div>
         <div class="col-md-5 col-lg-4 pt-md-5 mt-md-3">
            @foreach (collect($data['list'])->slice(3,6) as $item)
             <div class="d-flex pb-4 pb-md-5 mb-2">
                 <i class="{{$item['icon']}} lead text-primary mt-1"></i>
                 <div class="ps-3">
                     <h3 class="h6 text-light mb-1">{{$item['title']}}</h3>
                     <p class="fs-sm text-light opacity-70 mb-0">
                        {{$item['description']}}
                     </p>
                 </div>
             </div>
             @endforeach
         </div>
     </div>
 </section>
