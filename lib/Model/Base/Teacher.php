<?php
class Teacher extends AppModel{

	var $useTable = "teachers";

	public $validate = array(
			'login_id' => array(
				'isLoginIdValid' => array(
					'rule' => array('isLoginIdValid', 'login_id'),
					'message' => 'ログインIDは半角英数字3～16文字で入力して下さい。'//Login ID can only contain alphanumeric characters only. 	
				),
				'isUnique' => array(
					'rule' => 'isUnique',
					'message' => 'ログインIDはすでに存在しています。' // Login ID already exists
				)
			),
			'password' => array(
				'isPasswordValid' => array(
					'rule' => array('isPasswordValid', 'password'),
					'message' => 'パスワードは半角英数字7～16文字で入力してください。',
				)
			),
			'password-edit' => array(
				'isPasswordValid' => array(
					'rule' => array('isPasswordValid', 'password-edit'),
					'message' => 'パスワードは半角英数字7～16文字で入力してください。',
					'allowEmpty' => true
				)
			),
			'name' => array(
				'notEmpty' => array(
					'rule'    => 'notEmpty',
					'message' => '名前は必須項目です。',//Name field is required
				 ),
				'maxLength' => array(
						'rule'    => array('maxLength', 20),
						'message' => '講師名（英語）のみ20文字でなければなりません。'//Name must be no larger than 20 characters long.
				),
				'isNameValid' => array(
					'rule' => array('isNameValid', 'name'),
					'message' => '講師名（英語名）は英字で入力してください。' //Only alpha characters are needed.  
				)
			)
	);

	public function isLoginIdValid($data) {
		$string = isset($data['login_id'])? trim($data['login_id']) : null;
		$flag = true;
		if (empty($string)) {
			$flag = false;
		} elseif (!ctype_alnum($string)) {
			$flag = false;
		} elseif (strlen($string) < 3 || strlen($string) > 16) {
			$flag = false;
		}
		return $flag;
	}

	public function isPasswordValid($data) {
		$string = array_values($data);
		$string = isset($string[0])? trim($string[0]) : null;
		$flag = true;
		
		if (empty($string)) {
			$flag = false;
		} elseif (!ctype_alnum($string)) {
			$flag = false;
		} elseif (strlen($string) < 7 || strlen($string) > 16) {
			$flag = false;
		}

		return $flag;
	}

	public function isNameValid($string) {
		$string = array_values($string);
		$string = trim($string[0]);
		if (!preg_match('/[^a-zA-Z★ ]/i', $string)) {
			return true;
		}
		return false;
	}

	public function regist($data){
		$username = $data['login_id'];
		$password = $data['password'];
		$ipAddress = $data['ip'];
		$this->validate = array();
		$this->set(array(
			'username'	=> $username,
			'password'	=> $password,
			'created_date' => date('Y-m-d H:i:s'),
			'modified_date' => date('Y-m-d H:i:s'),
			'created_ip' => $ipAddress,
			'modified_ip' => $ipAddress
		));
		$res = $this->save();
		return 1;
	}

}