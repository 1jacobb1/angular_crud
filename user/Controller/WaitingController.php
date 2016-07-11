<?php
class WaitingController extends AppController{

	public function beforeFilter(){
		parent::beforeFilter();
	}

	public $teacherData = null;

	public $uses = array(
		'OnAir',
		'Teacher'
	);

	public function detail($teacherId){
		$teacherData = $this->Teacher->find('first', array(
			'fields' => array('Teacher.*', 'OnAir.*'),
			'conditions' => array(
				'Teacher.id' => $teacherId
			),
			'joins' => array(
				array(
					'table' => 'on_airs',
					'alias' => 'OnAir',
					'conditions' => 'OnAir.teacher_id = Teacher.id'
				)
			)
		));
		$this->set('teacherData', $teacherData);
	}

}