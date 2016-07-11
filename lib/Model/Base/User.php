<?php
class User extends AppModel{
	var $useTable = "users";

	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule'    => 'notEmpty',
				'message' => 'ニックネームは必須項目です。', //Nickname is a required item.
			),
			'isUnique' => array(
				'rule' => array('isUsernameUnique'),
				'message' => 'Username already exists'
			),
			'maxLength' => array(
				'rule'    => array('maxLength', 50),
				'message' => 'お名前は50文字以内で入力して下さい。'//Nickname must be no larger than 50 characters long.
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'パスワードは必須項目。入力してください。' // Password is required item.
			),
			'between' => array(
				'rule' => array('between', 8, 16),
				'message' => '8文字以上16文字以下で入力してください。' //Please enter the following 8 to 16 characters.
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => '半角英数字で入力してください。' //Please enter alphanumeric characters.
			)
		),
		'password_confirm' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'パスワード（確認用）は必須項目です。入力してください。' // Password (for confirmation) are mandatory.
			),
			'between' => array(
				'rule' => array('between', 8, 16),
				'message' => '8文字以上16文字以下で入力してください。' //Please enter the following 8 to 16 characters.
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => '半角英数字で入力してください。'//Confirm Password can only contain alphanumeric characters only
			),
			'compare' => array(
				'rule' => array('equaltofield','password'),
				'message' => 'パスワードが一致しません。',//Password does not match
			)
		),
		'password_new' => array(
			'between' => array(
				'rule' => array('between', 8, 16),
				'message' => '新しいパスワードは8～16文字で必須です。'//Password must be between 8 to 16 characters
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => '新しいパスワードは半角英数字のみで必須です。' //Password can only contain alphanumeric characters only
			)
		),
		'password_confirm_new' => array(
			'between' => array(
				'rule' => array('between', 8, 16),
				'message' => '新しいパスワード(確認)は8～16文字で必須です。' //Confirm Password must be between 8 to 16 characters
			),
			'alphaNumeric' => array(
				'rule' => 'alphaNumeric',
				'message' => '新しいパスワード(確認)は半角英数字のみで必須です。'//Confirm Password can only contain alphanumeric characters only
			),
			'compare' => array(
				'rule' => array('equaltofield','password_new'),
				'message' => 'パスワードが一致しません。',//Password does not match
			)
		)
	);
	
	function equaltofield($check,$otherfield) {
		$fname = '';
		foreach ($check as $key => $value) {
			$fname = $key;
			break;
		}
		return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
	}

	function regist($data) {
		if (empty($data['username']) || empty($data['password'])) {
			return ;
		}

		$username = $data['username'];
		$password = $data['password'];
		$ipAddress = $data['ipAddress'];
		// 状態を本登録へ変更
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

	function isUsernameUnique($data){
		if (empty($data['username'])){
			return;
		}
		$username = $data['username'];
		$count = $this->find('count', array('conditions' => array('User.username' => $data['username'])));
		return ($count>0) ? 0 : 1;

	}

}