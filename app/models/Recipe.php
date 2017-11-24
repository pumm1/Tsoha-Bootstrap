<?php

class Recipe extends BaseModel {

    public $id, $category_id, $person_id, $name, $info;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validateName', 'validateInfo', 'validatePerson', 'validateCategory');
    }

    public function validateName() {
        return $this->validate_string($this->name, 3, 'reseptin nimi');
    }

    public function validateInfo() {
        return $this->validate_string($this->info, 10, 'ohje');
    }

    public function validatePerson() {
        return $this->validate_string($this->person_id, 1, 'person_id');
    }

    public function validateCategory() { //tämä ei vielä toimi tyhjälle checkboxille..
        return $this->validate_string($this->category_id, 1, 'kategoria');
    }

//    public function validateCategory() {
//        return $this->validateString($this->category_id, 1, 'category_id');
//    }

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
    }

    public static function destroy($id) {
//        $p = $this->id;
        
        $query = DB::connection()->prepare('DELETE FROM Recipe WHERE id = ' .$id);
        $query->execute();
    }

    public static function update() {//JATKA UPDATEN KATSOMISESTA
        $name = $this->name;
        $info = $this->info;
        $query = DB::connection()->prepare('UPDATE Recipe SET name = :name, info = :info WHERE id = ' . $this->id);
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
