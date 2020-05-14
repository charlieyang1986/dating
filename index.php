<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();
//Require the autoload file
require_once("vendor/autoload.php");


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

            //Store the data in the session array
        $_SESSION['fName'] = $_POST['fName'];
        $_SESSION['lName'] = $_POST['lName'];
        $_SESSION['age'] = $_POST['age'];
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phoneNumber'] = $_POST['phoneNumber'];


            //Direct to profile page
            $f3->reroute('profile');

    }


    //$f3->set('genders', $genders);
    $view = new Template();
    echo $view->render('views/personalInfo.html');


});

$f3->route('GET|POST /profile', function($f3) {



    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Store the data in the session array
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['state'] = $_POST['state'];


        //Redirect to summary page
        $f3->reroute('interests');
    }


    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3->route('GET|POST /interests', function($f3) {



    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //Store the data in the session array
         $_SESSION['interests'] = $_POST['interests'];

        //Redirect to summary page
        $f3->reroute('summary');
    }


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