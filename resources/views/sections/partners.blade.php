 <section class="container mb-5 pb-lg-5 pb-2 pb-sm-3">
     <h2 class="mb-4 pb-2 text-center text-light">{{ $data['title'] }}</h2>
     <div class="tns-carousel-wrapper tns-nav-outside tns-nav-outside-flush">
         <div class="tns-carousel-inner"
             data-carousel-options="{&quot;items&quot;: 6, &quot;controls&quot;: false, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;500&quot;:{&quot;items&quot;:4}, &quot;992&quot;:{&quot;items&quot;:5, &quot;gutter&quot;: 16}, &quot;1200&quot;:{&quot;items&quot;:6, &quot;gutter&quot;: 24}}}">
             @foreach ($data['partners'] as $partnert)
             <div>
                 <a class="opacity-40 opacity-transition" href="{{$partnert['link']}}">
                     <img loading="lazy" class="swap-to" src="{{Storage::url($partnert['image'])}}" alt="Logo" width="196">
                 </a>
             </div>
              @endforeach
         </div>
     </div>
 </section>
