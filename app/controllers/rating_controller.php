<?php
	class RatingController extends BaseController{

		public static function create(){
			View::make('rating/new.html');
		}
		
		public static function store(){
			$params = $_POST;
			$attributes = array(
				'rate' => $params['rate'],
				'account_id' => $params['account_id'],
				'game_id' => $params['game_id']
			);

			$ratings = new Rating($attributes);
			$errors = $ratings->errors();
			if(count($errors) == 0){
				$rating->save();
				Redirect::to('/game/' . $rating->game_id, array('message' => 'Arvio lisätty'));
			}else{
				View::make('rating/new.html', array('errors' => $errors, 'attributes' => $attributes));
			}
		}
	}