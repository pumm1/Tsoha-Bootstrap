<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/login', function() {
    PersonController::login();
});

$routes->post('/kategoria/logout', function() {
    PersonController::logout();
});

$routes->post('/resepti/logout', function() {
    PersonController::logout();
});

$routes->post('/resepti/:id/logout', function() {
    PersonController::logout();
});

$routes->get('/register', function() {
    PersonController::register();
});

$routes->get('/resepti/register', function() {
    PersonController::register();
});

$routes->post('/register', function() {
    PersonController::store();
});

$routes->post('/resepti/register', function() {
    PersonController::store();
});

$routes->post('/logout', function() {
    PersonController::logout();
});

$routes->post('/login', function() {
    PersonController::handle_login();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
    CategoryController::index();
});

$routes->get('/resepti/:id/muok', function($id) {
    RecipeController::edit($id);
});


$routes->post('/resepti/:id/muok', function($id) {
    RecipeController::update($id);
});

$routes->post('/resepti/:id/destroy', function($id) {
    RecipeController::destroy($id);
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

$routes->post('/kategoria/resepti', function() { //tämä taitaa olla se toimiva post
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



