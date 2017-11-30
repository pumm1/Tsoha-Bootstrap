<?php

class Person extends BaseModel {

    public $id, $name, $password;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    //lue vähän pidemmälle ensin!
//    public function save($name, $passowrd){
//        $query = DB::connection()->prepare('INSERT INTO Person (name, password) VALUES (:name, :password)');
//        $query->execute();
//    }
    
    public static function findByName($name) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE name = :name LIMIT 1');
        $query->execute(array('name' => $name));
        $row = $query->fetch();

        if ($row) {
            $person = new Person(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $person;
        }
        return null;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $person = new Person(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $person;
        }
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Person (name, password) VALUES (:name, :password)');
        $query->execute(array('name' => $this->name, 'password' => $this->password));
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Person');
        $query->execute();
        $rows = $query->fetchAll();
        $people = array();

        foreach ($rows as $row) {
            $people[] = new Person(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
        }

        return $people;
    }

    public static function authenticate($name, $pass) {
        $query = DB::connection()->prepare('SELECT * FROM Person WHERE name = :name AND password = :pass LIMIT 1');
        $query->execute(array('name' => $name, 'pass' => $pass));
        $row = $query->fetch();
        if ($row) {
            $user = new Person(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'password' => $row['password']
            ));
            return $user;
        }
        return null;
    }

}
