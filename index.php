<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start session
session_start();


//Require the autoload File
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');

//Create an instance of the base class
$f3 = Base::instance();
//echo gettype($f3); example of what type is $f3

//Define a default route /- root directory of the project
$f3->route('GET /', function(){

    $view = new Template();
    echo $view->render('views/home.html');
});
//Define a breakfast route
$f3->route('GET /breakfast', function(){
    //echo "Breakfast page";

    $view = new Template();
    echo $view->render('views/breakfast.html');
});
$f3->route('GET /lunch', function(){

    $view = new Template();
    echo $view->render('views/lunch.html');
});
//Define an order route
$f3->route('GET|POST /order', function($f3){
    //echo "Order Form";

    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Move orderForm1 data from Post to Session
        var_dump($_POST);

        //Get the food from the post array
        $food = $_POST['food'];

        //If data is valid
        if(validFood($food)) {
            //store it in the session array
            $_SESSION['food'] = $_POST['food'];

            //Redirect to order2 route
            header('location: order2');
        }
        //Data is not valid -> store an error message
        else{
            $f3->set('errors["food"]', 'Please enter a food at least 2 characters');
        }

        $_SESSION['meal'] = $_POST['meal'];

    }

    //Add meal data to hive
    $f3->set('meals', getMeals());

    $view = new Template();
    echo $view->render('views/orderForm1.html');
});
//Define an order part# 2
$f3->route('GET|POST /order2', function($f3){
    var_dump($_POST);

    //Add condiments data to hive
    $f3->set('condiments', getCondiments());


    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

//Define a summary route
$f3->route('GET|POST /summary', function(){
    var_dump($_POST);
    if(empty($_POST['conds']))
    {
        $conds = "";
    }
    else{
        $conds = implode(", ", $_POST['conds']);
    }
    $_SESSION['conds'] = $conds;
    $view = new Template();
    echo $view->render('views/summary.html');
});
//Run fat free
$f3->run();
