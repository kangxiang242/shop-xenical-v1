@if(count($banner)>1)
    <link rel="stylesheet" type="text/css" href="{{ asset('static/swiper/swiper-3.4.2.min.css') }}"/>
@endif
<div class="banner-main" id="banner-main">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($banner as $item)
            <div class="swiper-slide">
                <a href="{{ $item->href?$item->href:"javascript:;" }}"><img src="{{ asset_upload($item->img) }}" alt="{{ $item->alt }}"></a>
            </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
@if(count($banner)>1)
<script src="{{ asset('static/swiper/swiper-3.4.2.jquery.min.js') }}"></script>
<script>
    $(function () {
        new Swiper('#banner-main .swiper-container', {
            autoplay : 3000,
            pagination : '.swiper-pagination',
            loop : true,
        })
    })

</script>
@endif
