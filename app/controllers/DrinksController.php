<?php

class DrinksController extends BaseController {
    
  public static function index(){
    self::check_logged_in();
    $drinks = Drink::all();
    View::make('drink/drink_list.html', array('drinks' => $drinks));
    }
    
  public static function find($id){
    self::check_logged_in();
    $drink = Drink::find($id);
    View::make('drink/drink_show.html', array('drink' => $drink));
    }
    
  public static function create(){
    self::check_logged_in();
    View::make('drink/drink_add.html');
    }
    
  public static function edit($id){
    self::check_logged_in();
    $drink = Drink::find($id);
    View::make('drink/drink_edit.html', array('drink' => $drink));
    }    
  public static function store(){
    $params = $_POST;
    $attributes = array(
      'nimi' => $params['nimi'],
      'juomalaji' => $params['juomalaji'],
      'ohje' => $params['ohje']
    );
    
      $drink = new Drink($attributes);
      $errors = $drink->errors();

  if(count($errors) == 0){
    $drink->save();

    Redirect::to('/drink/' . $drink->id, array('message' => 'Drinkki on lisätty arkistoon!'));
    }else{
    View::make('drink/drink_add.html', array('errors' => $errors, 'attributes' => $attributes));
    }
   }
    


  public static function update($id){
    $params = $_POST;
    $attributes = array(
      'nimi' => $params['nimi'],
      'juomalaji' => $params['juomalaji'],
      'ohje' => $params['ohje']
    );
    $drink = new Drink($attributes);
    $errors = $drink->errors();

    if(count($errors) > 0){
      View::make('drink/drink_edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }else{
      $drink->edit($id);

      Redirect::to('/drink/' . $id, array('message' => 'Drinkkiä on muokattu!'));
    }
  }

  public static function destroy($id){
    $drink = Drink::destroy($id);
    Redirect::to('/', array('message' => 'Drinkki on poistettu arkistosta!'));
  }
    
}