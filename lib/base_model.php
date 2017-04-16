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

    public function validate_string($field, $string, $min, $max){
      $errors = array();
      if(!is_string($string)){
        $errors[] = $field . " on oltava merkkijono.";
      }
      if(strlen($string) < $min && $min != 0){
        $errors[] = $field . " minimipituus on " . $min . " merkkiä.";
      }
      if(strlen($string) > $max && $max != 0){
        $errors[] = $field . " maksimipituus on " . $max . " merkkiä.";
      }
      return $errors;
    }

    public function validate_integer($field, $integer){
      $errors = array();
      if(!is_numeric($integer)){
        $errors[] = $field . " on oltava kokonaisluku.";
      }
      return $errors;
    }

    public function validate_range($field, $integer, $min, $max){
      $errors = array();
      if (!is_numeric($integer)){
        $errors[] = $field . " on oltava kokonaisluku.";
      }
      if($integer < $min){
        $errors[] = $field . " on oltava vähintään " . $min;
      }
      if($integer > $max){
        $errors[] = $field . " on oltava korkeintaan " . $max;
      }
      return $errors;
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $nexterrors = $this->{$validator}();
        $errors = array_merge($errors, $nexterrors);
      }

      return $errors;
    }

  }
