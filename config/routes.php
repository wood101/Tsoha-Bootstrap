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
  DrinksController::drink_show($id);
  });    
  
  //Vanhat reitit alkaa tästä
  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/authorize', function() {
  HelloWorldController::authorize();
  });
  
  $routes->get('/user', function() {
  HelloWorldController::user();
  });
  
  $routes->get('/login', function() {
  HelloWorldController::login();
  });
  
    $routes->get('/proposals', function() {
  HelloWorldController::proposals();
  });
