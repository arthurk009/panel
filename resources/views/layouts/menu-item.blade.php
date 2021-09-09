@if ($item["submenu"] == [])

    <a class="dropdown-item" href="{{url($item['url'])}}" >
        {{$item["nombre"]}}
    </a>

@else

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#navbar-extra" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
        @php
            if ($item["id"] == '8') {
                echo '<span class="badge badge-warning navbar-badge bg-danger" id="solicitudes" style="display:none;"></span>';
            }
        @endphp
        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            @php
                echo $item["icono"];
            @endphp
        </svg>
        </span>
        <span class="nav-link-title">
            {{$item["nombre"]}}
        </span>
      </a>
    <div class="dropdown-menu">
        @foreach ($item["submenu"] as $submenu)    
            @include("layouts.menu-item", ["item" => $submenu])
        @endforeach
    </div>
</li>    
@endif

