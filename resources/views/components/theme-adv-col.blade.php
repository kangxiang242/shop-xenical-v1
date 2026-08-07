@if(isset($data['image']) && $data['image'])
<div class="theme-chunk">
    <div class="wrapper chunk-main">
        <div class="block col-1" style="background-image: url('{{ asset_upload($data['image']) }}')">
            <a href="{{ $data['href']?url($data['href']):"javascript:;" }}"><div class="content"></div></a>
        </div>
    </div>
</div>
@endif
