<!-- Dark navbar: Light links against dark background -->
@if(menu('mobile-menu'))
<header class="navbar navbar-dark bg-dark fixed-bottom d-lg-none">
    <div class="container">
            @foreach(menu('mobile-menu')->items as $item)
                <a href="{{$item['data']['url']}}" class="btn btn-dark @if(strlen($item['data']['url']) == 1 && request()->routeIs('home')) active @endif @if(request()->path() == substr($item['data']['url'], 1)) active @endif" target="{{$item['data']['target']}}">
                    @if(isset($item['data']['icon']) && (isset($item['data']['icon_position']) && $item['data']['icon_position'] == 'left') ) <i class="{{$item['data']['icon']}} me-2"></i>@endif {{ $item['label'] }} @if(isset($item['data']['icon']) && (isset($item['data']['icon_position']) && $item['data']['icon_position'] == 'right') ) <i class="{{$item['data']['icon']}} me-2"></i> @endif
                </a>
            @endforeach
    </div>
</header>
@endif
