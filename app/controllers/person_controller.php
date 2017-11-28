<?php

class PersonController extends BaseController {

    public static function index() {
        $people = Person::all();

        //ks ohjeet mitä tekee
        View::make('');
    }

    public static function login() {
        View::make('sivu/login.html');
    }

    public static function register() {
        View::make('sivu/register.html');
    }

    public static function logout() {
        $_SESSION['person'] = null;
        Redirect::to('/etusivu');
    }

    public static function store() {
        $params = $_POST;

        if (strlen($params['name']) > 3) {
            if (strlen($params['password']) > 3) {
                $person = new Person(array(
                    'id' => 5,
                    'name' => $params['name'],
                    'password' => $params['password']
                ));
                $person->save();
                Redirect::to('/etusivu');
            }else{
                Redirect::to('/register');
            }
        }else{
            Redirect::to('/register');
        }
    }

    public static function handle_login() {
        $params = $_POST;

        $user = Person::authenticate($params['person'], $params['password']);

        if (!$user) {
            View::make('sivu/login.html', array('error' => 'Väärä tunnus tai salasana'));
        } else {
            $_SESSION['person'] = $user->id;

            Redirect::to('/etusivu', array('message' => 'tervetulova ' . $user->name));
        }
    }

}
