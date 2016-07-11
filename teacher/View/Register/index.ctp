<?php echo $this->Form->create('Teacher', array()); ?>
  <?php
    echo $this->Form->input('login_id', array(
      'type' => 'text',
      'label' => __('Username'),
      'required' => 'required'
    ));

    echo $this->Form->input('password', array(
      'type' => 'password',
      'label' => __("Password"),
      'required' => 'required'
    ));

    echo $this->Form->submit('Register');
  ?>
<?php echo $this->Form->end(); ?>
