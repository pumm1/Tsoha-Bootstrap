<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        //echo 'Tervetuloa hiekkalaatikolle! Täällä kaikilla on kivvvvaaa!';
        View::make('helloworld.html');
    }

}
