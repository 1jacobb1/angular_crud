<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php //echo $cakeDescription ?>:
		<?php //echo $this->fetch('title'); ?>
		User
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');

		echo $this->Html->script(array(
			'jquery.min.js',
			'bootstrap.min.js',
			'bootstrap-formhelpers.min.js',
			'bootstrap-typeahead.js',
			'jquery.mask.min.js',
			'metisMenu.min.js',
			'sb-admin-2.js',
			'status.main.js',
			'underscore.js',
			'angular.min.js'
		));

		echo $this->Html->css(array(
			'bootstrap.min.css',
		));
	?>
</head>
<body style="background: #f8f8f8;">
	<div class="container">
		<?php echo $this->Session->flash(); ?>
		
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>