<section class="container mb-5 pb-lg-5 pb-2 pb-sm-3">
     <h2 class="h3 text-light pb-2 mb-4">{{ $data['title'] }}</h2>
     <div class="row">
         @foreach (config('spark.billables.user.plans') as $plan)
             <div class="col-sm-6 col-md-4 mb-4">
                 <div class="card card-light border-light">
                     <div class="card-body">
                        @isset($plan['icon'])
                         <img loading="lazy" class="d-block mx-auto mt-2 mb-4" src="{{asset($plan['icon'])}}" width="72" alt="{{__('Icon')}}">
                          @endisset
                         <h2 class="h5 text-light fw-normal text-center py-1 mb-0">{{ $plan['name'] }}</h2>
                         <div class="d-flex align-items-end justify-content-center mb-4">
                             <div class="h1 text-light mb-0">
                               {{$plan['price_formatted']}}
                            </div>
                             <div class="pb-2 ps-2">/{{__('month')}}</div>
                         </div>
                         <ul class="list-unstyled d-block mb-0 mx-auto" style="max-width: 16rem;">
                             @foreach ($plan['features'] as $featured)
                                 @if (str_starts_with($featured,'--'))
                                     <li class="d-flex text-light opacity-50">
                                         <i class="fi-x fs-xs mt-2 me-2"></i>
                                         <span>{{ str_replace('--','',$featured )}}</span>
                                     </li>
                                 @else
                                     <li class="d-flex"><i class="fi-check text-primary fs-sm mt-1 me-2"></i>
                                         <span class="text-light">{{ $featured }}</span>
                                     </li>
                                 @endif
                             @endforeach
                         </ul>
                     </div>
                     <div class="card-footer py-2 border-0">
                         <div class="border-top border-light text-center pt-4 pb-3">
                             <a class="btn {{(isset($plan['featured']) && $plan['featured']) ? 'btn-primary' : 'btn-outline-light'}}"
                                 href="{{config('app.url') . '/billing?subscribe=' . $plan['monthly_id']}}">{{ __('Choose plan') }}</a>
                         </div>
                     </div>
                 </div>
             </div>
         @endforeach
     </div>
 </section>
