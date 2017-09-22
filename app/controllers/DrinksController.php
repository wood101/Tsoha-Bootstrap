<?php

class DrinksController extends BaseController {
    
    public static function index(){
        $drinks = Drink::all();
        
        View::make('drink/drink_list.html', array('drinks' => $drinks));
    }
    
    public static function drink_show($id){
        $drink = Drink::find($id);
        View::make('drink/drink_show.html', array('drink' => $drink));
    }
    
    public static function create(){
    View::make('drink/drink_add.html');
    }
    
    public static function store(){
    $params = $_POST;
    $drink = new Drink(array(
      'nimi' => $params['nimi'],
      'juomalaji' => $params['juomalaji'],
      'ohje' => $params['ohje']
    ));
    
    $drink->save();

    Redirect::to('/drink/' . $drink->id, array('message' => 'Drinkki on lisätty arkistoon!'));
  }
}

