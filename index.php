<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();
//Require the autoload file
require_once("vendor/autoload.php");
require_once("model/data-layer.php");
require_once("model/validation.php");


//Instantiate the F3 Base class
$f3 = Base::instance();

//Default route
$f3->route('GET /', function() {

    $view = new Template();
    echo $view->render('views/datingHome.html');
});



$f3->route('GET|POST /personalInfo', function($f3) {


    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

//        //Validate the data
//        if (empty($_POST['gender']) || !in_array($_POST['gender'], $genders)) {
//            //echo "<p>Please select a gender</p>";
//        }
        //Data is valid

        if(!validName($_POST['fName'],$_POST['lName'])){

            // set an error variable in the F3 hive
            $f3->set('errors["name"]', "Enter a valid name");
        }

        if(!validAge($_POST['age'])){
             //set an error variable in the F3 hive
            $f3->set('errors["age"]', "Please enter a number");
        }

        if(!validPhone($_POST['phoneNumber'])){
            //set an error variable in the F3 hive
            $f3->set('errors["phoneNumber"]', "Please enter a valid phone number");
        }






//        if(!isset($_POST['options'])){
//
//            // set an error variable in the F3 hive
//            $f3->set('errors["options"]',"Please select at least one");
//        }

        if(empty($f3->get('errors'))){

            //Store the data in the session array
            $_SESSION['fName'] = $_POST['fName'];
            $_SESSION['lName'] = $_POST['lName'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['phoneNumber'] = $_POST['phoneNumber'];

            //Direct to profile page
            $f3->reroute('profile');

        }
    }


    $f3->set('fName', $_POST['fName']);
    $f3->set('lName', $_POST['lName']);
    $f3->set('age', $_POST['age']);
    $f3->set('phoneNumber', $_POST['phoneNumber']);


    //$f3->set('selectedOption', $_POST['option']);
    //$f3->set('options', $options);

    //$f3->set('genders', $genders);
    $view = new Template();
    echo $view->render('views/personalInfo.html');


});

$f3->route('GET|POST /profile', function($f3) {



    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

       if(!validEmail($_POST['email'])){
           $f3->set('errors["email"]', "Please enter a valid email");
       }

        if(empty($f3->get('errors'))) {

            //Store the data in the session array
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['seeking'] = $_POST['seeking'];

            //Redirect to summary page
            $f3->reroute('interests');
        }


    }

    $f3->set('email', $_POST['email']);
    $f3->set('state', $_POST['state']);
    $f3->set('seeking', $_POST['seeking']);


    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /interests', function($f3) {

    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if(!validIndoor($_POST['email'])){
            $f3->set('errors["email"]', "Please enter a valid email");
        }{

        }

        //Store the data in the session array
         $_SESSION['interests'] = $_POST['interests'];

        //Redirect to summary page
        $f3->reroute('summary');
    }
    $f3->set('interests', $interests);
    $view = new Template();
    echo $view->render('views/interests.html');
});

$f3->route('GET|POST /summary', function($f3) {

    $view = new Template();
    echo $view->render('views/summary.html');

    session_destroy();
});



//Run F3
$f3->run();