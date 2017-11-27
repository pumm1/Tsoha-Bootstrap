<?php

class PersonController extends BaseController {

    public static function index() {
        $people = Person::all();

        //ks ohjeet mitä tekee
        View::make('');
    }
    
    public static function login(){
        View::make('sivu/login.html');
    }

    public static function handle_login() {
        $params = $_POST;
        
        $user = Person::authenticate($params['user'], $params['password']);
        
        if(!$user){
            View::make('sivu/login.html', array('error' => 'Väärä tunnus tai salasana', 'user' => $params['user']));
        }else{
            $_SESSION['user'] = $user->id;
            
            Redirect::to('/etusivu', array('message' => 'tervetulova ', $user->name));
        }
    }

}
