<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }

  function is_admin(){
    BaseController::is_admin();
  }

  $routes->get('/', function() {
    GameController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  ## Game
  $routes->get('/game', function() {
    GameController::index();
  });		

  $routes->post('/game', 'check_logged_in', function(){
    GameController::store();
  });

  $routes->get('/game/new', 'check_logged_in', function(){
    GameController::create();
  });

  $routes->get('/game/:id', function($id){
    GameController::show($id);
  });

  $routes->get('/game/:id/edit', 'check_logged_in', function($id){
    GameController::edit($id);
  });

  $routes->post('/game/:id/edit', 'check_logged_in', function($id){
    GameController::update($id);
  });

  $routes->post('/game/:id/destroy', 'check_logged_in', function($id){
    GameController::destroy($id);
  });


  ## Genre
  $routes->get('/genre', function() {
    GenreController::index();
  });   

  $routes->post('/genre', 'check_logged_in', function(){
    GenreController::store();
  });

  $routes->get('/genre/new', 'check_logged_in', function(){
    GenreController::create();
  });

  $routes->get('/genre/:id', function($id) {
    GenreController::show($id);
  });

  $routes->get('/genre/:id/edit', 'check_logged_in', function($id){
    GenreController::edit($id);
  });

  $routes->post('/genre/:id/edit', 'check_logged_in', function($id){
    GenreController::update($id);
  });

  $routes->post('/genre/:id/destroy', 'check_logged_in', function($id){
    GenreController::destroy($id);
  });

  #Account
  $routes->get('/login', function(){
    AccountController::login();
  });

  $routes->post('/login', function(){
    AccountController::handle_login();
  });

  $routes->get('/logout', function(){
    AccountController::logout();
  });

  $routes->get('/account', 'is_admin', function(){
    AccountController::index();
  });

  $routes->post('/account', 'is_admin', function(){
    AccountController::store();
  });

  $routes->get('/account/new', 'is_admin', function(){
    AccountController::create();
  });

  $routes->get('/account/:id', 'is_admin', function($id){
    AccountController::show($id);
  });

  $routes->get('/account/:id/edit', 'is_admin', function($id){
    AccountController::edit($id);
  });

  $routes->post('/account/:id/edit', 'is_admin', function($id){
    AccountController::update($id);
  });

  $routes->post('/account/:id/destroy', 'is_admin', function($id){
    AccountController::destroy($id);
  });



  #Rating
  $routes->post('/rating/new', 'check_logged_in', function(){
    RatingController::store();  
  });

  $routes->get('/rating/new', 'check_logged_in', function(){
    RatingController::create();
  });