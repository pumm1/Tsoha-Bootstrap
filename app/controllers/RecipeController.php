<?php

class RecipeController extends BaseController {

    public static function index() { //hmmm öhmm..?
        $recipes = Recipe::all();

        View::make('sivu/kategoria.html', array('recipes' => $recipes));
    }

    public static function edit($id) {
//        $recipe = Recipe::find($id);
//        View::make('sivu/muok.html', array('attributes' => $recipe));
        $recipe = Recipe::find($id);
        $recipes = array($recipe);
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        if (!$user_logged_in) {
            Redirect::to('/login');
        } else {
            if ($user_logged_in->id == $recipe->person_id) {
                View::make('sivu/muok.html', array('recipes' => $recipes, 'user_logged_in' => $user_logged_in));
            } else {
                Redirect::to('/etusivu');
            }
        }
    }

    public static function update($id) {

        $params = $_POST;
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'person_id' => $user_logged_in->id,
            'category_id' => 1,
            'info' => $params['info']
        );

        $recipe = new Recipe($attributes);
        $oldRecipe = Recipe::find($id);
        $recipes = array($oldRecipe);
        $errors = $recipe->errors();


        if (count($errors) > 0) {
            View::make('sivu/muok.html', array('errors' => $errors, 'params' => $params, 'recipes' => $recipes));
        } else {
//            $recipe->idUpdate($id);
            $recipe->update();
            Redirect::to('/etusivu', array('message' => 'Reseptiä on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        $recipe = new Recipe(array('id' => $id));
        $recipe->destroy($id);
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        if (!$user_logged_in) {
            Redirect::to('/login');
        } else {
            Redirect::to('/etusivu', array('message' => 'Resepti poistettu onnistuneesti'));
        }
    }

    public static function store() {
        $params = $_POST;
//        $ingredients = $params['ingredients'];
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $id = Recipe::findLatestId();
        $recipe = new Recipe(array(
            'id' => $id,
            'category_id' => $params['category_id'],
            'person_id' => $user_logged_in->id,
            'name' => $params['name'],
            'info' => $params['info']
        ));
        $ingredientArr = explode(" ", $params['ingredients']);
        $ingredients = array();
        foreach ($ingredientArr as $ingredient) {
            $aine = Ingredient::findByName($ingredient);
            if ($aine == null) {
                $aine = new Ingredient(array('name' => $ingredient));
                $aine->save();
            }
            $ingredients[] = $aine;
        }


        $errors = $recipe->errors();
        if (count($errors) == 0) {
            $recipe->save();
            foreach ($ingredients as $ingredient) {
                $aine = Ingredient::findByName($ingredient->name);
                $aine->connectToRecipe($recipe->id);
            }
            Redirect::to('/resepti/' . $recipe->id, array('message' => 'Resepti on lisätty onnistuneesti!'));
        } else {
            View::make('sivu/lisaa.html', array('errors' => $errors, 'params' => $params));
        }
//        Kint::dump($params);
    }

    public static function inCategory($id) {
        $recipes = Recipe::inCategory($id);
        $category = Category::find($id);
        View::make('sivu/kategoria.html', array('recipes' => $recipes, 'category' => $category));
    }

    public static function resepti($id) {
        $recipe = Recipe::find($id);
        $recipes = array($recipe);
        $user = Person::find($recipe->person_id);
        $ingredients = Ingredient::findByRecipe($recipe->id);
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        View::make('sivu/resepti.html', array('recipes' => $recipes, 'user_logged_in' => $user_logged_in, 'user' => $user,
            'ingredients' => $ingredients));
    }

}
