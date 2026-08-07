<div class="theme-tags">
    <div class="wrapper">
        <p class="tag-title">{{ isset($data['title'])?$data['title']:'' }}</p>
        <div class="tags-main clearfix">
            @foreach($tags as $item)
                <div class="tags-item" style="background-image:url('{{ asset_upload($item->img) }}');background-size:cover;background-repeat:no-repeat;width: {{ $data['width'] }};height: {{ $data['height'] }};margin-right: {{ $data['spacing'] }}">
                    <a href="{{ url('tag'.$item->id) }}">
                        <div class="box">
                            <div class="info">
                                {{--<p class="title">{{ $item->title }}</p>
                                <p class="desc">{!! $item->desc !!}</p>--}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
