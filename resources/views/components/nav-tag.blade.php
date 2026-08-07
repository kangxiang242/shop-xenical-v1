<ul class="tags">
    @foreach($tags as $item)
        <li>
            <a href="{{ url('tag'.$item->id) }}">{{ $item->title }}</a>
        </li>
    @endforeach
</ul>
