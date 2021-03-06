<?php
  
  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      $scythe = new Game(array(
        'gamename' => 's',
        'published_year' => 'ens vuoden keskiviikkona',
        'publisher' => 'mutsis',
        'description' => 'Oispa peliä'
      ));
      $errors = $scythe->errors();

      Kint::dump($errors);
    }

    public static function etusivu(){
      View::make('suunnitelmat/index.html');
    }

    public static function game_list(){
      View::make('suunnitelmat/game_list.html');
    }

    public static function game_show(){
      View::make('suunnitelmat/game_show.html');
    }

    public static function game_edit(){
      View::make('suunnitelmat/game_edit.html');
    }

    public static function login(){
      View::make('suunnitelmat/login.html');
    }

  }
