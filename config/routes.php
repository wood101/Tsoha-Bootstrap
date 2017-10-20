<?php
  //Drinkin reitit

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
  
  //Ehdotuksien reitit
  
  $routes->get('/proposals', function() {
  ProposalController::list_all();
  });
  
  $routes->post('/proposal', function(){
  ProposalController::store();
  });

  $routes->get('/proposal/add', function(){
  ProposalController::create();
  });

  $routes->get('/proposal/:id', function($id) {
  ProposalController::find($id);
  });    
  
  $routes->post('/proposal/:id/destroy', function($id){
  ProposalController::destroy($id);
  });
  
  $routes->get('/proposal/:id/edit', function($id){
  ProposalController::edit($id);
  });
  
  $routes->post('/proposal/:id/edit', function($id){
  ProposalController::update($id);
  });
  
  $routes->post('/proposal/:id/accept', function($id) {
  ProposalController::accept($id);
  });    
  
  //Kirjautumisen reitit
  
  $routes->get('/login', function(){
  // Kirjautumislomakkeen esittäminen
  UserController::login();
  });
  
  $routes->post('/login', function(){
  // Kirjautumisen käsittely
  UserController::handle_login();
  });
  
  $routes->post('/logout', function(){
  // Uloskirjautuminen
  UserController::logout();
  });
  
  $routes->get('/register', function(){
  // Rekisteröitymislomakkeen esittäminen
  UserController::register();
  });
  
  $routes->post('/register', function(){
  // Rekisteröitymislomakkeen esittäminen
  UserController::new_user();
  });
  
  
