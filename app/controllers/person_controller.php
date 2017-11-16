<?php

class PersonController extends BaseController {
    public static function index(){
        $people = Person::all();
        
        //ks ohjeet mitä tekee
        View::make('');
    }
}
