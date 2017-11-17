<?php

class Recipe extends BaseModel {

    public $id, $category, $person, $name, $info;

    public function __construct($attributes) {
        parent::__construct($attributes);
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
    
    public static function inCategory($id){
        $query = DB::connection()->prepare('SELECT * FROM Recipe WHERE category_id = :id');
        $query->execute(array (':id' => $id));
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
