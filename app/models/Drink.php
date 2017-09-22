<?php


class Drink extends BaseModel {
    public $id, $tekija, $yllapitotekija, $nimi, $ohje, $juomalaji;
    public function __construct($attributes){
    parent::__construct($attributes);
    }

public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Drinkkiresepti');
    $query->execute();
    $rows = $query->fetchAll();
    $drink = array();

    foreach($rows as $row){
      $drink[] = new Drink(array(
        'id' => $row['id'],
        'tekija' => $row['tekija'],
        'yllapitotekija' => $row['yllapitotekija'],
        'nimi' => $row['nimi'],
        'ohje' => $row['ohje'],
        'juomalaji' => $row['juomalaji']
      ));
    }

    return $drink;
  }
  
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Drinkkiresepti WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $drink = new Drink(array(
        'id' => $row['id'],
        'tekija' => $row['tekija'],
        'yllapitotekija' => $row['yllapitotekija'],
        'nimi' => $row['nimi'],
        'ohje' => $row['ohje'],
        'juomalaji' => $row['juomalaji']
      ));

      return $drink;
    }

    return null;
  }
  
  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Drinkkiresepti (nimi, ohje, juomalaji) VALUES (:nimi, :ohje, :juomalaji) RETURNING id');
    
    $query->execute(array('nimi' => $this->nimi, 'ohje' => $this->ohje, 'juomalaji' => $this->juomalaji));
    $row = $query->fetch();
    $this->id = $row['id'];
  }  
}

