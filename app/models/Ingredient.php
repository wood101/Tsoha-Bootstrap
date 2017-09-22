<?php

class Ingredient extends BaseModel {
    public $id, $nimi, $maara;
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
        'nimi' => $row['nimi'],
        'maara' => $row['maara']
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
        'nimi' => $row['nimi'],
        'maara' => $row['maara']
      ));

      return $ingredient;
    }

    return null;
  }
  
    public function save(){
    $query = DB::connection()->prepare('INSERT INTO Ainesosa (nimi, maara) VALUES (:nimi, :maara) RETURNING id');
    
    $query->execute(array('nimi' => $this->nimi, 'maara' => $this->maara));
    $row = $query->fetch();
    $this->id = $row['id'];
  }  
}