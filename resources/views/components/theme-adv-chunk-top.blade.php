<div class="adv-chunk-top">
    <div class="wrapper chunk-main">

        <div class="block" style="background-image: url('{{ asset_upload($data['image1']) }}')">
            <a href="{{ $data['href1'] }}"><div class="content"></div></a>
        </div>

        <div class="block" style="background-image: url('{{ asset_upload($data['image2']) }}')">
            <a href="{{ $data['href2'] }}"><div class="content"></div></a>
        </div>

        <div class="block" style="background-image: url('{{ asset_upload($data['image3']) }}')">
            <a href="{{ $data['href3'] }}"><div class="content"></div></a>
        </div>

    </div>
</div>
