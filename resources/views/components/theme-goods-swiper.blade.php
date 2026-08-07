<div class="theme-goods">
    <div class="wrapper">

        <div class="goods-main">
            <div class="swiper-container" id="goods-swiper-{{ $key }}">
                <div class="swiper-wrapper">
                    @foreach($product as $item)
                    <div class="swiper-slide">
                        <div class="item goods-item-large scale-effect">
                            <div class="img-wrapper">
                                <a href="{{ url('goods/'.$item->id) }}">{!! img_field($item->img,40,null,$item->name,'img-blur') !!}</a>
                            </div>
                            <div class="info">
                                <p class="g-title"><a href="{{ url('goods/'.$item->id) }}">{{ $item->name }}</a></p>
                                <p class="g-price">
                                    <em>NT$</em>
                                    <span class="num">{{ round($item->price) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="swiper-slide">
                        <a href="{{ url($data['last-href']) }}">
                            <div class="last-item">
                                <p>{!! $data['last-text'] !!}</p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>

            <div class="navigation goods-prev goods-prev-{{ $key }}"><i class="iconfont">&#xe779;</i></div>
            <div class="navigation goods-next goods-next-{{ $key }}"><i class="iconfont">&#xe775;</i></div>

        </div>
    </div>
</div>
@section('script')
    @parent
    <script>
        $(function(){
            var mySwiper = new Swiper('#goods-swiper-{{ $key }}', {
                slidesPerView : 4,
                slidesPerGroup:1,
                centeredSlides : false,
                offsetSlidesAfter:1000,
                width:948,
                prevButton:'.goods-prev-{{ $key }}',
                nextButton:'.goods-next-{{ $key }}',
            })
        })

    </script>
@stop
