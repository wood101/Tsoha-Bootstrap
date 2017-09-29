<?php
  class HelloWorldController extends BaseController{
 
  public static function sandbox(){
  $drinkki = new Drink(array(
    'nimi' => 'h',
    'ohje' => 'jotain',
    'juomalaji' => ''
  ));
  $errors = $drinkki->errors();

  Kint::dump($errors);
} 
  
  public static function login(){
    View::make('suunnitelmat/login.html');
  }
    public static function user(){
    View::make('suunnitelmat/user.html');
  }
    public static function authorize(){
    View::make('suunnitelmat/authorize.html');
  }
      public static function proposals(){
    View::make('suunnitelmat/proposals.html');
  }
}
