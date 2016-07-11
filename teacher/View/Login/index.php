TEACHER PAGE
<?php echo $this->Form->create('Teacher'); ?>
  <?php
    echo $this->Form->input('login_id', array(
      'label' => 'Username',
      'type' => 'text'
    ));
    echo $this->Form->input('password', array(
      'label' => 'Password'
    ));
    echo $this->Form->submit('Login');
  ?>
<?php echo $this->Form->end(); ?>
<div>
	No account? <a href="<?php echo $this->Html->url('/register'); ?>">Register</a>
</div>