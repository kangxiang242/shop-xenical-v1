@if($data['image1'] || $data['image2'])
<div class="theme-chunk">
    <div class="wrapper chunk-main">
        @if($data['image1'])
        <div class="block col-{{ $col }}" style="background-image: url('{{ asset_upload($data['image1']) }}')">
            <a href="{{ url($data['href1']?:"/") }}"><div class="content"></div></a>
        </div>
        @endif

        @if($data['image2'])
            <div class="block col-{{ $col }}" style="background-image: url('{{ asset_upload($data['image2']) }}')">
                <a href="{{ url($data['href2']?:"/") }}"><div class="content"></div></a>
            </div>
        @endif
    </div>
</div>
@endif
