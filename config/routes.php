<?php

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

  $routes->post('/game', function(){
    GameController::store();
  });

  $routes->get('/game/new', function(){
    GameController::create();
  });

  $routes->get('/game/:id', function($id){
    GameController::show($id);
  });

  $routes->get('/game/:id/edit', function($id){
    GameController::edit($id);
  });

  $routes->post('/game/:id/edit', function($id){
    GameController::update($id);
  });

  $routes->post('/game/:id/destroy', function($id){
    GameController::destroy($id);
  });


  ## Genre
  $routes->get('/genre', function() {
    GenreController::index();
  });   

  $routes->post('/genre', function(){
    GenreController::store();
  });

  $routes->get('/genre/new', function(){
    GenreController::create();
  });

  $routes->get('/genre/:id', function($id) {
    GenreController::show($id);
  });

  $routes->get('/genre/:id/edit', function($id){
    GenreController::edit($id);
  });

  $routes->post('/genre/:id/edit', function($id){
    GenreController::update($id);
  });

  $routes->post('/genre/:id/destroy', function($id){
    GenreController::destroy($id);
  });