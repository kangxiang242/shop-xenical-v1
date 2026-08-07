@foreach($data as $v)
    <div class="store-item clearfix" >
        <input class="form-radio" type="radio" {{ count($data)<=1?"checked":"" }} id="store-{{ $v['shop_no'] }}" name="store_id" value="{{ $v['shop_no'] }}">
        <label class="marquee" for="store-{{ $v['shop_no'] }}">
            <div class="store-icon"><img src="{{ asset('static/img/711.jpg') }}"></div>
            <div class="store-info">
                <p class="store-name">{{ $v['shop_name'] }}</p>
                <p class="store-address">{{ $v['shop_address'] }}</p>
            </div>
            <span class="yes-mark"><i class="iconfont">&#xe615;</i></span>
        </label>
    </div>
@endforeach
