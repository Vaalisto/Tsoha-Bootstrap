<?php
	class Account extends BaseModel{
		public $id, $accountname, $password, $is_admin;

		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_name', 'validate_password');
		}

		public function validate_name(){
			$errors = parent::validate_string("Nimi", $this->accountname, 3, 30);
			return $errors;
		}

		public function validate_password(){
			$errors = parent::validate_string("Salasana", $this->password, 5, 120);
			return $errors;
		}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Account WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();

			if($row){
				$account = new Account(array(
								'id' => $row['id'],
								'accountname' => $row['accountname'],
								'password' => $row['password'],
								'is_admin' => $row['is_admin']
				));
				return $account;
			}
			return null;
		}

		public static function save(){
			$query = DB::connection()->prepare('INSERT INTO Account (accountname, password) VALUES (:accountname, :password) RETURNING id');
			$query->execute(array('accountname' => $this->accountname, 'password' => $this->password));
			$row = $query->fetch();
			$this->id = $row['id'];
		}

		public static function authenticate($accountname, $password){
			$query = DB::connection()->prepare('SELECT * FROM Account WHERE accountname = :accountname AND password = :password LIMIT 1');
			$query->execute(array('accountname' => $accountname, 'password' => $password));
			$row = $query->fetch();
			if($row){
				$account = new Account(array(
								'id' => $row['id'],
								'accountname' => $row['accountname'],
								'password' => $row['password'],
								'is_admin' => $row['is_admin']
				));
				return $account;
			}
			return null;
		}


	}