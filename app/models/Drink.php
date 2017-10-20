<?php


class Drink extends BaseModel {
    public $id, $tekija, $nimi, $ohje, $juomalaji;
    public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_nimi', 'validate_ohje', 'validate_juomalaji');
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
        'nimi' => $row['nimi'],
        'ohje' => $row['ohje'],
        'juomalaji' => $row['juomalaji']
      ));

      return $drink;
    }

    return null;
  }
  
  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Drinkkiresepti (tekija, nimi, ohje, juomalaji) VALUES (:tekija, :nimi, :ohje, :juomalaji) RETURNING id');
    
    $query->execute(array('tekija' => $this->tekija, 'nimi' => $this->nimi, 'ohje' => $this->ohje, 'juomalaji' => $this->juomalaji));
    $row = $query->fetch();
    $this->id = $row['id'];
  }
  
  public function edit($id){
    $query = DB::connection()->prepare('UPDATE Drinkkiresepti SET nimi = :nimi, ohje = :ohje, juomalaji = :juomalaji WHERE id = :id');
    $query->execute(array('id' => $id, 'nimi' => $this->nimi, 'ohje' => $this->ohje, 'juomalaji' => $this->juomalaji));
    $row = $query->fetch();
  }  
  
  public static function destroy($id){
    $query = DB::connection()->prepare('DELETE FROM Drinkkiresepti WHERE id = :id');
    $query->execute(array('id' => $id));
    $row = $query->fetch();
  }
  
  public function validate_nimi(){
  $errors = array();
  if($this->nimi == '' || $this->nimi == null){
    $errors[] = 'Nimi ei saa olla tyhjä!';
  }
  if(strlen($this->nimi) < 2){
    $errors[] = 'Nimen pituuden tulee olla vähintään kaksi merkkiä!';
  }

  return $errors;
}

  public function validate_ohje(){
  $errors = array();
  if($this->ohje == '' || $this->ohje == null){
    $errors[] = 'Kirjoita jotain ohjeeseen!';
  }

  return $errors;
}

  public function validate_juomalaji(){
  $errors = array();
  if($this->juomalaji == '' || $this->juomalaji == null){
    $errors[] = 'Juomalaji ei saa olla tyhjä!';
  }

  return $errors;
}
}

