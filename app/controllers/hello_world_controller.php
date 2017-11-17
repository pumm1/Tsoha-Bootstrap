<?php

require 'app/models/Person.php';
require 'app/models/Recipe.php';
require 'app/models/Ingredient.php';
class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        //echo 'Tervetuloa hiekkalaatikolle! Täällä kaikilla on kivvvvaaa!';
//        Person::save('kalle', 'kalle123');
        $person = Person::find(1);
        $people = Person::all();
        
        $recipe = Recipe::find(1);
        $recipes = Recipe::all();
        
        $ingredient = Ingredient::find(1);
        $ingredients = Ingredient::all();
        
        Kint::dump($person);
        Kint::dump($people);
        
        Kint::dump($recipe);
        Kint::dump($recipes);
        
        Kint::dump($ingredient);
        Kint::dump($ingredients);
        
        View::make('helloworld.html');
    }
    
    public static function etusivu(){
        View::make('sivu/etusivu.html');
    }
    
    public static function kategoria(){
        View::make('suunnitelmat/kategoria.html');
    }
    
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function resepti(){
        View::make('sivu/resepti.html');
    }
    public static function muok(){
        View::make('/suunnitelmat/muok.html');
    }
    
    public static function add(){
        View::make('/sivu/lisaa.html');
    }
}
