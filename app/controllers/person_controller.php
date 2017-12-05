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
    
    public static function edit($id){
        $person = Person::find($id);
//        $people = array($person);
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
//        $person = Person::find($id);
        $people =array($user_logged_in);
        if (!$user_logged_in) {
            Redirect::to('/login');
        } else {
            if ($user_logged_in->id == $person->id) {
                View::make('sivu/personMuok.html', array('people' => $people, 'user_logged_in' => $user_logged_in));
            } else {
                Redirect::to('/etusivu');
            }
        }
    }
    
    public static function update($id){
        $params = $_POST;
        $user_logged_in = self::get_user_logged_in();
        $oldPassword = $params['oldpassword'];
        $attributes = array(
            'id' => $user_logged_in->id,
            'name' => $user_logged_in->name,
            'password'=> $params['password']
        );
        $person = new Person($attributes);
        if(strlen($person->password) > 3){
             if($user_logged_in->password == $oldPassword){
                 $person->update();
                  Redirect::to('/etusivu' , array('message' => 'salasanan vaihto onnistui!'));
             }else{
                  Redirect::to('/'.$person->id.'/changePassword', array('message' => 'vanha salasana väärin!'));
             }
        }else{
            Redirect::to('/'.$person->id.'/changePassword', array('message' => 'uusi salasana liian lyhyt!'));
        }
    }

    public static function store() {
        $params = $_POST;
        $temp = Person::findByName($params['name']);
        if ($temp == null) {
            if (strlen($params['name']) > 3) {
                if (strlen($params['password']) > 3) {
                    $person = new Person(array(
                        'id' => 5,
                        'name' => $params['name'],
                        'password' => $params['password']
                    ));
                    $person->save();
                    Redirect::to('/etusivu' , array('message' => 'rekisteröinti onnistui!'));
                } else {
                    Redirect::to('/register',  array('message' => 'nimi tai salasana liian lyhyt (3 merkkiä tai enemmän)'));
                }
            } else {
                Redirect::to('/register',  array('message' => 'nimi tai salasana liian lyhyt (3 merkkiä tai enemmän)'));
            }
        }else{
            Redirect::to('/register', array('message' => 'nimi jo käytössä'));
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
