<?php
	class Genre extends BaseModel{
		public $id, $genrename, $description;

		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public static function all(){
			$query = DB::connection()->prepare('SELECT * FROM Genre');
			$query->execute();
			$rows = $query->fetchAll();
			$genres = array();

			foreach($rows as $row){
				$genres[] = new genre(array(
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
				$genre = new genre(array(
					'id' => $row['id'],
					'genrename' => $row['genrename'],					
					'description' => $row['description']
				));
				return $genre;
			}
			return null;
		}

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Genre (genrename, description) VALUES (:genrename, :description) RETURNING id');
			$query->execute(array('genrename' => $this->genrename, 'description' => $this->description));
			$row = $query->fetch();			
			$this->id = $row['id'];
		}
	}