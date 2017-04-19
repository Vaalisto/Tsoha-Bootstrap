<?php
	class Rating extends BaseModel{
		public $id, $rate, $account_id, $game_id;

		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_rate');
		}

		public function validate_rate(){
			$errors = parent::validate_range("Arvosana", $this->rate, 1, 10);
			return $errors;
		}	

		public static function all(){
				$query = DB::connection()->prepare('SELECT * FROM Rating');
				$query->execute();
				$rows = $query->fetchAll();
				$ratings = array();

				foreach($rows as $row){
					$ratings[] = new Rating(array(
						'id' => $row['id'],
						'rate' => $row['rate'],					
						'account_id' => $row['account_id'],
						'game_id' => $row['game_id']
					));
				}
				return $ratings;
			}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Rating WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();

			if($row){
				$rating = new Rating(array(
					'id' => $row['id'],
					'rate' => $row['rate'],					
					'account_id' => $row['account_id'],
					'game_id' => $row['game_id']
				));
				return $genre;
			}
			return null;			
		}

		public function save(){
			$query = DB::connection()-prepare('INSERT INTO Rating (rate, account_id, game_id) VALUES (:rate, :account_id, :game_id)');
			$query->execute(array('rate' => $this->rate,
														'account_id' => $this->account_id,
														'game_id' => $this->game_id
														));
			$row = $query->fetch();
			$this->game_id = $row['game_id'];
		}
	}
