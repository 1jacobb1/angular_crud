<!-- test connect -->
<li class="user_list_item user_list_item--online" style="opacity: 1;">
	<a href="#" rel="popwin" data-width="1020">
		<figure class="thumb"><img class="pic" src="https://dev2web.nativecamp.net/user/images/icon/thumb_test_connect.jpg"></figure>
		<div class="name_area">
			<p class="name m_l_0">通信テスト</p>
			<p class="kana">TEST CALL</p>
		</div>
	</a>
</li>
<!-- test connect -->    

<?php if ($teacherOnAirs): ?>
	<?php foreach($teacherOnAirs as $val): ?>
	<li class="b_link user_list_item user_list_item--wait" style="opacity: 1;" onClick="callTeacher('<?php echo $val['OnAir']['teacher_id']; ?>' ,'<?php echo $val['OnAir']['chat_hash']; ?>')">
		<a href="javascript:void(0)">
			<figure class="thumb"><img class="pic" src="https://pbs.twimg.com/profile_images/378800000003051007/01e9f11c2c487fe75f5ae6e1fd3e1d33_400x400.jpeg" alt="Counselor"></figure>
			<div class="name_area">
				<p class="name"><span class="lesson_status_circle lesson_status_circle--wait"></span><?php echo $val['Teacher']['login_id']; ?></p>
				<p class="kana">カウンセラー</p>
			</div>
		</a>
	</li>
	<?php endforeach; ?>
<?php endif; ?>