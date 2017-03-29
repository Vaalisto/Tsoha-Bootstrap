<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
  });  

  $routes->get('/game', function() {
    GameController::index();
  });

	$routes->get('/game/1', function() {
  	HelloWorldController::game_show();
	});

	$routes->get('/game/1/edit', function() {
  HelloWorldController::game_edit();
  });

	$routes->get('/login', function() {
  	HelloWorldController::login();
	});