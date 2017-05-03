<?php
	class GenreController extends BaseController{
		public static function index(){
			$genres = Genre::all();
			View::make('genre/index.html', array('genres' => $genres));
		}

		public static function create(){
			View::make('genre/new.html');
		}

		public static function show($id){
			$genre = Genre::find($id);
			$games = Genre::gamesInGenre($id);
			View::make('genre/show.html', array('genre' => $genre, 'games' => $games));
		}

		public static function edit($id){
			$genre = Genre::find($id);
			View::make('genre/edit.html', array('attributes' => $genre));
		}

		public static function store() {
			$params = $_POST;
			$attributes = array(
				'genrename' => $params['genrename'],				
				'description' => $params['description']
			);

			$genre = new Genre($attributes);
			$errors = $genre->errors();
			if(count($errors) == 0){
				$genre->save();

				Redirect::to('/genre/' . $genre->id, array('message' => 'Genre on lisätty'));
			}else{
				View::make('genre/new.html', array('errors' => $errors, 'attributes' => $attributes));
			}

			
		}

		public static function update($id) {
			$params = $_POST;
			$attributes = array(
				'id' => $id,
				'genrename' => $params['genrename'],				
				'description' => $params['description']
			);

			$genre = new Genre($attributes);
			$errors = $genre->errors();
			if(count($errors) == 0){
				$genre->update();

				Redirect::to('/genre/' . $genre->id, array('message' => 'Genreä muokattu onnistuneesti.'));
			}else{
				View::make('genre/edit.html', array('errors' => $errors, 'attributes' => $attributes));
			}

			
		}

		public static function destroy($id){
			$genre = new Genre(array('id' => $id));
			$genre->destroy();

			Redirect::to('/genre', array('message' => 'Genre poistettu onnistuneesti.'));
		}
		
	}