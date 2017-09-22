<?php
  class HelloWorldController extends BaseController{
 
  public static function sandbox(){
  $sokeri = Drink::find(1);
    $ingredient = Drink::all();
    // Kint-luokan dump-metodi tulostaa muuttujan arvon
    Kint::dump($ingredient);
    Kint::dump($sokeri);
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
