<?php
class Product extends AppModel{
	public $useTable = "products";

	public function getActiveProducts(){
		$products = $this->find('all', array(
			'conditions' => array(
				'Product.status' => 1
			)
		));
		return $products;
	}

}