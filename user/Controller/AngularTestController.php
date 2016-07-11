<?php

class AngularTestController extends AppController {

	public function beforeFilter(){
		parent::beforeFilter();
		$this->layout = "angular";
	}

	public $uses = array(
		'Product'
	);

	public function index(){

	}

	public function getProducts(){
		$this->autoRender = false;
		$response = array();
		if ($this->request->is('post')){
			$products = $this->Product->find('all', array(
				'conditions' => array('Product.status' => 1)
			));
			$productsArr = array();
			foreach ($products as $prod){
				$productsArr[] = $prod['Product'];
			}
			return json_encode(array('data' => $productsArr));
		}
	}

	public function addProduct(){
		$this->autoRender = false;
		$response = array('success' => false);
		if ($this->request->is('post')){
			$data = $this->request->data;
			if ($data){
				$this->Product->create();
				$data['status'] = 1;
				$this->Product->set($data);
				$newData = $this->Product->save();
				$response['success'] = true;
				$response['content'] = $newData['Product'];
			}
		}
		return json_encode($response);
	}

	public function deleteProduct(){
		$this->autoRender = false;
		$response = array('error' => false);
		if ($this->request->is('post')){
			$data = $this->request->data;

			$this->Product->id = $data['id'];
			$this->Product->set(array('status' => 0));
			if(!$this->Product->save()){
				$response['error'] = __('Saving failed');
			}
		}
		return json_encode($response);
	}
}
