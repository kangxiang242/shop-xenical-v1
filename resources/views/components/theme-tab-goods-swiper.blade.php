<div class="theme-tab-goods">
    <div class="wrapper">
        <div class="tags">
            @foreach($tags as $key=>$item)
            <div class="item">
                <a class="tab-action {{ $key==0?"selected":"" }}" data-tab="#tab-{{ $key }}" href="javascript:;">{{ $item->title }}</a>
            </div>
            @endforeach
{{--            <div class="item">
                <a href="javascript:;">進階升級</a>
            </div>
            <div class="item">
                <a href="javascript:;">進階升級</a>
            </div>--}}
        </div>
        <div class="tab-content">

            @foreach($tags as $key=>$item)
                <div class="tab-wrapper" id="tab-{{ $key }}" style="display: {{ $key==0?"block":"none" }}">
                    <div class="theme-goods">
                        <div class="wrapper">
                            <div class="goods-main">
                                <div class="swiper-container" id="tab-goods-swiper-{{ $key }}">
                                    <div class="swiper-wrapper">
                                        @foreach($item->products as $vv)
                                            <div class="swiper-slide">
                                                <div class="item scale-effect">
                                                    <div class="img-wrapper">
                                                        <a href="{{ url('goods/'.$vv->id) }}">{!! img_field($vv->img,40,null,$vv->name,'img-blur') !!}</a>
                                                    </div>
                                                    <div class="info">
                                                        <p class="g-title"><a href="{{ url('goods/'.$vv->id) }}">{{ $vv->name }}</a></p>
                                                        <p class="g-price">
                                                            <em>NT$</em>
                                                            <span class="num">{{ round($vv->price) }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="swiper-slide">
                                            <a href="12321321">
                                                <div class="last-item">
                                                    <p>456546</p>
                                                </div>
                                            </a>
                                        </div>

                                    </div>
                                </div>

                                <div class="navigation goods-prev tab-goods-prev-{{ $key }}"><i class="iconfont">&#xe779;</i></div>
                                <div class="navigation goods-next tab-goods-next-{{ $key }}"><i class="iconfont">&#xe775;</i></div>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>


    </div>
</div>
@section('script')
    @parent
    <script>
        $(function(){
            @foreach($tags as $key=>$item)
                 new Swiper('#tab-goods-swiper-{{ $key }}', {
                    slidesPerView : 4,
                    slidesPerGroup:1,
                    centeredSlides : false,
                    offsetSlidesAfter:1000,
                    width:948,
                    prevButton:'.tab-goods-prev-{{ $key }}',
                    nextButton:'.tab-goods-next-{{ $key }}',
                    onSlideChangeEnd: function(swiper){
                        if(swiper.activeIndex > 1){
                            $('#tab-goods-swiper-{{ $key }}').find('.scale-effect').removeClass('scale-effect');
                            $('#tab-goods-swiper-{{ $key }}').find('.item').each(function(){
                                var origin_src = $(this).find('.lazyload').attr('data-src');
                                $(this).find('.lazyload').attr('src',origin_src);
                                var _this = $(this);
                                setTimeout(function() {
                                    _this.find('.lazyload').removeClass('img-blur')
                                }, 500);
                            });
                        }

                    }
                })
            @endforeach

            $('.tab-action').hover(function(){
                var id = $(this).attr('data-tab');
                $(id).show();
                $(id).siblings().hide();
                $(this).addClass('selected');
                $(this).parent().siblings().find('a').removeClass('selected');
                $(id).find('.item').each(function(){
                    $(this).removeClass('scale-effect');

                    var src = $(this).find('.lazyload').attr('data-src');
                    $(this).find('.lazyload').attr('src',src);
                    var _this = $(this);
                    setTimeout(function() {
                        _this.find('.lazyload').removeClass('img-blur')
                    }, 500);
                });
            });
        })

    </script>
@stop
