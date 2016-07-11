<?php
class HomeController extends AppController {

	public $uses = array(
		'OnAir'
	);

	public function beforeFilter(){
		parent::beforeFilter();
		if (!$this->Auth->User()){
			return $this->redirect('/login');	
		}

		$this->onAir = $this->OnAir->find('all', array(
    	'fields' => array('OnAir.*', 'Teacher.*'),
    	'conditions' => array(
    		'OnAir.connect_flag' => 1,
    		'OnAir.status' => 1
    	),
    	'joins' => array(
    		array(
    			'table' => 'teachers',
    			'alias' => 'Teacher',
    			'conditions' => 'Teacher.id = OnAir.teacher_id'
    		)
    	)
    ));

	}

	private $onAir = null;

  public function index() {
  }

  public function getTeachers(){
  	$this->autoRender = false;
  	$this->set('teacherOnAirs', $this->onAir);
  	$this->render('teacher_on_airs');
  }

}
