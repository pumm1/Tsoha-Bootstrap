<?php

class RecipeController extends BaseController {

    public static function index() { //hmmm öhmm..?
        $recipes = Recipe::all();

        View::make('sivu/kategoria.html', array('recipes' => $recipes));
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

        Kint::dump($params);
        $recipe->save();
        Redirect::to('/resepti/' . $recipe->id, array('message' => 'Resepti on lisätty kirjastoosi!'));
    }

    public static function inCategory($id) {
        $recipes = Recipe::inCategory($id);

        View::make('sivu/kategoria.html', array('recipes' => $recipes));
    }

    public static function resepti($id) {
        $recipe = Recipe::find($id);
        $recipes = array($recipe);

        View::make('sivu/resepti.html', array('recipes' => $recipes));
    }

}
