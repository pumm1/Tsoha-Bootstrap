<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        $errors = array();
        foreach ($this->validators as $validator) {
            $errorValidator = $this->{$validator}();
            $errors = array_merge($errors, $errorValidator);
        }
        return $errors;
    }

    public function validate_cat($id, $name) {
        $errors = array();
        if (strlen($id) > 1) {
            $errors[] = $name . ' ei saa olla tyhjä!';
        }

        return $errors;
    }

    public function validate_string($string, $len, $name) { //varmistetaan nimen oikeellisuus
        $errors = array();
        if ($string == '9999' && $name == 'kategoria') {
            $errorr[] = $name . ' ei saa olla tyhjä!';
        } else {
            if ($string == '' || $string == null) {
                $errors[] = $name . ' ei saa olla tyhjä!';
            }
            if (strlen($string) < $len) {
                $errors[] = $name . ' pituuden tulee olla vähintään ' . $len . ' merkkiä!';
            }
        }


        return $errors;
    }

}
