 <section class="container mb-5 pb-lg-5">
     <h2 class="mb-4 pb-2 text-light text-center">{{ $data['title'] }}</h2>
     <!-- Features carousel-->
     <div class="tns-carousel-wrapper tns-nav-outside tns-carousel-light">
         <div class="tns-carousel-inner"
             data-carousel-options="{&quot;items&quot;: 3, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1, &quot;gutter&quot;: 16, &quot;controls&quot;: false},&quot;500&quot;:{&quot;items&quot;:2, &quot;gutter&quot;: 18},&quot;900&quot;:{&quot;items&quot;:3, &quot;gutter&quot;: 20}, &quot;1100&quot;:{&quot;gutter&quot;: 24}}}">
             @foreach ($data['cards'] as $card)
                 <!-- Feature item-->
                 <div>
                     <div class="card card-light card-hover h-100">
                         <div class="card-body icon-box text-center">
                            @if($img = $card['image'])
                             <div class="icon-box-media bg-dark text-light mx-auto mb-3 d-inline-flex align-items-center justify-content-center"
                                 style="width: 4.5rem; height: 4.5rem;">
                                 <img loading="lazy" src="{{Storage::url($img)}}" alt="{{ $card['title'] }}">
                             </div>
                             @endif
                             <h4 class="card-title">{{ $card['title'] }}</h4>
                             <p class="card-text fs-sm opacity-70">{{ $card['description'] }}</p>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </div>
 </section>
