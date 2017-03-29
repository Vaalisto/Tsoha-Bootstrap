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

  $routes->get('game/new', function(){
    GameController::create();
  });

  $routes->get('/game/:id', function($id) {
    GameController::show($id);
  });