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
  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }
  public static function register(){
    View::make('users/register.html');
  }
  public static function new_user(){
    $params = $_POST;
    $attributes = array(
      'kayttajatunnus' => $params['kayttajatunnus'],
      'salasana' => $params['salasana'],
      'sahkoposti' => $params['sahkoposti']
    );
    
      $user = new User($attributes);
      $register_errors = $user->register_errors();

  if(count($register_errors) == 0){
    $user->save();

    Redirect::to('/login', array('message' => 'Rekisteröidyit käyttäjäksi!'));
    }else{
    View::make('/users/register.html', array('errors' => $register_errors, 'attributes' => $attributes));
    }
   }
}