<?php

class DrinksController extends BaseController {
    
  public static function index(){
    $drinks = Drink::all();
    View::make('drink/drink_list.html', array('drinks' => $drinks));
    }
    
  public static function find($id){
    $drink = Drink::find($id);
    $ingredients = Ingredient::find_by_drink_id($id);
    View::make('drink/drink_show.html', array('drink' => $drink, 'ingredients' => $ingredients));
    }
    
  public static function create(){
    self::check_logged_in();
    View::make('drink/drink_add.html');
    }
    
  public static function edit($id){
    self::check_logged_in();
    $drink = Drink::find($id);
    $ingredients = Ingredient::find_by_drink_id($id);
    View::make('drink/drink_edit.html', array('drink' => $drink, 'ingredients' => $ingredients));
    }    
  public static function store(){
    $params = $_POST;
    $attributes = array(
      'nimi' => $params['nimi'],
      'juomalaji' => $params['juomalaji'],
      'ohje' => $params['ohje'],
      'tekija' => $params['tekija']
    );
    

        
      $drink = new Drink($attributes);
      $errors = $drink->errors();
      
      $ingredients = $params['ainesosa'];
      foreach($ingredients as $key=>$ingredient){
      if($ingredient == '' | $ingredient == null){
       unset($ingredients[$key]);
      } 
      }
      
  if(count($errors) == 0 && count($ingredients) >= 2){
    $drink->save();
    
    foreach($ingredients as $nimi){
    if ($nimi != null | $nimi !='') {
    $ingredientAttributes = array(
        'nimi' => ucfirst($nimi)
    );
      $ingredient = new Ingredient($ingredientAttributes);
      $ingredient->save();
    
    $drinkIngredientAttributes = array(
       'atunnus' => $ingredient->id,
       'dtunnus' => $drink->id
    );
     $drinkIngredient = new Drink_Ingredient($drinkIngredientAttributes);
     $drinkIngredient->save_drink_ingredients();
        }
    }
    
    Redirect::to('/drink/' . $drink->id, array('message' => 'Drinkki on lisätty arkistoon!'));
    }else{
    if(count($ingredients) < 2) {
        array_push($errors, 'Ainesosia pitää olla vähintään kaksi');
    }
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

    if(count($errors) == 0){
        
    foreach($params['ainesosa'] as $key => $nimi){
    if ($nimi != null | $nimi !='') {
    $ingredientAttributes = array(
        'nimi' => ucfirst($nimi)
    );
    $ingredient = new Ingredient($ingredientAttributes);
    $ingredient->edit($params['id'][$key]);
        }
    }
    $drink->edit($id);

    Redirect::to('/drink/' . $id, array('message' => 'Drinkkiä on muokattu!'));  
    }else{
    View::make('drink/drink_edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }

  public static function destroy($id){
    Drink_Ingredient::destroy_drink_ingredients($id);
    Drink::destroy($id);
    Redirect::to('/', array('message' => 'Drinkki on poistettu arkistosta!'));
  }
    
}