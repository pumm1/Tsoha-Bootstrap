<?php

class RecipeController extends BaseController {

    public static function index() { //hmmm öhmm..?
        $recipes = Recipe::all();

        View::make('sivu/kategoria.html', array('recipes' => $recipes));
    }
    
    public static function resepti($id) {
        $recipe = Recipe::find($id);
        $recipes =  array($recipe);
        
        View::make('sivu/resepti.html', array('recipes' => $recipes));
    }

}
