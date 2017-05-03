<?php
	class Genre extends BaseModel{
		public $id, $genrename, $description, $game_id;

		public function __construct($attributes){
			parent::__construct($attributes);
			$this->validators = array('validate_name', "validate_description");
		}

		public function validate_name(){
			$errors = parent::validate_string("Nimi", $this->genrename, 2, 30);
			return $errors;
		}

		public function validate_description(){
			$errors = parent::validate_string("Kuvaus", $this->description, 2, 300);
			return $errors;
		}

		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Genre ORDER BY genrename');
			$query->execute();
			$rows = $query->fetchAll();
			$genres = array();

			foreach($rows as $row){
				$genres[] = new Genre(array(
					'id' => $row['id'],
					'genrename' => $row['genrename'],					
					'description' => $row['description']
				));
			}
			return $genres;
		}

		public static function find($id){
			$query = DB::connection()->prepare('SELECT * FROM Genre WHERE id = :id LIMIT 1');
			$query->execute(array('id' => $id));
			$row = $query->fetch();

			if($row){
				$genre = new Genre(array(
					'id' => $row['id'],
					'genrename' => $row['genrename'],					
					'description' => $row['description']
				));
				return $genre;
			}
			return null;
		}

		public static function addToGameGenre($game_id, $genre_id){
			$query = DB::connection()->prepare('INSERT INTO GameGenre (game_id, genre_id) VALUES (:game_id, :genre_id)');
			$query->execute(array('game_id' => $game_id, 'genre_id' => $genre_id));
		}

		public static function gamesInGenre($id){
			$query = DB::connection()->prepare('SELECT Game.id, Game.gamename, Game.published_year, Game.publisher, Game.description, Game.added FROM Game INNER JOIN GameGenre ON Game.id = GameGenre.game_id WHERE GameGenre.genre_id = :id ORDER BY Game.gamename');
			$query->execute(array('id' => $id));
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

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Genre (genrename, description) VALUES (:genrename, :description) RETURNING id');
			$query->execute(array('genrename' => $this->genrename, 'description' => $this->description));
			$row = $query->fetch();			
			$this->id = $row['id'];
		}

		public function update(){
			$query = DB::connection()->prepare('UPDATE Genre SET genrename = :genrename, description = :description WHERE id = :id');
			return $query->execute(array('genrename' => $this->genrename, 'description' => $this->description, 'id' => $this->id));			
		}

		public function destroy(){
			$query = DB::connection()->prepare('DELETE FROM Genre WHERE id = :id');
			$query->execute(array('id' => $this->id));
		}
	}