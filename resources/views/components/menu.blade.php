@if(menu($menu))
@if ($menu == 'header')
<div class="collapse navbar-collapse order-lg-2" id="navbarNav">
    <ul class="navbar-nav navbar-nav-scroll" style="max-height: 35rem;">
        <!-- Menu items-->
        @foreach(menu($menu)->items as $item)
        <li class="nav-item @if($item['children']) dropdown @endif">
            <a class="nav-link @if($item['children']) dropdown-toggle @endif @isset($item['data']['classes']) {{$item['data']['classes']}} @endisset" href="{{$item['data']['url']}}" target="{{$item['data']['target']}}">
               @if(isset($item['data']['icon']) && (isset($item['data']['icon_position']) && $item['data']['icon_position'] == 'left') ) <i class="{{$item['data']['icon']}} me-2"></i>@endif {{ $item['label'] }} @if(isset($item['data']['icon']) && (isset($item['data']['icon_position']) && $item['data']['icon_position'] == 'right') ) <i class="{{$item['data']['icon']}} me-2"></i> @endif
                   @if(isset($item['data']['divider']) && $item['data']['divider'])
                       <span class="d-none d-lg-block position-absolute top-50 end-0 translate-middle-y border-end border-light" style="width: 1px; height: 30px;"></span>
                   @endif
            </a>
            @if($item['children'])
                <ul class="dropdown-menu dropdown-menu-dark">
                    @foreach($item['children'] as $subItem)
                    <li><a class="dropdown-item" target="{{$subItem['data']['target']}}" href="{{$subItem['data']['url']}}" @isset($subItem['data']['classes']) class="{{$subItem['data']['classes']}}" @endisset>{{$subItem['label']}}</a></li>
                    @endforeach
                </ul>
            @endif
        </li>
        @endforeach
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
