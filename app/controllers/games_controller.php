<?php
	class GameController extends BaseController{
		public static function index(){
			$games = Game::all();
			View::make('game/index.html', array('games' => $games));
		}

		public static function create(){
			View::make('game/new.html');
		}

		public static function show($id){
			$game = Game::find($id);
			View::make('game/show.html', array('game' => $game));
		}

		public static function edit($id){
			$game = Game::find($id);
			View::make('game/edit.html', array('attributes' => $game));
		}

		public static function store() {
			$params = $_POST;
			$attributes = array(
				'gamename' => $params['gamename'],
				'published_year' => $params['published_year'],
				'publisher' => $params['publisher'],
				'description' => $params['description']
			);


			$game = new Game($attributes);
			$errors = $game->errors();
			if(count($errors) == 0){
				$game->save();

				Redirect::to('/game/' . $game->id, array('message' => 'Peli on lisätty'));
			}else{
				View::make('game/new.html', array('errors' => $errors, 'attributes' => $attributes));
			}
			
		}

		public static function update($id){
			$params = $_POST;

			$attributes = array(
				'id' => $params['id'],
				'gamename' => $params['gamename'],
				'published_year' => $params['published_year'],
				'publisher' => $params['publisher'],
				'description' => $params['description']
			);

			$game = new Game($attributes);
			$errors = $game->errors();
			if(count($errors) == 0){
				$game->update();
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