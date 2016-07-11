<?php
class RegisterController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow(array(
      'index'
    ));
  }

  public $uses = array('User');

  public function index() {
    if ($this->request->is('post')) {
      $data = $this->request->data['User'];
      if (!empty($data['username']) && !empty($data['password'])) {

        $username = trim($data['username']);
        $password = trim($data['password']);

        $userData['User'] = array(
          'username' => $username,
          'password' => $password
        );

        $this->User->set($userData);

        if ($this->User->validates()){

          $password = AuthComponent::password($password);

          $this->User->regist(array(
            'username' => $username,
            'password' => $password,
            'ipAddress' => $this->request->clientIp()
          ));

        } else {
          $errors = $this->User->validationErrors;
        }

      } else {
        $this->Session->setFlash('Username and Password is required!');
      }
    }
  }

}
