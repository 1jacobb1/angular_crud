<?php
class HomeController extends AppController {

	public $uses = array(
		'OnAir'
	);

	public function beforeFilter(){
		parent::beforeFilter();
		if (!$this->Auth->User()) {
			return $this->redirect('/login');
		}
	}

  public function index() {
  	$teacherId = $this->Auth->User('id');
    $onAir = $this->OnAir->findByTeacherId($teacherId);
    $data = array();
    if (!$onAir) {
    	$data = $this->OnAir->register(array(
    		'user_id' => '',
    		'teacher_id' => $teacherId,
    		'status' => 1,
    		'connect_flag' => 0,
    		'ip' => $this->request->clientIp()
    	));
    }

    $data = !$onAir ? $data : $onAir;
    $this->set('onAir', $data);
    $this->set('connectFlag', $data['OnAir']['connect_flag']);
    $connectFlagDesc = $data['OnAir']['connect_flag'] == 1 ? 'STANDBY' : 'NOT STANDBY';
    $this->set('connectFlagDesc', $connectFlagDesc);
    $this->set('status', $data['OnAir']['status']);

  }

  public function chat(){
    $teacherId = $this->Auth->User('id');
    $onAir = $this->OnAir->findByTeacherId($teacherId);
    $data = !$onAir ? $data : $onAir;
    $this->set('onAir', $data);
    $data = $data['OnAir'];
    $this->set('connectFlag', $data['connect_flag']);
    $connectFlagDesc = $data['connect_flag'] == 1 ? 'STANDBY' : 'NOT STANDBY';
    $this->set('connectFlagDesc', $connectFlagDesc);
    $this->set('status', $data['status']);
    $this->set('studentId', $data['user_id']);
    $this->set('chatHash', $data['chat_hash']);
    $this->set('teacherId', $data['teacher_id']);
    return $this->render('index');
  }

  public function updateStatus(){
    $this->autoRender = false;
    $response = array(
      'error' => false,
      'content' => ''
    );
    if ($this->request->is('post')){
      $data = $this->request->data;
      $onAir = $this->OnAir->findByTeacherId($data['teacherId']);
      $chatHash = $this->generateOnAirChatHash();
      if ($onAir){
          $chatHash = $data['teacherId'].'-'.$chatHash;
          $onAir = $this->OnAir->update(array(
            'id' => $onAir['OnAir']['id'],
            'connect_flag' => $data['connectFlag'],
            'status' => 1,
            'chat_hash' => $data['connectFlag'] == 1 ? $chatHash: null,
            'modified_ip' => $this->request->clientIp()
          ));
        $response['content'] = array(
          'connectFlag' => $data['connectFlag']
        );
      } else {
        $response['error'] = true;
        $response['content'] = 'on_air_data_not_exist';
      }
      return json_encode($response);
    }
  }

  private function generateOnAirChatHash(){
    $hash = '';
    $date = date('Y-m-d H:i:s');
    $hash = AuthComponent::password($date);
    return $hash;
  }

}
