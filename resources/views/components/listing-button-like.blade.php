 <div class="content-overlay end-0 top-0 pt-3 pe-3">
     <button data-listing="{{ $listing->id }}"
         class="btn-favorite btn btn-icon btn-xs rounded-circle @auth {{ auth()->user()->hasFavorited($listing->id)? 'btn-danger text-white': 'btn-light text-primary' }} @else btn-light text-primary @endauth"
         type="button" data-bs-toggle="tooltip" data-bs-placement="left"
         title="@auth {{ auth()->user()->hasFavorited($listing->id)? __('Remove from favorite'): __('Add to favorite') }} @else {{ __('Add to favorite') }} @endauth">
         <i class="fi-heart"></i>
     </button>
 </div>
