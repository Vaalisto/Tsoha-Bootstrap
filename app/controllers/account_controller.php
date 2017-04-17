<?php

  class AccountController extends BaseController{
    public static function index(){
      $accounts = Account::all();
      View::make('account/index.html', array('accounts' => $accounts));
    }

    public static function create(){
      View::make('account/new.html');
    }

    public static function show($id){
      $account = Account::find($id);
      View::make('account/show.html', array('account' => $account));
    }

    public static function store(){
      $params = $_POST;
      $attributes = array(
          'accountname' => $params['accountname'],
          'password' => $params['password']
      );

      $account = new Account($attributes);
      $errors = $account->errors();
      if(count($errors) == 0){
        $account->save();

        Redirect::to('/account/' . $account->id, array('messege' => 'Käyttäjätunnus on lisätty'));
      }else{
        View::make('account/new.html', array('errors' => $errors, 'attributes' => $attributes));
      }
    }

    public static function login(){
        View::make('login.html');
    }

    public static function handle_login(){
      $params = $_POST;

      $account = Account::authenticate($params['accountname'], $params['password']);

      if(!$account){
        View::make('login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'accountname' => $params['accountname']));
      }else{
        $_SESSION['account'] = $account->id;

        Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $account->accountname . '!'));
      }
    }

    public static function logout(){
      $_SESSION['account'] = null;
      Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }
  }