@foreach($data as $v)
    <div class="store-item">
        <input class="store-radio" type="radio" {{ count($data)<=1?"checked":"" }} id="store-{{ $v['shop_no'] }}" name="store_id" value="{{ $v['shop_no'] }}">
        <label for="store-{{ $v['shop_no'] }}">
            <span class="radio-dress"></span>
            <div class="store-info">
                <div class="store-icon">
                    <img src="{{ asset('static/img/711.jpg') }}" alt="7-11">
                </div>
                <div class="store-text">
                    <p class="store-name">{{ $v['shop_name'] }}</p>
                    <p class="store-address">{{ $v['shop_address'] }}</p>
                </div>
            </div>
        </label>
    </div>
@endforeach
