 <section class="container mb-5 pb-lg-5 pb-3 pb-sm-4">
     <h2 class="mb-4 pb-2 text-light text-center">{{$data['title']}}</h2>
     <div class="mx-auto" style="max-width: 864px;">
         <div class="steps steps-light steps-vertical">
            @foreach ($data['cards'] as $card)
             <div class="step">
                 <div class="step-progress"><span class="step-progress-end"></span><span
                         class="step-number bg-primary shadow-hover">{{$loop->index + 1}}</span></div>
                 <div class="step-label">
                     <h3 class="h5 mb-2 pb-1 text-light">{{$card['title']}}</h3>
                     <p class="mb-0">{{$card['description']}}</p>
                 </div>
             </div>
             @endforeach
         </div>
     </div>
 </section>
