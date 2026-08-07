<div class="cate-sec" id="cate-sec-{{ $key }}">
    <div class="wrapper">
        <h2 class="sec-title">{{ $title }}</h2>
        <div class="sec-data">
            @foreach($tags as $item)
                <div class="item">
                    <a href="{{ url('tag'.$item->id) }}">
                        <div class="box" style="background-image: url('{{ asset_upload($item->img) }}')">

                        </div>
                        <p class="item-title">{{ $item->title }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
