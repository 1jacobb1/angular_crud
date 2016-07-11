<?php
class LoginController extends AppController {

  public function beforeFilter(){
    parent::beforeFilter();
  }

  public $uses = array(
    "Teacher",
    "OnAir"
  );

  public function index() {
    if ($this->Auth->User('id')){
      return $this->redirect('/');
    }

    if ($this->request->is('post')) {
      $data = $this->request->data['Teacher'];
      $teacher = $this->Teacher->find('first', array(
        'conditions' => array(
          'login_id' => $data['login_id'],
          'password' =>  AuthComponent::password($data['password'])
        )
      ));
      if ($this->Auth->login($teacher['Teacher'])) {
        return $this->redirect($this->Auth->redirectUrl());
      } else {
        $this->Session->setFlash(__('Username or Password is invalid'));
      }
    }
  }

  public function logout() {
    $this->OnAir->delete($this->Auth->User('id'));
    return $this->redirect($this->Auth->logout());
  }

}
