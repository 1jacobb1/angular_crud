<script type="text/javascript" src="/user/js/video_chat_rtc/socket.io.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/peer.min.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/constant.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/connect.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/event.common.js"></script>
<div class="row">
    <div class="col-md-12">
        <h1 class="page-header">
            TEACHER ONLINE LIST
        </h1>
    </div>
</div>
<div class="instructor_list_wrap_2">
    <p id="count-result" class="search_result_txt hide"><em>13</em>名の講師が見つかりました。</p>
    <ul class="user_list_style_2 cf" id="list"></ul>
</div>
<script>
    $(function(){
        getTeacherOnlineList();
        detectMedia();
    });
    function getTeacherOnlineList(){
        $.ajax({
            url: '/user/home/getTeachers'
        })
        .done(function(data){
            $('#list').html(data);
        });
    }

    function detectMedia(cb){
        connect.initializeCamera(function(success){
            if($.isFunction(cb)) { cb(); }
        }, function(fail){
            console.log(fail);
            console.warn('will not display online teachers bec. media not detected!');
        });
    }

    function callTeacher(teacherId, hash){
        detectMedia(function(){
            window.location = "/user/class/index/"+teacherId+"/"+hash;
        });
    }
</script>