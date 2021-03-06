<?php

  class BaseController{

    public static function get_user_logged_in(){
      if(isset($_SESSION['account'])){
        $account_id = $_SESSION['account'];
        $account = Account::find($account_id);

        return $account;
      }
      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['account'])){
        Redirect::to('/login', array('message' => 'Kirjaudu ensin.'));
      }
    }

    public static function is_admin(){
      check_logged_in();
      if (isset($_SESSION['account'])){
        $account = self::get_user_logged_in();
        if(!$account->is_admin){
          Redirect::to('/', array('message' => 'Käyttäjäoikeudet eivät ole riittävät.'));
        }
      }            
    }
  }