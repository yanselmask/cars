<div class="pb-4 mb-3">
    <h2 class="h4 text-light pt-4 mt-3">{{ __('Seller\'s Description') }}</h2>
    <p class="text-light opacity-70 mb-1">
        {{$listing->description}}
    </p>
    <div class="collapse" id="seeMoreDescription">
        <x-markdown class="text-light opacity-70 mb-1" id="markdownOutput">
            {{$listing->content}}
        </x-markdown>
    </div>
    <a class="collapse-label collapsed" href="#seeMoreDescription" data-bs-toggle="collapse"
       data-bs-label-collapsed="{{__('Show more')}}" data-bs-label-expanded="{{__('Show less')}}" role="button"
       aria-expanded="false" aria-controls="seeMoreDescription"></a>
</div>
