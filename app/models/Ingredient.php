<?php

class Ingredient extends BaseModel {

    public $id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Ingredient (name) VALUES (:name)');
        $query->execute(array('name' => $this->name));
    }
    
    public function connectToRecipe($id){
         $query = DB::connection()->prepare('INSERT INTO Addtable (recipe_id, ingredient_id) VALUES '
                 . '(:recipe_id, :ingredient_id)');
         
         $query->execute(array('recipe_id' => $id, 'ingredient_id' => $this->id));
    }
    
    public static function findByRecipe($id){
         $query = DB::connection()->prepare('SELECT i.id, i.name FROM Ingredient i, Addtable a, Recipe r '
                 . 'WHERE i.id = a.ingredient_id AND r.id = a.recipe_id AND r.id = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $ingredients = array();
        foreach ($rows as $row) {
            $ingredients[] = new Ingredient(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }

        return $ingredients;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Ingredient WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $ingredient = new Ingredient(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
            return $ingredient;
        }
        return null;
    }
    
    public static function findByName($name) {
        $query = DB::connection()->prepare('SELECT * FROM Ingredient WHERE name = :name LIMIT 1');
        $query->execute(array('name' => $name));
        $row = $query->fetch();

        if ($row) {
            $ingredient = new Ingredient(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
            return $ingredient;
        }
        return null;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Ingredient');
        $query->execute();
        $rows = $query->fetchAll();
        $ingredients = array();

        foreach ($rows as $row) {
            $ingredients[] = new Ingredient(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }

        return $ingredients;
    }

}
