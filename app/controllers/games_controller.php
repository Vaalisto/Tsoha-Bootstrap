<?php
	class GameController extends BaseController{
		public static function index(){
			$games = Game::all();
			View::make('game/index.html', array('games' => $games));
		}

		public static function create(){
			$genres = Genre::all();
			View::make('game/new.html', array('genres' => $genres));
		}

		public static function show($id){
			$game = Game::find($id);
			$average = Game::average_score($id);
			$genres = Game::show_genres($id);
			View::make('game/show.html', array('game' => $game, 'average' => $average, 'genres' => $genres));
		}

		public static function edit($id){
			$game = Game::find($id);
			$genres = Game::form_genres($id);
			View::make('game/edit.html', array('attributes' => $game, 'genres' => $genres));
		}

		public static function store() {
			$params = $_POST;
			$genres = $params['genres'];

			$attributes = array(
				'gamename' => $params['gamename'],
				'published_year' => $params['published_year'],
				'publisher' => $params['publisher'],
				'description' => $params['description'],
				'genres' => array()
			);


			$game = new Game($attributes);
			$errors = $game->errors();
			if(count($errors) == 0){
				$game->save();

				foreach ($genres as $genre){
					$attributes['genres'][] = $genre;
					Genre::addToGameGenre($game->id, $genre);
				}

				Redirect::to('/game/' . $game->id, array('message' => 'Peli on lisätty'));
			}else{
				View::make('game/new.html', array('errors' => $errors, 'attributes' => $attributes));
			}
			
		}

		public static function update($id){
			$params = $_POST;
			$genres = $params['genres'];

			$attributes = array(
				'id' => $id,
				'gamename' => $params['gamename'],
				'published_year' => $params['published_year'],
				'publisher' => $params['publisher'],
				'description' => $params['description'],
				'genres' => array()
			);

			$game = new Game($attributes);
			$errors = $game->errors();

			if(count($errors) == 0){
				$game->update();
				$game->delete_gamegenres();

				foreach ($genres as $genre){
					$attributes['genres'][] = $genre;
					Genre::addToGameGenre($game->id, $genre);
				}

				Redirect::to('/game/' . $game->id, array('message' => 'Peliä muokattu onnistuneesti.'));
			}else{
				View::make('game/edit.html', array('errors' => $errors, 'attributes' => $attributes));
			}


		}

		public static function destroy($id){
			$game = new Game(array('id' => $id));
			$game->destroy();

			Redirect::to('/game', array('message' => 'Peli on poistettu onnistuneesti.'));
		}
	}