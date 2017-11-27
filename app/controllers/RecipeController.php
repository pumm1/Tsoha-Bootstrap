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

        View::make('sivu/muok.html', array('recipes' => $recipes));
    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'person_id' => $params['person_id'],
            'category_id' => $params['category_id'],
            'info' => $params['info']
        );

        $recipe = new Recipe($attributes);
        $errors = $recipe->errors();

        if (count($errors) > 0) {
            View::make('sivu/muok.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
//            $recipe->idUpdate($id);
            $recipe->update();
            Redirect::to('/etusivu', array('message' => 'Reseptiä on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        $recipe = new Recipe(array('id' => $id));
        $recipe->destroy($id);
        Redirect::to('/etusivu', array('message' => 'Resepti poistettu onnistuneesti'));
    }

    public static function store() {
        $params = $_POST;

        $id = Recipe::findLatestId();

        $recipe = new Recipe(array(
            'id' => $id,
            'category_id' => $params['category_id'],
            'person_id' => $params['person_id'],
            'name' => $params['name'],
            'info' => $params['info']
        ));
        $errors = $recipe->errors();
        if (count($errors) == 0) {
            $recipe->save();
            Redirect::to('/resepti/' . $recipe->id, array('message' => 'Resepti on lisätty kirjastoosi!'));
        } else {
            View::make('sivu/lisaa.html', array('errors' => $errors, 'params' => $params));
        }
//        Kint::dump($params);
    }

    public static function inCategory($id) {
        $recipes = Recipe::inCategory($id);

        View::make('sivu/kategoria.html', array('recipes' => $recipes));
    }

    public static function resepti($id) {
        $recipe = Recipe::find($id);
        $recipes = array($recipe);
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        View::make('sivu/resepti.html', array('recipes' => $recipes, 'user_logged_in' => $user_logged_in));
    }

}
