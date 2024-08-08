@if(menu($menu))
@if ($menu == 'header')
    <div class="offcanvas offcanvas-end bg-dark" id="navbarNav" tabindex="-1">
        <div class="offcanvas-header bg-transparent border-light border-bottom">
            <h5 class="offcanvas-title text-light">{{menu($menu)->name}}</h5>
            <button class="btn-close btn-close-white" type="button" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body bg-dark" data-simplebar>
            <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
                <!-- Menu items-->
                @each('components.link', menu($menu)->items, 'item')
            </ul>
        </div>
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
