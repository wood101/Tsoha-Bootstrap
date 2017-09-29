<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      //foreach($this->validators as $validator){
      //
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      $validate_nimi = 'validate_nimi';
      $validate_ohje = 'validate_ohje';
      $validate_juomalaji = 'validate_juomalaji';
      $errors = array_merge($errors, $this->{$validate_nimi}());
      $errors = array_merge($errors, $this->{$validate_ohje}());
      $errors = array_merge($errors, $this->{$validate_juomalaji}());
      //}

      return $errors;
    }

  }
