<?php
class LoginController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public $uses = array(
		"User"
	);

	public function index() {
		if ($this->Auth->User('id')) {
			return $this->redirect('/');
		}

		if ($this->request->is('post')) {
			$data = $this->request->data;
			$user = $this->User->find('first', array(
				'conditions' => array(
				'username' => $data['User']['username'],
				'password' =>  AuthComponent::password($data['User']['password'])
				)
			));

			if (isset($user['User'])){
				if ($this->Auth->login($user['User'])) {
					return $this->redirect($this->Auth->redirectUrl());
				} else {
					$this->Session->setFlash(__('Username or Password is invalid'));
				}
			}
		}
	}

	public function logout() {
		return $this->redirect($this->Auth->logout());
	}
}
