<?php

require 'app/models/Person.php';
require 'app/models/Recipe.php';
require 'app/models/Ingredient.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //View::make('home.html');
        self::etusivu();
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        //echo 'Tervetuloa hiekkalaatikolle! Täällä kaikilla on kivvvvaaa!';
//        Person::save('kalle', 'kalle123');
        $resepti = new Recipe(array(
            'id' => 999,
            'category_id' => 2,
            'person_id' => 1,
            'name' => 're',
            'info' => 'aa'
        ));
        Kint::dump($resepti);
        $errors = $resepti->errors();
        Kint::dump($errors);

        View::make('helloworld.html');
    }

    public static function etusivu() {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        Kint::dump($user_logged_in);
        View::make('sivu/etusivu.html', array('user_logged_in' => $user_logged_in));
    }

    public static function kategoria() {
        View::make('suunnitelmat/kategoria.html');
    }

    public static function login() {
        View::make('sivu/login.html');
    }

    public static function resepti() {
        View::make('sivu/resepti.html');
    }

    public static function muok() {
        View::make('/sivu/muok.html');
    }

    public static function add() {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        if(!$user_logged_in){
            Redirect::to('/etusivu');
        }
        
        View::make('sivu/lisaa.html', array('user_logged_in' => $user_logged_in));
    }

}
