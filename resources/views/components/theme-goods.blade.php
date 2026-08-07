@if($product && count($product)>0)
<div class="goods-sec">
    <div class="wrapper">
        <div class="goods-data">
            @foreach($product as $item)
            <div class="item goods-item-large scale-effect">
                <div class="img-wrapper"><a href="{{ url('goods/'.$item->id) }}">{!! img_field($item->img,40,null,$item->name,'img-blur') !!}</a></div>
                <p class="goods-title"><a href="{{ url('goods/'.$item->id) }}">{{ $item->name }}</a></p>
                <p class="goods-price">
                    <em>NT$</em>
                    <span>{{ round($item->price) }}</span>
                </p>
            </div>
            @endforeach
        </div>

        <div class="more">
            <a href="{{ $data['href']?url($data['href']):"javascript:;" }}">{!! $data['text'] !!}</a>
        </div>

    </div>
</div>
@endif
