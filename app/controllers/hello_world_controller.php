<?php

  class HelloWorldController extends BaseController{

   public static function index(){
    // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
    View::make('home.html');
  }   
      
  public static function sandbox(){
  View::make('helloworld.html');
  }      
      
  public static function drink_list(){
    View::make('suunnitelmat/drink_list.html');
  }

  public static function drink_show(){
    View::make('suunnitelmat/drink_show.html');
  }
    public static function drink_add(){
    View::make('suunnitelmat/drink_add.html');
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
