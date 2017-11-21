<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/login', function() {
    HelloWorldController::login();
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



$routes->get('/resepti', function() {
    HelloWorldController::resepti();
});

$routes->post('/kategoria/resepti', function(){ //tämä taitaa olla se toimiva post
    RecipeController::store();
});

//$routes->post('/kategoria/lisaa', function(){ //
//    RecipeController::store();
//});
//
//$routes->post('/resepti', function(){
//    RecipeController::store();
//});

$routes->get('/resepti/login', function() {
    HelloWorldController::login();
});


$routes->get('/resepti/:id', function($id) {
    RecipeController::resepti($id);
});


$routes->get('/muok', function() {
    HelloWorldController::muok();
});
