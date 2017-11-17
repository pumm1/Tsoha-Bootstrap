<?php

class Category {

    public $id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Category WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $category = new Recipe(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
            return $category;
        }
        return null;
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Category');
        $query->execute();
        $rows = $query->fetchAll();
        $categories = array();

        foreach ($rows as $row) {
            $categories[] = new Recipe(array(
                'id' => $row['id'],
                'name' => $row['name']
            ));
        }
        return $categories;
    }

}
