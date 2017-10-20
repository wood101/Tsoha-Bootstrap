<?php

class ProposalController extends BaseController {
    
  public static function list_all(){
    self::check_logged_in();
    $proposals = Proposal::all();
    View::make('proposal/proposal_list.html', array('proposals' => $proposals));
    }
    
  public static function find($id){
    self::check_logged_in();
    $proposal = Proposal::find($id);
    $ingredients = Ingredient::find_by_proposal_id($id);
    View::make('proposal/proposal_show.html', array('proposal' => $proposal, 'ingredients' => $ingredients));
    }
    
  public static function create(){
    self::check_logged_in();
    View::make('proposal/proposal_add.html');
    }
    
  public static function edit($id){
    self::check_logged_in();
    $proposal = Proposal::find($id);
    $ingredients = Ingredient::find_by_proposal_id($id);
    View::make('proposal/proposal_edit.html', array('proposal' => $proposal, 'ingredients' => $ingredients));
    }    
  public static function store(){
    $params = $_POST;
    $attributes = array(
      'nimi' => $params['nimi'],
      'juomalaji' => $params['juomalaji'],
      'ohje' => $params['ohje'],
      'tekija' => $params['tekija']
    );
    
      $proposal = new Proposal($attributes);
      $errors = $proposal->errors();

  if(count($errors) == 0 && count($params['ainesosa']) > 1){
    $proposal->save();
    
    foreach($params['ainesosa'] as $nimi){
    if ($nimi != null | $nimi !='') {
    $ingredientAttributes = array(
        'nimi' => ucfirst($nimi)
    );
      $ingredient = new Ingredient($ingredientAttributes);
      $ingredient->save();
    
    $proposalIngredientAttributes = array(
       'atunnus' => $ingredient->id,
       'etunnus' => $proposal->id
    );
     $proposalIngredient = new Drink_Ingredient($proposalIngredientAttributes);
     $proposalIngredient->save_proposal_ingredients();
        }
    }    
    
    Redirect::to('/proposal/' . $proposal->id, array('message' => 'Ehdotus on lisätty arkistoon!'));
    }else{
    View::make('proposal/proposal_add.html', array('errors' => $errors, 'attributes' => $attributes));
    }
   }
    


  public static function update($id){
    $params = $_POST;
    $attributes = array(
      'nimi' => $params['nimi'],
      'juomalaji' => $params['juomalaji'],
      'ohje' => $params['ohje']
    );
    $proposal = new Proposal($attributes);
    $errors = $proposal->errors();

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
    $proposal->edit($id);

    Redirect::to('/proposal/' . $id, array('message' => 'Ehdotusta on muokattu!'));  
    }else{
    View::make('proposal/proposal_edit.html', array('errors' => $errors, 'attributes' => $attributes));
    }
  }

  public static function destroy($id){
    Drink_Ingredient::destroy_proposal_ingredients($id);
    Proposal::destroy($id);
    Redirect::to('/proposals', array('message' => 'Ehdotus on poistettu!'));
  }
  
  public static function accept($id){
    $proposal = Proposal::find($id);
    
    $attributes = array(
      'nimi' => $proposal->nimi,
      'juomalaji' => $proposal->juomalaji,
      'ohje' => $proposal->ohje,
      'tekija' => $proposal->tekija
    );
    
    $drink = new Drink($attributes);
    $drink->save();
    
    $ingredients = Ingredient::find_by_proposal_id($id);
    
    foreach($ingredients as $ingredient){
    $IngredientAttributes = array(
       'atunnus' => $ingredient->id,
       'dtunnus' => $drink->id
    );
     $drinkIngredient = new Drink_Ingredient($IngredientAttributes);
     $drinkIngredient->save_drink_ingredients();
        
    }
    
    Drink_Ingredient::destroy_proposal_ingredients($id);
    Proposal::destroy($id);
    Redirect::to('/', array('message' => 'Ehdotus on hyväksytty!'));
  }
}