<?php

class UserController extends BaseController{
  public static function login(){
      View::make('users/login.html');
  }
  public static function handle_login(){
    $params = $_POST;
    
      $user = User::authenticate($params['kayttajatunnus'], $params['salasana']);
      
    if(!$user){
      View::make('users/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttajatunnus' => $params['kayttajatunnus']));
    }else{
      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->kayttajatunnus . '!'));
    }
  }
}