<?php

class RegisterController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow(array(
      'index'
    ));
  }

  public $uses = array('Teacher');

  public function index() {
    if ($this->request->is('post')) {
      $data = $this->request->data['Teacher'];
      $loginId = trim($data['login_id']);
      $password = trim($data['password']);
      if (!empty($data['login_id']) && !empty($data['password'])) {

        $teacherData['Teacher'] = array(
          'login_id' => $loginId,
          'password' => $password
        );
        $this->Teacher->set($teacherData);

        if ($this->Teacher->validates()){

          $password = AuthComponent::password($password);

          $this->Teacher->regist(array(
            'login_id' => $loginId,
            'password' => $password,
            'name' => '',
            'ip' => $this->request->clientIp(),
            'date' => date('Y-m-d H:i:s')
          ));

        } else {
          $errors = $this->Teacher->validationErrors;
        }

      } else {
        $this->Session->setFlash('Username and Password is required!');
      }
    }
  }

}
