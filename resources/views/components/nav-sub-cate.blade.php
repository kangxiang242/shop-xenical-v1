<div class="sub-cate">
    <div class="wrapper declare">
        <ul>
            @if($cate->id != 105)
                <li><a class="{{ request()->is('cate'.$pid)?"activate":"" }}" href="{{ url('cate'.$pid) }}">隨便逛逛</a></li>
            @endif
            @if($cate->sub)
                @foreach($cate->sub as $item)
                    <li><a class="{{ request()->is('cate'.$pid.'/'.$item->id)?"activate":"" }}" href="{{ url('cate'.$pid.'/'.$item->id) }}">{{ $item->name }}</a></li>
                @endforeach
            @endif

        </ul>
    </div>
</div>
