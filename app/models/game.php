<?php
	class Game extends BaseModel{
		public $id, $gamename, $published_year, $publisher, $description, $added;

		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_name', 'validate_published_year', 'validate_publisher', 'validate_description');
		}

		public function validate_name(){
			$errors = parent::validate_string("Nimi", $this->gamename, 2, 120);
			return $errors;
		}

		public function validate_published_year(){
			$errors = parent::validate_integer("Julkaisuvuosi", $this->published_year);
			return $errors;
		}

		public function validate_publisher(){
			$errors = parent::validate_string("Julkaisija", $this->publisher, 0, 120);
			return $errors;
		}

		public function validate_description(){
			$errors = parent::validate_string("Kuvaus", $this->description, 2, 500);
			return $errors;
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

		public static function genres($id){
			$query = DB::connection()->prepare('SELECT Genre.id, Genre.genrename, Genre.description FROM Genre INNER JOIN GameGenre ON Genre.id = GameGenre.genre_id WHERE GameGenre.game_id = :id');
			$query->execute(array('id' => $id));
			$rows = $query->fetchAll();
			$genres = array();	


			foreach ($rows as $row) {
				$genres[] = new Genre(array(
					'id' => $row['id'],
					'genrename' => $row['genrename'],
					'description' => $row['description']
				));
			}
			return $genres;
		}

		public static function average_score($id){
			$query = DB::connection()->prepare('SELECT AVG(rate) AS average FROM Rating WHERE game_id = :id');
			$query->execute(array('id' => $id));
			$avg = $query->fetch();

			if($avg){
				return $avg['average'];
			}else{
				return null;
			}
		}

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Game (gamename, published_year, publisher, description, added) VALUES (:gamename, :published_year, :publisher, :description, NOW()) RETURNING id');
			$query->execute(array('gamename' => $this->gamename,
														'published_year' => $this->published_year,
													 	'publisher' => $this->publisher,
													 	'description' => $this->description
													 	));
			$row = $query->fetch();			
			$this->id = $row['id'];
		}

		public function update(){
			$query = DB::connection()->prepare('UPDATE Game SET gamename = :gamename, published_year = :published_year, publisher = :publisher, description = :description WHERE id = :id');
			return $query->execute(array('gamename' => $this->gamename,
																	'published_year' => $this->published_year,
																	'publisher' => $this->publisher,
																	'description' => $this->description,
																	'id' => $this->id));
		}

		public function destroy(){
			$query = DB::connection()->prepare('DELETE FROM Game WHERE id = :id');
			$query->execute(array('id' => $this->id));
		}
	}