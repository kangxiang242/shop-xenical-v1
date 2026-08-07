@if(isset($data['back_img']) && $data['back_img'])
<div class="theme-graphic" id="{{ $id }}">
    <div class="graphic-image">
        <img src="{{ asset_upload($data['back_img']) }}" alt="{{ strip_tags($data['text']) }}">
    </div>
    <div class="position">
        <div class="content">
            {!! $data['text'] !!}
        </div>
    </div>
</div>
<style>
    #{{ $id }} .position {
        left: {{ $data['text_x'] }};
        top: {{ $data['text_y'] }};
        transform: translate(-50%,-50%);
    }

    #{{ $id }} .position .content {
         @if(isset($data['text_color']) && $data['text_color'])
            color:{{ $data['text_color'] }};
         @endif
         @if(isset($data['text_letter_spacing']) && $data['text_letter_spacing'])
            letter-spacing:{{ $data['text_letter_spacing'] }};
         @endif
     }

    #{{ $id }} .position .content p{
         @if(isset($data['text_letter_spacing']) && $data['text_letter_spacing'])
            letter-spacing:{{ $data['text_letter_spacing'] }};
         @endif
     }
</style>
@endif
