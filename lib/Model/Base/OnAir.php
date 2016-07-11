<?php
class OnAir extends AppModel{
	var $useTable = "on_airs";

	public function register($data){
		
		$this->set(array(
			'teacher_id' => $data['teacher_id'] ,
			'user_id' => 0,
			'status' => $data['status'] ,
			'connect_flag' => $data['connect_flag'] ,
			'created_ip' => $data['ip'] ,
			'modified_ip' => $data['ip'] ,
			'created_date' => date('Y-m-d H:i:s') ,
			'modified_date' => date('Y-m-d H:i:s')
		));

		$this->save();

		return $this->data;

	}

	public function update($data){
		$data['modified_date'] = date('Y-m-d H:i:s');
		$this->set($data);
		$this->save();
	}


}