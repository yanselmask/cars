<!-- Complex options via external local .json file -->
<div class="interactive-map rounded-3"
     data-map-options-json="{{request()->fullUrlWithQuery([
            'markers' => true
                 ])}}"
     style="height: 600px;"></div>
<!-- Examples of .json files with map options you can find in dist/json folder -->
