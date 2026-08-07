<div class="cate-box">
    <ul class="list">
        @foreach($cate as $item)
            <li class="list-li {{ $item->id==$pid?"activate":"" }}">
                <a href="{{ url('cate'.$item->id) }}">{{ $item->name }}</a>
                @if($pid!=$item->id)
                    <div class="nav-cate-dropdown-menu">
                        <ul>
                            @if($item->id != 105)
                                <li>
                                    <a href="{{ url('cate'.$item->id) }}">隨便逛逛</a>
                                </li>
                            @endif
                            @foreach($item->sub as $vv)
                                <li>
                                    <a href="{{ url('cate'.$item->id.'/'.$vv->id) }}">{{ $vv->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
    <div class="cate-tab"></div>
</div>

