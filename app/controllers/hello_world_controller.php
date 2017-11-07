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
    
    public static function etusivu(){
        View::make('/suunnitelmat/etusivu.html');
    }
    
    public static function kategoria(){
        View::make('suunnitelmat/kategoria.html');
    }
    
    public static function login(){
        View::make('suunnitelmat/login.html');
    }
    
    public static function resepti(){
        View::make('suunnitelmat/resepti.html');
    }

}
