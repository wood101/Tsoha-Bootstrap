<?php

class User extends BaseModel {
    public $id, $kayttajatunnus, $salasana, $sahkoposti, $valtuutus;
    public function __construct($attributes){
    parent::__construct($attributes);
    $this->validators = array('validate_tunnus', 'validate_salasana', 'validate_sahkoposti');
    }

public static function all(){
    $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
    $query->execute();
    $rows = $query->fetchAll();
    $user = array();

    foreach($rows as $row){
      $user[] = new User(array(
        'id' => $row['id'],
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'sahkoposti' => $row['sahkoposti'],
        'valtuutus' => $row['valtuutus']
      ));
    }

    return $user;
  }
  
  public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
      $user = new User(array(
        'id' => $row['id'],
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'sahkoposti' => $row['sahkoposti'],
        'valtuutus' => $row['valtuutus']
      ));

      return $user;
    }

    return null;
  }
  
  public static function authenticate($kayttajatunnus, $salasana) {
    $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE kayttajatunnus = :kayttajatunnus AND salasana = :salasana LIMIT 1');
    $query->execute(array('kayttajatunnus' => $kayttajatunnus, 'salasana' => $salasana));
    $row = $query->fetch();
    if($row){
      $user = new User(array(
        'id' => $row['id'],
        'kayttajatunnus' => $row['kayttajatunnus'],
        'salasana' => $row['salasana'],
        'sahkoposti' => $row['sahkoposti'],
        'valtuutus' => $row['valtuutus']
      ));
           
      return $user;
    }else{
        return null;
    } 
  }
  
  public function save(){
    $query = DB::connection()->prepare('INSERT INTO Kayttaja (kayttajatunnus, salasana, sahkoposti) VALUES (:kayttajatunnus, :salasana, :sahkoposti) RETURNING id');
    $query->execute(array('kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana, 'sahkoposti' => $this->sahkoposti));
    $row = $query->fetch();
    $this->id = $row['id'];
  }
  
  public function edit(){
    $query = DB::connection()->prepare('UPDATE Kayttaja SET kayttajatunnus = :kayttajatunnus, salasana = :salasana, sahkoposti = :sahkoposti WHERE id = :id');
    $query->execute(array('id' => $this->id, 'kayttajatunnus' => $this->kayttajatunnus, 'salasana' => $this->salasana, 'sahkoposti' => $this->sahkoposti));
    $row = $query->fetch();
  }  
  
  
  
  public function destroy(){
    $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE id = :id');
    $query->execute(array('id' => $id));
    $row = $query->fetch();
  }
  
  public function authorize(){
    $query = DB::connection()->prepare('UPDATE Kayttaja SET valtuutus = 1 WHERE id = :id');
    $query->execute(array('id' => $this->id));
    $row = $query->fetch();
  }
  
  public function validate_tunnus(){
  $errors = array();
  if($this->kayttajatunnus == '' || $this->kayttajatunnus == null){
    $errors[] = 'Tunnus ei saa olla tyhjä!';
  }
  if(strlen($this->kayttajatunnus) < 5){
    $errors[] = 'Nimen pituuden tulee olla vähintään viisi merkkiä!';
  }

  return $errors;
}

  public function validate_salasana(){
  $errors = array();
  if($this->salasana == '' || $this->salasana == null){
    $errors[] = 'Salasana ei saa olla tyhjä!';
  }
  if(strlen($this->salasana) < 6){
    $errors[] = 'Salasanan pitää olla vähintään kuusi merkkiä pitkä!';
  }

  return $errors;
}

  public function validate_sahkoposti(){
  $errors = array();
  if($this->sahkoposti == '' || $this->sahkoposti == null){
    $errors[] = 'Sähköposti ei saa olla tyhjä!';
  }
  if(!filter_var($this->sahkoposti, FILTER_VALIDATE_EMAIL)){
    $errors[] = 'Sähköposti on väärän muotoinen!';
  }

  return $errors;
}
}

