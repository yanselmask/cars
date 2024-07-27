<div class="position-absolute start-0 top-0 pt-3 ps-3">
            <span
                class="d-table badge bg-info @if ($listing->is_certified || $listing->is_featured) mb-2 @endif">{{ $listing->condition->name }}</span>
            @if ($listing->is_certified)
                <span class="d-table badge bg-success @if ($listing->is_featured) mb-2 @endif"
                    data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover" data-bs-html="true"
                    data-bs-content="<div class=&quot;d-flex&quot;><i class=&quot;fi-award mt-1 me-2&quot;></i><div>{{ __('This car is checked and') }}<br>{{ __('certified by :site', ['site' => site_name()]) }}.</div></div>">{{ __('Certified') }}</span>
            @endif
            @if ($listing->is_featured)
                <span class="d-table badge bg-danger">{{ __('Featured') }}</span>
            @endif
</div>
