<?php

class Ingredient extends BaseModel {
    public $id, $nimi;
    public function __construct($attributes){
    parent::__construct($attributes);
    }

public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Ainesosa');
    $query->execute();
    $rows = $query->fetchAll();
    $ingredient = array();

    foreach($rows as $row){
      $ingredient[] = new Ingredient(array(
        'id' => $row['id'],
        'nimi' => $row['nimi']
      ));
    }

    return $ingredient;
  }
  
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Ainesosa WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $ingredient = new Ingredient(array(
        'id' => $row['id'],
        'nimi' => $row['nimi']
      ));

      return $ingredient;
    }

    return null;
  }
  
    public function save(){
    $query = DB::connection()->prepare('SELECT * FROM Ainesosa WHERE nimi = :nimi LIMIT 1');
    $query->execute(array('nimi' => $this->nimi));
    $row = $query->fetch();

    if($row){
      $this->id = $row['id'];
    } else {
        
    $query = DB::connection()->prepare('INSERT INTO Ainesosa (nimi) VALUES (:nimi) RETURNING id');
    
    $query->execute(array('nimi' => $this->nimi));
    $row = $query->fetch();
    $this->id = $row['id'];
    }
  }
    public static function find_by_drink_id($id){
    $query = DB::connection()->prepare('SELECT * 
                                        FROM Ainesosa
                                        INNER JOIN Drinkinainesosa
                                            ON Drinkinainesosa.atunnus = Ainesosa.id
                                        WHERE Drinkinainesosa.dtunnus = :id');
    $query->execute(array('id' => $id));

    $rows = $query->fetchAll();
    $ingredients = array();

    foreach($rows as $row) {
        $ingredients[] = new Ingredient(array(
            'id' => $row['id'],
            'nimi' => $row['nimi'],
        ));
    }
    return $ingredients;
    }
    
        public static function find_by_proposal_id($id){
    $query = DB::connection()->prepare('SELECT * 
                                        FROM Ainesosa
                                        INNER JOIN Drinkinainesosa
                                            ON Drinkinainesosa.atunnus = Ainesosa.id
                                        WHERE Drinkinainesosa.etunnus = :id');
    $query->execute(array('id' => $id));

    $rows = $query->fetchAll();
    $ingredients = array();

    foreach($rows as $row) {
        $ingredients[] = new Ingredient(array(
            'id' => $row['id'],
            'nimi' => $row['nimi'],
        ));
    }
    return $ingredients;
    }
    
    public function edit($id){
    $query = DB::connection()->prepare('UPDATE Ainesosa SET nimi = :nimi WHERE id = :id');
    $query->execute(array('id' => $id, 'nimi' => $this->nimi));
    $row = $query->fetch();
    }  
  
    public static function destroy($id){
    $query = DB::connection()->prepare('DELETE FROM Ainesosa WHERE id = :id');
    $query->execute(array('id' => $id));
    $row = $query->fetch();
    }
}