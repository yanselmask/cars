@if($listing->is_featured && !$listing->is_certified)
    featured
@endif
@if($listing->is_certified && !$listing->is_featured)
    certified
@endif
@if($listing->is_certified && $listing->is_featured)
    certified-featured
@endif
