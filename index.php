<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start session
session_start();

//Require the autoload File
require_once ('vendor/autoload.php');

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
$f3->route('GET /order', function(){
    //echo "Order Form"
    $view = new Template();
    echo $view->render('views/orderForm1.html');
});
//Define an order part# 2
$f3->route('POST /order2', function(){
    var_dump($_POST);
    $_SESSION['food'] = $_POST['food'];
    $_SESSION['meal'] = $_POST['meal'];
    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

//Define a summary route
$f3->route('POST /summary', function(){
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
