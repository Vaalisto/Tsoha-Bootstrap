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
			View::make('genre/show.html', array('genre' => $genre));
		}		

		public static function store() {
			$params = $_POST;
			$genre = new genre(array(
				'genrename' => $params['genrename'],				
				'description' => $params['description']
			));			

			$genre->save();

			Redirect::to('/genre/' . $genre->id, array('message' => 'Genre on lisätty'));
		}
	}