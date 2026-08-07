<div class="theme-chunk">
    <div class="wrapper chunk-main">
        @foreach($data['data'] as $item)
            <div class="block col-{{ count($data['data']) }}" style="background-image: url('{{ asset_upload($item['image']) }}')">
                <a href="{{ url($item['href']) }}"><div class="content"></div></a>
            </div>
        @endforeach
        {{--<div class="block col-2">
            <a href=""><div class="content"></div></a>
        </div>--}}
    </div>
</div>
