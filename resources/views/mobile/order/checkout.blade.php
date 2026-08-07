@extends('mobile.layout')
@php
    $freight_where = \App\Services\ConfigService::get('freight_where',0);
    $freight_price = \App\Services\ConfigService::get('freight',0);

    $delivery_type_all = \App\Services\ConfigService::get('delivery_type',[]);
    if($delivery_type_all){
        $delivery_type_all = json_decode(\App\Services\ConfigService::get('delivery_type',[]),true);
    }
@endphp
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/checkout.css') }}?ver={{ config('app.asset_version') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('static/layer/theme/default/layer.css') }}"/>
    <style>
        footer{
            display: none;
        }
        .loading-action-btn-disabled{
            opacity: 0.3;
        }
    </style>
@stop

@section('header')
@stop

@section('customer-service')
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/relx.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/mobile/js/api.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/mobile/js/xarea.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/layer/layer.js') }}"></script>
    <script>

        $(".form-control").blur(function(){
            if($(this).val()){
                $(this).addClass('have');
            }else{
                $(this).removeClass('have');
            }
        });
        setInterval(function () {
            if(checkSubmit() == true){
                $('.submit').addClass('act-sub');
            }else{
                $('.submit').removeClass('act-sub');
            }
        },1000);

        function checkSubmit(){
            var name = $("input[name='name']").val();
            var phone = $("input[name='phone']").val();
            var email = $("input[name='email']").val();
            var city = $("select[name='city']").val();
            var county = $("select[name='county']").val();
            var street = $("select[name='street']").val();
            var address = $("input[name='address']").val();
            var order_type = $("select[name='order_type']").val();
            var store_id = $("input[name='store_id']:checked").val();
            if(!name){
                return false;
            }
            if(!phone){
                return false;
            }
            if(!(/^09\d{8}$/.test(phone))){
                return false;
            }

            if(!email){
                return false;
            }

            if(email.search(/^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+\.(?:com|cn|tw|info|net)$/) == -1){
                return false;
            }

            if(!city){
                return false;
            }

            if(!county){
                return false;
            }
            if(!street){
                return false;
            }
            if(order_type > 0){
                if(!store_id){
                    return false;
                }

            }else{
                if(!address){
                    return false;
                }
            }
            return true
        }

    </script>

@stop

@section('footer-menu')
@stop

@section('content')
    <form onsubmit="return orderStore();" method="POST" action="{{ url('order') }}" id="order-form">
        {{ csrf_field() }}
        <input type="hidden" value="{{ request()->keyt }}" name="keyt">
        <input type="hidden" value="{{ $form_token }}" name="form_token">
        <input type="hidden" value="{{ $goods->id }}" name="goods_id">
        <div class="ck-header">
            <p class="title">安全结账</p>

            <ul class="base">
                <li class="icon"><img style="width: 4.2rem" src="{{ asset('static/img/ssl.png') }}" alt="ssl"></li>
                <li class="icon"><img style="width: 5.2rem" src="{{ asset('static/img/trusted.png') }}" alt="ssl"></li>

            </ul>

            
            
        </div>

        <div class="step">
            <div class="list">
                <div class="ifx">
                    <div class="num">1</div>
                    <p class="text">配送訊息</p>
                </div>
                <div class="link">
                    <!-- <div class="line"></div> -->
                    <i class="iconfont"> >> </i>
                </div>
            </div>

            <div class="list">
                <div class="ifx">
                    <div class="num">2</div>
                    <p class="text">收貨訊息</p>
                </div>
                <div class="link">
                    <!-- <div class="line"></div> -->
                    <i class="iconfont"> >> </i>
                </div>
            </div>

            <div class="list">
                <div class="ifx">
                    <div class="num">3</div>
                    <p class="text">確認訂單</p>
                </div>
                <div class="link">
                    <!-- <div class="line"></div> -->
                    <i class="iconfont"> >> </i>
                </div>
            </div>

            <div class="list">
                <div class="ifx">
                    <div class="num">4</div>
                    <p class="text">提交訂單</p>
                </div>
            </div>
        </div>

        <div class="wrap">

            <div class="block">
                <div class="head">
                    <div class="order">1</div>
                    <p class="title">配送訊息<span class="order-sub">官方配送，預計&nbsp;{{ date('n月d日',strtotime('+2 day')) }}&nbsp;送達</span></p>
                    
                    <div class="thread">
                        <div class="line"></div>
                    </div>
                </div>
                <div class="main">
                    <div class="form-group form-horizontal">
                        <label class="control-label">配送方式：</label>
                        <div class="grow">
                            <select name="order_type" class="form-control control-select show-select"  id="">
                                @if(in_array(2,$delivery_type_all))
                                    <option value="1">7-ELEVEN（免運費）</option>
                                @endif
                                <option value="0">黑貓宅急便（免運費）</option>
                                <option value="2" disabled>全家店到店</option>
                                <option value="3" disabled>宅配通</option>
                            </select>
                            
                        </div>
                    </div>

                    <div class="form-group form-horizontal" id="form-time-row">
                        <label class="control-label">配送時間：</label>
                        <div class="grow">
                            <select name="delivery_time" class="form-control control-select show-select" >
                                <option selected="" value="1">09:00~12:00</option>
                                <option value="2">12:00~17:00</option>
                                <option value="3">17:00~20:00</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group form-horizontal">
                        <label class="control-label">選擇地址：</label>
                        <div class="grow">
                            <div class="row">
                                <select name="city" class="form-control control-select"  id="city">
                                    <option value="0">選擇縣市</option>
                                </select>
                            </div>
                            <div class="row">
                                <select name="county" class="form-control control-select"  id="county">
                                    <option value="0">選擇縣市</option>
                                </select>
                            </div>
                            <div class="row">
                                <select name="street" class="form-control control-select"  id="street">
                                    <option value="0">選擇縣市</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="store-main">
                        <div class="store-container clearfix" id="store-shop">

                        </div>
                    </div>


                    <div class="form-group" id="form-address-row">
                        <input type="text" class="form-control" name="address" placeholder="詳細地址">
                        <span class="tag">詳細地址</span>
                    </div>

                    <div class="form-group form-horizontal">
                        <label class="control-label">付款方式：</label>
                        <div class="grow">
                            <select name="pay_type" class="form-control control-select show-select"  id="">
                                @if(in_array(2,$delivery_type_all))
                                    <option value="1">取貨付款</option>
                                @endif
                                <option value="0" disabled>信用卡支付</option>
                                <option value="2" disabled>ATM轉帳</option>
                                <option value="3" disabled>Line Pay（即將推出）</option>
                                <option value="3" disabled>Apple Pay（即將推出）</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block">
                <div class="head">
                    <div class="order">2</div>
                    <p class="title">收貨訊息</p>
                    <div class="thread">
                        <div class="line"></div>
                    </div>
                </div>
                <div class="main">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="收貨人姓名">
                        <span class="tag">姓名</span>
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="phone" pattern="[0-9]*" placeholder="收貨人電話">
                        <span class="tag">電話</span>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="收貨人電子信箱">
                        <span class="tag">電子郵箱</span>
                    </div>
                    
                </div>
            </div>
            <div class="block">
                <div class="head">
                    <div class="order">3</div>
                    <p class="title">確認訂單</p>
                    <div class="thread">
                        <div class="line"></div>
                    </div>
                </div>
                <div class="main">
                    <div class="calc">
                        <div class="list">
                            <div class="label">
                                <p class="title">{{ $goods->name }}</p>
                                <p class="tag"></p>
                            </div>
                            <div class="count">
                                <p class="price">NT{{ $goods->market_price }}</p>
                                <!-- @if($goods->market_price > $goods->price)
                                    <p class="discount">NT${{ number_format(round($goods->market_price)) }}</p>
                                @endif -->
                            </div>
                        </div>

                        <div class="list">
                            <div class="label">
                                <p class="title">優惠折扣</p>
                                <p class="tag"></p>
                            </div>
                            <div class="count">
                                <p class="price">-NT${{ number_format(round($goods->market_price - $goods->price)) }}</p>
                            </div>
                        </div>

                        <div class="list">
                            <div class="label">
                                <p class="title">運費</p>
                                
                            </div>
                            <div class="count" style="align-self: center">
                                <p class="price">NT${{ $goods->price>=$freight_where?0:$freight_price }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="total">
                        <div class="label">
                            <p class="title">訂單支付金額：</p>

                            <!-- @if($goods->market_price > $goods->price)
                                <p class="tag" style="color: #FF4C4C">已為您優惠</p>
                            @endif -->

                        </div>
                        <div class="count">

                            <p class="price">NT${{ number_format(round($goods->price>=$freight_where?$goods->price:$goods->price+$freight_price)) }}</p>

                            <!-- @if($goods->market_price > $goods->price)
                                <p class="discount">NT${{ number_format(round($goods->market_price-$goods->price)) }}</p>
                            @endif -->

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="remarks" placeholder="訂單備註（選填）">
                        <span class="tag">訂單備註</span>
                    </div>
                </div>
            </div>

            <div class="block" style="padding-bottom: 0">
                <div class="head">
                    <div class="order">4</div>
                    <p class="title">最後一步，請提交訂單</p>

                </div>
            </div>
            

        </div>

        <div class="paying">

            <!-- <div class="calc">
                <div class="list">
                    <div class="label">
                        <p class="title">{{ $goods->name }}</p>
                        <p class="tag"></p>
                    </div>
                    <div class="count">
                        <p class="price">NT{{ number_format(round($goods->price)) }}</p>
                        @if($goods->market_price > $goods->price)
                            <p class="discount">NT${{ number_format(round($goods->market_price)) }}</p>
                        @endif
                    </div>
                </div>

                <div class="list">
                    <div class="label">
                        <p class="title">{{ $goods->price>=$freight_where?'免運費':'運費：' }}</p>
                        @if($freight_where>0)
                            <p class="tag">消費滿NT${{ $freight_where }}，享受免費配送服務</p>
                        @endif
                    </div>
                    <div class="count" style="align-self: center">
                        <p class="price">NT${{ $goods->price>=$freight_where?0:$freight_price }}</p>
                    </div>
                </div>
            </div>
            <div class="total">
                <div class="label">
                    <p class="title">訂單支付金額：</p>

                    @if($goods->market_price > $goods->price)
                        <p class="tag" style="color: #FF4C4C">已為您優惠</p>
                    @endif

                </div>
                <div class="count">

                    <p class="price">NT${{ number_format(round($goods->price>=$freight_where?$goods->price:$goods->price+$freight_price)) }}</p>

                    @if($goods->market_price > $goods->price)
                        <p class="discount">NT${{ number_format(round($goods->market_price-$goods->price)) }}</p>
                    @endif

                </div>
            </div> -->
            {{--<div class="conceal">
                <div class="item">
                    <div class="icon"><i class="iconfont" style="font-size: 0.42rem">&#xebb9;</i></div>
                    <span>絕對隱密</span>
                </div>
                <div class="item">
                    <div class="icon"><i class="iconfont" style="font-size: 0.42rem">&#xe610;</i></div>
                    <span>隱私保護</span>
                </div>
                <div class="item">
                    <div class="icon"><i class="iconfont" style="font-size: 0.48rem">&#xe60f;</i></div>
                    <span>台灣出貨</span>
                </div>
                <div class="item">
                    <div class="icon"><i class="iconfont" style="font-size: 0.58rem">&#xe60d;</i></div>
                    <span>當天出貨</span>
                </div>
                <div class="item">
                    <div class="icon"><i class="iconfont" style="font-size: 0.52rem">&#xeb67;</i></div>
                    <span>官方授權</span>
                </div>
                <div class="item">
                    <div class="icon"><i class="iconfont" style="font-size: 0.56rem">&#xe63f;</i></div>
                    <span>鄉民推薦</span>
                </div>
                <div class="item">
                    <div class="icon"><i class="iconfont" style="font-size: 0.56rem">&#xe624;</i></div>
                    <span>免費換貨</span>
                </div>
                <div class="item">
                    <div class="icon"><i class="iconfont" style="font-size: 0.56rem">&#xe88c;</i></div>
                    <span>安全結帳</span>
                </div>
            </div>--}}

            <button class="submit" data-observer="提交訂單">提交訂單</button>

        </div>

    </form>

@endsection




