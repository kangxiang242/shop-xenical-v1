<div class="cate-sec" id="cate-sec-{{ $key }}">
    <div class="wrapper">
        <h2 class="sec-title">{{ $data['title'] }}</h2>
        <div class="sec-data">
            @foreach($cate->sub as $item)
            <div class="item">
                <a href="{{ url('cate'.$cate->id.'/'.$item->id) }}">
                    <div class="box" style="background-image: url('{{ asset_upload($item->section_img) }}')">

                    </div>
                    <p class="item-title">{{ $item->name }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>
