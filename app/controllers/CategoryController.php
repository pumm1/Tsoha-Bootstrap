<?php

class CategoryController extends BaseController {

    public static function index() {
        $categories = Category::all();

        View::make("sivu/etusivu.html", array('categories' => $categories));
    }

    public static function category($id) {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $category = Category::find($id);
        $categories = array($category);

        View::make("sivu/kategoria.html", array('categories' => $categories, 'user_logged_in' => $user_logged_in));
    }

}
