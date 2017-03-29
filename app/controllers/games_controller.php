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

		public static function store() {
			$params = $_POST;
			$game = new Game(array(
				'gamename' => $params['gamename'],
				'published_year' => $params['published_year'],
				'publisher' => $params['publisher'],
				'description' => $params['description']
			));			

			$game->save();

			Redirect::to('/game/' . $game->id, array('message' => 'Peli on lisätty'));
		}
	}