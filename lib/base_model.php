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

    public function validate_string($string, $min, $max){
      $errors = array();
      if(!is_string($string)){
        $errors[] = "On oltava merkkijono.";
      }
      if(strlen($string) < $min && $min != 0){
        $errors[] = "Minimipituus on " . $min . " merkkiä.";
      }
      if(strlen($string) > $max && $max != 0){
        $errors[] = "Maksimipituus on " . $max . " merkkiä.";
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
