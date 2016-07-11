<?php echo $this->element('header'); ?>

<?php echo $this->element('chat_area'); ?>
<script>
	var teacherId = "<?php echo $this->Session->read('Auth.User.id'); ?>";
	var teacherName = "<?php echo $this->Session->read('Auth.User.login_id'); ?>";
	var status = "<?php echo $onAir['OnAir']['status']; ?>";
	var connectFlag = "<?php echo $onAir['OnAir']['connect_flag']; ?>";
</script>
<link rel="stylesheet" type="text/css" href="/user/css/mychat.css"/>
<div id="mychat" hidden>
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