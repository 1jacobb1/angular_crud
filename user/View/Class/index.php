<script type="text/javascript" src="/user/js/video_chat_rtc/socket.io.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/peer.min.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/constant.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/util.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/connect.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/event.common.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/event.student.js"></script>
<script type="text/javascript" src="/user/js/video_chat_rtc/event.teacher.js"></script>
<link rel="stylesheet" type="text/css" href="/user/css/mychat.css"/>



<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="own_video_wrap on" id="own_video_wrap" style="width: 100%; height: 100%; z-index: 2;"><!-- if connected, add class "on" -->
    			<video class="ownVideo" id="ownVideo" autoplay="" poster="/teacher/images/class/video_no_stream.png" src="" muted=""></video>
    		</div>
        </div>
        <div class="col-md-6">
        	<div class="others_video_wrap on" id="others_video_wrap" style="width: 100%; height: 100%; z-index: 2;"><!-- if connected, add class "on" -->
    			<video class="othersVideo" id="othersVideo" autoplay="" poster="/teacher/images/class/video_no_stream.png" src="" muted=""></video>
    		</div>
        </div>
    </div>
</div>

<div id="mychat">
	<div class="container" style="position:center">
    <div class="col-md-12">
        <div class="panel">
        	<!--Heading-->
    		<div class="panel-heading">
    			<div class="panel-control">
    				<div class="btn-group">
    				</div>
    			</div>
    			<h3 class="panel-title">Chat</h3>
    		</div>
    
    		<!--Widget body-->
    		<div id="demo-chat-body" class="collapse in">
    			<div class="nano has-scrollbar" style="height:380px">
    				<div class="nano-content pad-all" tabindex="0" style="right: -17px;">
    					<ul class="list-unstyled media-block ul-messages">
    					</ul>
    				</div>
    			<div class="nano-pane"><div class="nano-slider" style="height: 141px; transform: translate(0px, 0px);"></div></div></div>
    
    			<!--Widget footer-->
    			<div class="panel-footer">
    				<div class="row">
    					<div class="col-xs-9">
    						<input type="text" id="input-chat" placeholder="Enter your text" class="form-control chat-input">
    					</div>
    					<div class="col-xs-3">
    						<button class="btn btn-primary btn-block" id="submit-chat" type="submit">Send</button>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
	</div>
</div>
<script>

	var teacherId = "<?php echo $teacherId; ?>";
	var hash = "<?php echo $chatHash ?>";
	var teacherConnected = false;

	connect.config = {
      memberType: "student",
      userId: <?php echo AuthComponent::user('id'); ?>,
      teacherId: parseInt(teacherId),
      chatHash: hash,
      peerId: "STUDENT-<?php echo AuthComponent::user('id'); ?>"
  };
  $(function(){
  	$('#submit-chat').click(function(){
  		var msg = $.trim($('#input-chat').val());
  		if (msg !== ""){
  			eventCommon.sendChat(msg);
  			$('#input-chat').val('');
  		}
  	});

  	$('#input-chat').keypress(function(e){
  		if (e.which === 13){
  			var msg = $.trim($('#input-chat').val());
  			if (msg !== "") {
  				eventCommon.sendChat(msg);
  				$('#input-chat').val('');
  			}
  		}
  	});

  	detectMedia(function(){
  		connect.init(function(conn){
		    eventCommon.init();

		    /* empty for now eventstudent init */
		    // eventStudent.init();

		    eventCommon.connectToRoom();

		  }, function(error, conn){
		      console.error('Error: '+error);
		  });
  	});
	  
  });

  /**
	 * this event will be triggered
	 * when the student has joined the room
	 * @param: data
	 */
	function peerJoinedRoom(data){
		/* set teacher connection to true */
		teacherConnected = true;
		
		/* call peer */
		connect.resetCall();
		connect.resetPeer();
		connect.initializePeer();
	}

	function answeredTeacherCall(){
		teacherConnected = true;
	}

	function videoDisconnected(){
		$(constant.otherCamera).prop('src', '').show();
	}

	function detectMedia(callback){
		connect.initializeCamera(function(success){
        if($.isFunction(callback)) { callback(); }
    }, function(fail){
        console.log(fail);
        console.warn('will not display online teachers bec. media not detected!');
    });
	}

	function ongoingLesson(){

	}
</script>