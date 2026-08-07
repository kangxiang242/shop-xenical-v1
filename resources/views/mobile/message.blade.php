@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/message.css') }}?ver={{ config('app.asset_version') }}">
@stop

@section('script')
    @parent
    <script>

        setInterval(function(){
            if(messageVerify() == true){
                $('.form-btn').addClass('activate-btn');
            }else{
                $('.form-btn').removeClass('activate-btn');
            }

        },1000);
        function messageVerify(){
            var name = $("input[name='name").val();
            var phone = $("input[name='phone']").val();
            var email = $("input[name='email']").val();
            var content = $("textarea[name='content']").val();
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
            if(!content){
                return false;
            }
            return true;
        }
    </script>


    <script>
        submit('#message-form');
    </script>

    <script>
        $('.question-show').click(function(){
            var is_show = $(this).attr('data-show');
            var height = $(this).find('.q-desc').height()+10+$(this).find('.q-title').height()
            if(!is_show){
                $(this).css('height',height);
                $(this).attr('data-show',1);
                $(this).find('.q-icon').html('&#xeca2;');
            }else{
                $(this).css('height',$(this).find('.q-title').height());
                $(this).removeAttr('data-show');
                $(this).find('.q-icon').html('&#xe775;');
            }

        });
    </script>
@stop

@section('content')

    <section class="message-container">

        <div class="page-main">
            <div class="page-head">
                <!-- <p class="beat"><i class="iconfont">&#xe784;</i></p> -->
                <h1 class="page-title">取得協助</h1>
            </div>
            <div class="page-body">
                <div class="quick">
                    <div class="describe">
                        <p class="title">快速協助</p>
                        <p class="text">
                            {!! app('cache.config')->get('page_message_desc') !!}
                        </p>
                    </div>
                    <ul class="fqa">
                        @foreach($faqs as $item)
                        <div class="item question-show">
                            <p class="q-title">Q：{{ $item->questions }}</p>
                            <p class="q-desc">{{ $item->answers }}</p>
                            <i class="q-icon iconfont">&#xe775;</i>
                        </div>
                        @endforeach
                    </ul>
                    <p class="finis">仍然沒有解決問題？請進一步聯絡我們</p>
                </div>

                <div class="liaison">
                    <div class="box">
                        <p class="title">聯絡我們</p>
                        <p class="text">
                            {!! app('cache.config')->get('page_lianluo_desc') !!}
                        </p>
                    </div>
                </div>

                <div class="form-pack">
                    <form action="{{ url('message') }}" method="post" id="message-form">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>你的稱呼：</label>
                            <input class="form-control" data-validate="required:請輸入你的稱呼" type="text" name="name" placeholder="請輸入你的稱呼">
                        </div>
                        <div class="form-group">
                            <label>聯絡電話：</label>
                            <input class="form-control" data-validate="required:請輸入你的聯絡電話|mobile:聯絡電話格式錯誤" type="text" name="phone" placeholder="請輸入聯絡你的電話號碼">
                        </div>
                        <div class="form-group">
                            <label>電子郵箱：</label>
                            <input class="form-control" data-validate="required:請輸入你的電子郵箱|email:電子郵箱格式錯誤" type="text" name="email" placeholder="請輸入聯絡你的電子郵箱">
                        </div>
                        <div class="form-group">
                            <label>協助類型：</label>
                            <select class="form-control" name="type">
                                <option value="1">療程咨詢</option>
                                <option value="2">退換貨</option>
                                <option value="3">修改訂單信息</option>
                                <option value="4">修改/新增訂單備注</option>
                                <option value="5">意見或建議</option>
                                <option value="0" selected>其它</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>問題詳述：</label>
                            <textarea class="form-control form-textarea" data-validate="required:請詳述你的問題或建議" name="content"  placeholder="請詳述你的問題或建議&#10;並提供您的訂單編號(如您已取得)"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="form-btn" >確認送出</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

@endsection
