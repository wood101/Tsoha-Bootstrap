<?php

class Drink_Ingredient extends BaseModel {
    public $atunnus, $dtunnus, $etunnus;
    public function __construct($attributes){
    parent::__construct($attributes);
    }
    
  public function save_drink_ingredients(){
  $query = DB::connection()->prepare('INSERT INTO Drinkinainesosa (atunnus, dtunnus) VALUES (:atunnus, :dtunnus)');
  
  $query->execute(array('atunnus' => $this->atunnus, 'dtunnus' => $this->dtunnus));
}

  public function save_proposal_ingredients(){
  $query = DB::connection()->prepare('INSERT INTO Drinkinainesosa (atunnus, etunnus) VALUES (:atunnus, :etunnus)');
  
  $query->execute(array('atunnus' => $this->atunnus, 'etunnus' => $this->etunnus));
}

 public static function destroy_proposal_ingredients($id){   
  $query = DB::connection()->prepare('DELETE FROM Drinkinainesosa WHERE etunnus = :id');
  $query->execute(array('id' => $id));   
 }
 
  public static function destroy_drink_ingredients($id){   
  $query = DB::connection()->prepare('DELETE FROM Drinkinainesosa WHERE dtunnus = :id');
  $query->execute(array('id' => $id));   
 }
}
    
    
    
 