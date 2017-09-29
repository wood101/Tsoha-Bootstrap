<?php

  $routes->get('/', function() {
  DrinksController::index();
  });
  
  $routes->post('/drink', function(){
  DrinksController::store();
  });

  $routes->get('/drink/add', function(){
  DrinksController::create();
  });

  $routes->get('/drink/:id', function($id) {
  DrinksController::find($id);
  });    
  
  $routes->post('/drink/:id/destroy', function($id){
  DrinksController::destroy($id);
  });
  
  $routes->get('/drink/:id/edit', function($id){
  DrinksController::edit($id);
  });
  
  $routes->post('/drink/:id/edit', function($id){
  DrinksController::update($id);
  });
  
  $routes->get('/login', function(){
  // Kirjautumislomakkeen esittäminen
  UserController::login();
  });
  
  $routes->post('/login', function(){
  // Kirjautumisen käsittely
  UserController::handle_login();
  });
  
  //Vanhat reitit alkaa tästä
  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/authorize', function() {
  HelloWorldController::authorize();
  });
  
  $routes->get('/user', function() {
  HelloWorldController::user();
  });
  
    $routes->get('/proposals', function() {
  HelloWorldController::proposals();
  });
