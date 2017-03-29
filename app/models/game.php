<?php
	class Game extends BaseModel{
		public $id, $gamename, $published_year, $publisher, $description, $added;

		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Game');
			$query->execute();
			$rows = $query->fetchAll();
			$games = array();

			foreach($rows as $row){
				$games[] = new Game(array(
					'id' => $row['id'],
					'gamename' => $row['gamename'],
					'published_year' => $row['published_year'],
					'publisher' => $row['publisher'],
					'description' => $row['description'],
					'added' => $row['added']
				));
			}
			return $games;
		}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Game WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();

			if($row){
				$game = new Game(array(
					'id' => $row['id'],
					'gamename' => $row['gamename'],
					'published_year' => $row['published_year'],
					'publisher' => $row['publisher'],
					'description' => $row['description'],
					'added' => $row['added']
				));
				return $game;
			}
			return null;
		}
	}