<?php
	class RatingController extends BaseController{

		public static function create(){
			$games = Game::all();
			View::make('rating/new.html', array('games' => $games));
		}
		
		public static function store(){
			$params = $_POST;			
			$attributes = array(
				'rate' => $params['rate'],
				'account_id' => parent::get_user_logged_in()->id,
				'game_id' => $params['game_id']
			);

			$rating = new Rating($attributes);
			$errors = $rating->errors();
			if(count($errors) == 0){
				$rating->save();
				Redirect::to('/game/' . $rating->game_id, array('message' => 'Arvio lisätty'));
			}else{
				View::make('rating/new.html', array('errors' => $errors, 'attributes' => $attributes));
			}
		}
		
	}