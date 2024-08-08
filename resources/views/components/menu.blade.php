@if(menu($menu))
@if ($menu == 'header')
    <div class="collapse navbar-collapse order-lg-2" id="navbarDarkNav">
        <ul class="navbar-nav">
            <!-- Menu items-->
            @each('components.link', menu($menu)->items, 'item')
        </ul>
    </div>
@elseif ($menu == 'footer_bottom')
    <ul class="d-flex flex-wrap justify-content-center order-lg-2 mb-3 list-unstyled">
        @foreach (menu($menu)->items as $item)
            <li><a href="{{$item['data']['url']}}" class="nav-link nav-link-light fw-normal me-2 @isset($item['data']['classes']) {{$item['data']['classes']}} @endisset"  target="{{$item['data']['target']}}">{{ $item['label'] }} </a></li>
        @endforeach
    </ul>
@else
    <h3 class="fs-base text-light">{{ menuTitle($menu) }}</h3>
    <ul class="list-unstyled fs-sm">
        @foreach (menu($menu)->items as $item)
            <li>
                <a class="nav-link-light @isset($item['data']['classes']) {{$item['data']['classes']}} @endisset" href="{{$item['data']['url']}}" target="{{$item['data']['target']}}">
                    {{ $item['label'] }}
                </a>
            </li>
        @endforeach
    </ul>
@endif
@endif
