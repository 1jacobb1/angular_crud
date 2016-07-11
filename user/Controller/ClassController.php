<?php
class ClassController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public $uses = array(
		'Teacher',
		'OnAir'
	);

	public function index($teacherId, $chatHash) {
		$userId = $this->Auth->user('id');

		if (is_null($teacherId)) {
			return $this->redirect('/home?err=null_teacher_id');
		}

		if (is_null($chatHash)) {
			return $this->redirect('/home?err=null_chat_hash');
		}

		$teacherData = $this->Teacher->findById($teacherId);

		if (!$teacherData) {
			return $this->redirect('/home?err=invalid_teacher');
		}

		$onAir = $this->OnAir->findByChatHash($chatHash);

		if (!$onAir) {
			return $this->redirect('/home?err=invalid_chat_hash');
		}

		$setArray = array(
			'teacherId' => $teacherId,
			'chatHash' => $chatHash
		);
		$this->set($setArray);

	}

}