<?php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload File
require_once ('vendor/autoload.php');//package manager


//Start session
session_start();//has to come before any Html output
//Test Order Class
//$order = new Order();
//$order->setFood("tacos");
//$order->setMeal("lunch");
//$order->setCondiments("salsa, guacamole");
//var_dump($order);
//Create an instance of the base class
$f3 = Base::instance();

//create an instance of the controller class
$con = new Controller($f3);

//echo gettype($f3); example of what type is $f3

//Define a default route /- root directory of the project
$f3->route('GET /', function(){

    $GLOBALS['con']->home();
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
    $GLOBALS['con']->order();

});
//Define an order part# 2
$f3->route('GET|POST /order2', function($f3){
    //var_dump($_POST);

    $GLOBALS['con']->order2();
});

//Define a summary route
$f3->route('GET|POST /summary', function(){
    //var_dump($_SESSION);
    $GLOBALS['con']->summary();

});
//Run fat free
$f3->run();
