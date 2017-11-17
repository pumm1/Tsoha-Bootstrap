<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
    CategoryController::index();
});

$routes->get('/:id', function($id) {
//    HelloWorldController::kategoria();
    RecipeController::inCategory($id);
//    RecipeController::index();
});

$routes->get('/kategoria/lisaa', function() {
    HelloWorldController::add();
});

$routes->get('/login', function() {
    HelloWorldController::login();
});

$routes->get('/resepti', function() {
    HelloWorldController::resepti();
});

$routes->get('/resepti/:id', function($id) {
    RecipeController::resepti($id);
});

$routes->get('/muok', function() {
    HelloWorldController::muok();
});
