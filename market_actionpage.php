<?php

/*
  Author: Niena Rahma Alhassan
 */
include("gen.php");
$cmd = get_datan("cmd");
switch ($cmd) {
    case 1:
        getUserDetails();
        break;
    case 2:
        addNewUser();

        break;
    case 3;
        addAGood();
        break;
    case 4;
        upDateAGood();
        break;
    case 5;
        testPrice();
        break;
    case 6;
        getAllUserGoods();
        break;

    default:
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "unknown command");
        echo "}";
}

function getUserDetails() {
    include_once("marketclass.php");

    $username = get_data("username");
    $password = get_data("password");
    $v = new marketclass(); //create an object
    $row = $v->getUser($username, $password); //get all the details in the record
    $row = $v->fetch();
    //display error message
    if (!$row) {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "User Not Found!");
        echo "}";
        return;
    }

    echo "{";
    echo jsonn("result", 1) . ",";
    echo '"Details":{';

    echo jsons("name", $row['username']);

    echo '}';
    echo "}";
}

function addNewUser() {
    include_once("marketclass.php");

    $username = get_data("username");
    $password = get_data("password");

    $v = new marketclass();
    $row = $v->addUser($username, $password);
    if (!$row) {
        //display error message
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Could not add user!");
        echo "}";
        return;
    }
    //display success message
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", "Successful!");
    echo "}";
}

//This function allows a new record to be added	
function addAGood() {
    include_once("marketclass.php");

    $trader = get_data("trader");
    $good = get_data("good");
    /* $price = get_datan("price");
      $lat = get_datan("lat");
      $long = get_datan("long"); */


    $v = new marketclass();
    $row = $v->addGood($trader, $good);
    if (!$row) {
        //display error message
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Could not add Good!");
        echo "}";
        return;
    }

    //display success message
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", "Good added!");
    echo "}";
}

function upDateAGood() {
    include_once("marketclass.php");
    $goodNo = get_datan("goodNo");
    $price = get_datan("price");
    $lat = get_datan("lat");
    $long = get_datan("long");


    $v = new marketclass();
    $row = $v->updateGood($goodNo, $price, $lat, $long);
    if (!$row) {
        //display error message
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Update Failed!");
        echo "}";
        return;
    }

    //display success message					
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", "Update successful!");
    echo "}";
}

function testPrice() {
    include_once("marketclass.php");
    $goodNo = get_datan("goodNo");
    $price = get_datan("price");


    $v = new marketclass();
    $row = $v->updatePrice($goodNo, $price);
    if (!$row) {
        //display error message
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Update Failed!");
        echo "}";
        return;
    }

    //display success message					
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", "Update successful!");
    echo "}";
}

function getAllUserGoods() {

    include_once("marketclass.php");
    $username = get_data("username");



    $v = new marketclass();
    $row = $v->getGoods($username);
    $row = $v->fetch();
    if (!$row) {
        //display error message
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Update Failed!");
        echo "}";
        return;
    }

    echo " {
    ";
    echo jsonn("result", 1) . ", ";
    echo '"details":';
    echo "[";
    echo "{";
    echo jsons("good", $row['good']) . ", ";
    echo jsonn("price", $row['price']);
    echo "}";
    while ($row = $v->fetch()) {
        echo ",";

        echo "{";
        echo jsons("good", $row['good']) . ", ";
        echo jsonn("price", $row['price']);
        echo "}";
    }
    echo "]";


    echo "
}";
}

?>