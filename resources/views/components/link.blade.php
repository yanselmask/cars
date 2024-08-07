<li class="nav-item @if($item['children']) dropdown @endif  @if(strlen($item['data']['url']) == 1 && request()->routeIs('home')) active @endif @if(request()->path() == substr($item['data']['url'], 1)) active @endif">
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
