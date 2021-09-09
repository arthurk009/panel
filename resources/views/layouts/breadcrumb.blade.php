
<ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="home" class="text-white"><i class="fa fa-home"></i> {{trans('messages.home')}}</a></li>
        @php($mainTrans = '')
        @for ($i = 1; $i <= count(Request::segments()); $i++)
                @if(Request::segment($i) == 'admin' || is_numeric(Request::segment($i)))
                    @continue
                @endif
                {{-- @if(count(Request::segments()) >2 && $i == 1)
                    @continue
                @endif --}}
                @php($mainTrans = $mainTrans.(($mainTrans=='')?'':'.').Request::segment($i))
            <li class="breadcrumb-item active">{{ trans('main.'.$mainTrans) }}</li>
        @endfor
</ol>
