<?php

class Recipe extends BaseModel {

    public $id, $category_id, $person_id, $name, $info;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validateName', 'validateInfo');
    }

    public function validateName() {
        return $this->validate_string($this->name, 3, 'name');
    }

    public function validateInfo() {
        return $this->validate_string($this->info, 10, 'info');
    }
    
    public function validatePerson(){
        return $this->validate_string($this->person_id, 1, 'person_id');
    }

    public function validateCategory() {
        return $this->validateString($this->category_id, 1, 'category_id');
    }

    public function save() { //ei staattinen!
        $query = DB::connection()->prepare('INSERT INTO Recipe (category_id, person_id, name, info) VALUES 
            (:category_id, :person_id, :name, :info) RETURNING id');
//        $name = Person::find('name');
        $query->execute(array('category_id' => $this->category_id, 'person_id' => $this->person_id,
            'name' => $this->name, 'info' => $this->info));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public static function findLatestId() {

        $query = DB::connection()->prepare('SELECT * FROM Recipe ORDER BY id DESC LIMIT 1');
        $query->execute();
        $row = $query->fetch();

        if ($row) {
            $recipe = new Recipe(array(
                'id' => $row['id'],
                'category_id' => $row['category_id'],
                'person_id' => $row['person_id'],
                'name' => $row['name'],
                'info' => $row['info']
            ));
            return $recipe->id + 1;
        }
//        $query = DB::connection()->prepare('SELECT * FROM Recipe ORDER BY id DESC LIMIT 1');
//        $query->exectue();
//        $row->fetch();
//
//        if ($row) {
//            $recipe = new Recipe(array(
//                'id' => $row['id'],
//                'category_id' => $row['category_id'],
//                'person_id' => $row['person_id'],
//                'name' => $row['name'],
//                'info' => $row['info']
//            ));
//            return $recipe->id +1;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Recipe WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $recipe = new Recipe(array(
                'id' => $row['id'],
                'category_id' => $row['category_id'],
                'person_id' => $row['person_id'],
                'name' => $row['name'],
                'info' => $row['info']
            ));
            return $recipe;
        }
        return null;
    }

    public static function inCategory($id) {
        $query = DB::connection()->prepare('SELECT * FROM Recipe WHERE category_id = :id');
        $query->execute(array(':id' => $id));
        $rows = $query->fetchAll();
        $recipes = array();

        foreach ($rows as $row) {
            $recipes[] = new Recipe(array(
                'id' => $row['id'],
                'category_id' => $row['category_id'],
                'person_id' => $row['person_id'],
                'name' => $row['name'],
                'info' => $row['info']
            ));
        }
        return $recipes;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Recipe');
        $query->execute();
        $rows = $query->fetchAll();
        $recipes = array();

        foreach ($rows as $row) {
            $recipes[] = new Recipe(array(
                'id' => $row['id'],
                'category_id' => $row['category_id'],
                'person_id' => $row['person_id'],
                'name' => $row['name'],
                'info' => $row['info']
            ));
        }
        return $recipes;
    }

}
