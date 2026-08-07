@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/check.css') }}?ver={{ config('app.asset_version') }}">
@stop

@section('script')
    @parent
    <script>
        setInterval(function(){
            if(checkVerify() == true){
                $('.form-btn').addClass('activate-btn');
            }else{
                $('.form-btn').removeClass('activate-btn');
            }

        },1000);
        function checkVerify(){
            var phone = $("input[name='phone']").val();
            var email = $("input[name='email']").val();
            var captcha_code = $("input[name='captcha_code']").val();

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
            if(!captcha_code){
                return false;
            }
            return true;
        }
    </script>

    <script>
        submit('#check-form')
    </script>
@stop

@section('content')

    <section class="check-container">

        <div class="page-main">
            <div class="page-head">
                <p class="beat"><i class="iconfont">&#xe784;</i></p>
                <h1 class="page-title">訂單追蹤</h1>
            </div>
            <div class="page-body">
                <p class="describe">
                    {!! app('cache.config')->get('page_check_desc') !!}
                </p>
                <div class="form-pack">
                    <form action="" id="check-form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>訂單行動電話：</label>
                            <input class="form-control" type="tel" data-validate="required:請輸入你的订单電話|mobile:電話格式錯誤" name="phone" placeholder="請輸入訂購时留下的電話號碼">
                        </div>
                        <div class="form-group">
                            <label>訂單電子郵箱：</label>
                            <input class="form-control" type="email" data-validate="required:請輸入订单電子郵箱|email:電子郵箱格式錯誤" name="email" placeholder="請輸入訂購时留下的電子郵箱">
                        </div>
                        <div class="form-group">
                            <label>我不是機器人：</label>
                            <div class="inline">
                                <input class="form-control captcha_code" data-validate="required:請輸入驗證碼" type="text" name="captcha_code" placeholder="請輸入驗證碼">
                                <div class="code"><img class="thumbnail captcha mt-3 mb-2" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="form-btn">確認送出</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="foot">
                <div class="li">
                    <p>如您想再次確認訂單，您可以</p>
                    <p>· 通過上面輸入訂單中預留的聯繫電話以及電子信箱查詢您的訂單。</p>
                </div>

                <div class="li">
                    <p>如果無法查詢結果，可能是由於以下原因</p>
                    <p>· 輸入訂單中預留的聯繫電話或電子信箱有誤，請仔細檢查無誤後再次查詢</p>
                    <p>· 系統生成訂單延遲，請稍候片刻後再次查詢</p>
                    <p>· 網絡波動及其他外界影響導致當時沒有下單成功，請再次下單</p>
                </div>

                <div class="li">
                    <p>物流狀態更新延遲</p>
                    <p>我們收到您的訂單後，物流部門會收到您的信息，然後他們會處理您的訂單並將其整裝待發，最後將它
                        們轉發給運輸公司，然後由運輸公司運送。由於此過程涉及內部和外部各方之間的多個協調步驟，因此物
                        流狀態更新會有延遲。</p>
                </div>

                <div class="li">
                    <p>派送和交貨時間</p>
                    <p>目前，我們通過主要物流供應商提供運輸服務。我們在每週一到週六上班時間（台北時間上午 9:00 至 下午 18:00）處理所有訂單。</p>
                    <p>我們的物流合作夥伴是黑貓宅急便以及7-ELEVEN便利店，可保證快速安全的交付。</p>
                    <p>免責聲明：此處顯示的交貨時間可能有例外，具體取決於您所在的位置。即使是主要的物流供應商也沒有全面覆蓋，有時需要聘請分包商來處理他們的交付。</p>
                </div>
            </div>
        </div>
    </section>

@endsection
