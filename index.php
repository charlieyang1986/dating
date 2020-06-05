<?php
/*
 * Name: Chunhai Yang
 * IT328
 * dating app
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


//Require the autoload file
require_once("vendor/autoload.php");
require_once("model/data-layer.php");
//require_once("model/validation.php");
//require_once("classes/member.php");

//Start a session AFTER requiring autoload.php
session_start();

//Instantiate the my classes
$f3 = Base::instance();
$validator = new Validation();

//pass in fat free object and validator object
$controller = new Controller($f3, $validator);


//Default route
$f3->route('GET /', function() {
    global $controller;
    $controller->home();
});



$f3->route('GET|POST /personalInfo', function() {
   global $controller;
   $controller->personalInfo();

});

$f3->route('GET|POST /profile', function() {

    global $controller;
    $controller->profile();
});

$f3->route('GET|POST /interests', function() {

    global $controller;
    $controller->interest();

});

$f3->route('GET|POST /summary', function() {

    global $controller;
    $controller->summary();
});



//Run F3
$f3->run();