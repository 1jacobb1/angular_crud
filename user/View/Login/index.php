USER
<?php echo $this->Form->create('User'); ?>
  <?php
    echo $this->Form->input('username', array(
      'label' => 'Username'
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