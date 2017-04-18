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

		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Account');
			$query->execute();
			$rows = $query->fetchAll();
			$accounts = array();

			foreach ($rows as $row){
				$accounts[] = new Account(array(
					'id' => $row['id'],
					'accountname' => $row['accountname'],
					'password' => $row['password'],
					'is_admin' => $row['is_admin']
				));
			}
			return $accounts;
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

		public function update(){
			$query = DB::connection()->prepare('UPDATE Account SET accountname = :accountname, 
				password = :password, 
				is_admin = :is_admin
				WHERE id = :id');
			return $query->execute(array('accountname' => $this->accountname,
																	'password' => $this->password,
																	'is_admin' => $this->is_admin,
																	'id' => $this->id));
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

		public static function rated_games($id){
			$query = DB::connection()->prepare('SELECT Game.id AS id, Game.gamename AS name, Rating.rate AS rate FROM Game INNER JOIN Rating ON Game.id = Rating.game_id WHERE account_id = :id');
			$query->execute(array('id' => $id));
			$rows = $query->fetchAll();
			$games = array();
			foreach($rows as $row){
				$games[] = array(
					'id' => $row['id'],
					'name' => $row['name'],
					'rate'=> $row['rate']					
				);
			}
			return $games;
		}

		public function destroy(){
			$query = DB::connection()->prepare('DELETE FROM Account WHERE id = :id');
			$query->execute(array('id' => $this->id));
		}

	}