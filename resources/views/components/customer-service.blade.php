<script>
    var new_message_time = localStorage.getItem("new_message_time")?localStorage.getItem("new_message_time"):0;
    var current_time = Date.parse(new Date())/1000;
    if(current_time - new_message_time >= 600) {
        localStorage.setItem("new_message_time", current_time)
    }

    var end_conversation_time = parseInt("{{ app('cache.config')->get('end_conversation_time',0) }}")
    var end_conversation_text = "{{ app('cache.config')->get('end_conversation_text') }}";


</script>
<div class="customer-service ">
    <div class="entrance">
        <i class="iconfont" id="customer-icon">&#xe637;</i>
    </div>
    <div class="chat-window close-chat-main">
        <div class="with">
            <div class="avatar-wrap">
                <img id="kf-avatar" src="{{ asset_upload(app('cache.config')->get('manual_customer_avatar')) }}" alt="人工客服">
            </div>
            <div class="user">
                <p class="nickname">{{ app('cache.config')->get('manual_customer_nickname') }}</p>
                <p class="status">
                    <span class="dots on"></span>
                    <span class="text">Online</span>
                </p>
            </div>
            <a class="close-chat" href="javascript:;"></a>
        </div>
        <div class="chat-main" id="message-content">
            <div class="time">{{ date('Hi')<='1200'?"上午":"下午" }}{{ ltrim(date('h:i'),'0') }}</div>
            <div class="message reply lead">
                <div class="list clearfix">
                    <span class="re-avatar"><img src="{{ asset_upload(app('cache.config')->get('manual_customer_avatar')) }}"></span>
                    <div class="content">
                        <div class="leading">
                            <p class="welcome">{!! str_replace(PHP_EOL,"<br>",app('cache.config')->get('leading_welcome')) !!} </p>

                            <ul class="words">
                                @foreach($leading_words as $words)
                                <li><a href="javascript:send_message('{{ array_get($words,'keyword') }}');">{{ array_get($words,'keyword') }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            {{--<div class="message propose ">
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
            </div>

            <div class="queue"><span class="label"><i class="iconfont">&#xe603;</i>当前有100+人正在排队</span></div>

            <div class="message reply">
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
                <div class="list clearfix">
                    <span class="text">您好</span>
                </div>
            </div>--}}



        </div>
        <div class="send">
            <div class="message">
                <form onsubmit="return send_message()">
                    <input id="customer-content" name="search" placeholder="請問有什麼可以幫到您？" />
                </form>
            </div>
            <div class="over" id="send-message"><i class="iconfont">&#xe604;</i></div>
        </div>
    </div>
</div>
