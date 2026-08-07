@if(!request()->ajax())
<div class="lgbt">
    <div class="top-cate-section">
        <div class="wrapper">
            <div class="top-cate">
                @foreach($cate->sub as $key=>$item)
                    @if($key >= 2)
                        @break
                    @endif
                    <div class="item">
                        <a class="cate-switch" data-id="{{ $item->id }}" data-select-id="{{ $select_id }}" data-cate-id="{{ $cate->id }}" href="javascript:;">
                            <div class="box xthover" style="background-image: url('{{ asset_upload($select_id==$item->id?$item->section_hover_img:$item->section_img) }}')" data-not-hover="{{ $select_id==$item->id?1:0 }}" data-img="{{ asset_upload($item->section_img) }}" data-hover-img="{{ asset_upload($item->section_hover_img) }}">
                                {{--<p class="text">{{ $item->name }}</p>--}}
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="lgbt-box " id="lgbt-ajax">
@endif
            <div class="sub-cates clearfix">
                @foreach($column as $item)
                    <div class="item">
                        <a href="{{ $item['href']?url($item['href']):"" }}">
                            <div class="box" style="background-image: url('{{ asset_upload($item['img']) }}')">

                            </div>
                            <p class="cate-title">{{ $item['text'] }}</p>
                        </a>
                    </div>
                @endforeach
            </div>

            @foreach($column as $item)
                @if($item['goods_ids'])
                    <div class="lgbt-scs">
                        <div class="lgbt-adv" style="background-repeat: no-repeat;background-size: cover;background-image: url('{{ asset_upload($item['img2']) }}')">
                            <div class="text wrapper">
                                {!! $item['text2'] !!}
                            </div>
                        </div>
                        <div class="goods-sec">
                            <div class="wrapper">
                                <div class="goods-data">
                                    @foreach($item['goods'] as $key=>$vv)
                                        @if($key>=5)
                                            @break
                                        @endif
                                        <div class="item scale-effect">
                                            <div class="img-wrapper"><a href="{{ url('goods/'.$vv['id']) }}">{!! img_field($vv['img'],40,null,$vv['name'],'img-blur') !!}</a></div>
                                            <p class="goods-title"><a href="{{ url('goods/'.$vv['id']) }}">{{ $vv['name'] }}</a></p>
                                            <p class="goods-price">
                                                <em>NT$</em>
                                                <span>{{ round($vv['price']) }}</span>
                                            </p>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="more">
                                    <a href="{{ $item['href']?url($item['href']):"" }}">更多 {!! $item['text'] !!}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @if(request()->ajax())
        <script>
            $("img.lazyload").lazyload({
                effect: "show",
                data_attribute:"src",
                event:"scroll",
                skip_invisible:false,
                appear:function(){
                    $(this).parents('.scale-effect').removeClass('scale-effect');
                },
                load:function(){
                    var _this = $(this);
                    setTimeout(function() {
                        _this.removeClass('img-blur')
                    }, 300);

                }
            });
        </script>
        @endif
@if(!request()->ajax())
    </div>


</div>
<style>
    .eleLoading{
        width: 100%;
        height: 100%;
        background-color: rgba(255,255,255,.8);
        top: 0;
        position: absolute;
        text-align: center;
        padding-top: 200px;
    }
</style>
@foreach($cate->sub as $key=>$item)
    <script type="text/html" id="temp-lgbt-{{ $item->id }}"></script>
    <script>
        $(function(){
            $.ajax({
                type: "GET",
                url: "/ajax/lgbt",
                data: {id:"{{ $item->id }}",cate_id:"{{ $item->pid }}"},
                dataType: "html",
                success: function(data){
                    if(data){
                        $('#temp-lgbt-{{ $item->id }}').text(data);
                    }
                },

            });
        })
    </script>
@endforeach
<script>
    $(function(){
        $('#temp-lgbt-{{ $select_id }}').text($('#lgbt-ajax').html());
        var lgbt_switch = false;
        $('.cate-switch').hover(function(){
            if(lgbt_switch == true){
                return false;
            }
            var id = $(this).attr('data-id');
            var cate_id = $(this).attr('data-cate-id');
            eleLoading('#lgbt-ajax')

            if($('#temp-lgbt-'+id).text()){
                $('#lgbt-ajax').html($('#temp-lgbt-'+id).text());
                return false;
            }


            lgbt_switch = true;
            $.ajax({
                type: "GET",
                url: "/ajax/lgbt",
                data: {id:id,cate_id:cate_id},
                dataType: "html",
                success: function(data){
                    if(data){
                        $('#lgbt-ajax').html(data);
                        $('#temp-lgbt-'+id).text(data);
                    }
                },
                complete:function(){
                    lgbt_switch=false;
                    $('#lgbt-ajax').find('.eleLoading').empty()
                }
            });




        },function(){
            return false;
        })
        function eleLoading(element){
            $(element).append('<div class="eleLoading"><svg xmlns="http://www.w3.org/2000/svg" class="mx-auto block" style="width:58px;" viewBox="0 0 120 30" fill="#bacad6"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg></div>');
        }

        $('.xthover').hover(function(){
            if(lgbt_switch == true){
                return false;
            }
            var img = $(this).attr('data-hover-img');
            $(this).css('background-image','url("'+img+'")');
            $(this).parents('.item').siblings().each(function(){

                var img = $(this).find('.xthover').attr('data-img');
                $(this).find('.xthover').css('background-image','url("'+img+'")');
                $(this).find('.xthover').attr('data-not-hover',0);
            });


        },function(){
            return false;
        });
        /*$('.xthover').click(function(){
            var img = $(this).attr('data-hover-img');
            $(this).css('background-image','url("'+img+'")');
            $(this).attr('data-not-hover',1);
            $(this).parents('.item').siblings().each(function(){

                var img = $(this).find('.xthover').attr('data-img');
                $(this).find('.xthover').css('background-image','url("'+img+'")');
                $(this).find('.xthover').attr('data-not-hover',0);
            });
        });*/

    })
</script>
@endif
