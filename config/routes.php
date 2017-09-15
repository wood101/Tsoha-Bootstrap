<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/drink', function() {
  HelloWorldController::drink_list();
  });
  
  $routes->get('/drink/1', function() {
  HelloWorldController::drink_show();
  });
  
  $routes->get('/drink/2', function() {
  HelloWorldController::drink_add();
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
