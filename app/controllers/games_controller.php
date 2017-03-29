<?php
	class GameController extends BaseController{
		public static function index(){
			$games = Game::all();
			View::make('game/index.html', array('games' => $games));
		}

		public static function show($id){
			$game = Game::find($id);
			View::make('game/show.html', array('game' => $game));
		}
	}