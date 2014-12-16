<?php

include("gen.php");
$cmd = get_datan("cmd");
switch ($cmd) {
    case 1:

        getUser();
        break;
    case 2:
        addUser();
        break;
    case 3;
        addGood();
        break;
    case 4;
        
        updateGoods();
        break;
    case 5;
        getGoods();
        break;
    /* else display an error message if no command
      is selected */
    case 6;
        getAllGoods();
        break;
    default:
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "unknown command");
        echo "}";
}

//This function will get all the details of a user
function getUser() {
    include_once("marketclass.php");

    $user = get_data("user");
    $pass = get_data("password");
    $v = new marketclass();
    $row = $v->getTraderDetails($user, $pass);
    $row = $v->fetch();
    //display error message
    if (!$row) {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo '"trader":{';
        echo jsons("message", "record not found");
        echo "}";
        return;
    }

    echo "{";
    echo jsonn("result", 1) . ",";
    echo '"trader":{';
    //record id
    echo jsons("Username", $row['username']);
    echo '}';
    echo "}";
}

//This function allows a new record to be added	
function addUser() {
    //get the details from the request page
    $username = get_data("username");
    $password = get_data("password");

    include_once("marketclass.php");
    $v = new marketclass(); // creates a new object
    $row = $v->add_trader($username, $password);  //calls add new record method
    if (!$row) {
        //display error message
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Could not add user");
        echo "}";
        return;
    }

    //display success message
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", "new user added");
    echo "}";
}

function addGood() {
    //get the details from the request page
    $username = get_data("username");
    $goods = get_data("good");
    $location = get_data("location");
   // $date = get_data("date");

    include_once("marketclass.php");
    $v = new marketclass(); // creates a new object
    $row = $v->addGoods($username, $goods, $location/*, $date*/); //calls add new record method
    if (!$row) {
        //display error message
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Could add good");
        echo "}";
        echo mysql_error();
        return;
    }

    //display success message
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", "new good added");
    echo "}";
}

function getGoods() {
    include_once("marketclass.php");

    $user = get_data("user");
    $v = new marketclass();
    $row = $v->getGoods($user);
    $row = $v->fetch();
    //display error message
    if (!$row) {
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "record not found");
        echo "}";
        return;
    }


    echo "{";
    echo jsonn("result", 1) . ",";
    echo '"trader":{';
    //record id
    echo jsons("goodNo", $row['goodNo']).",";
    echo jsons("trad", $row['trader']).",";
    echo jsons("good", $row['good']).",";
    echo jsons("price", $row['price']).",";
    echo jsons("locat", $row['location']).",";
    echo jsons("date", $row['date']);
    echo '}';
    echo "}";
}



//This function allows a record to be changed
function updateGoods() {
    //get the details from the request page
    $id = get_datan("id");
    $good = get_data("good");
    $price = get_datan("price");
    $location = get_data("location");
    $date = get_data("date");
    if (!$id) {
        //display error message		
        echo "There is no id";
    }
    include_once("marketclass.php");
    $v = new marketclass(); //creates a new school_feeding object
    $row = $v->updateGoods($id, $good, $price, $location, $date); //calls the update method
    if (!$row) {
        //display error message
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Could not update");
        echo "}";
        return;
    }
    //display success message
    echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", "goods updated, successful");
    echo "}";
}

function getAllGoods() {
    include_once("marketclass.php");
    $v = new marketclass(); //creates a new school_feeding object
    $row = $v->getAGoods(); //calls the update method
    if (!$row) {
        //display error message
        echo "{";
        echo jsonn("result", 0) . ",";
        echo jsons("message", "Could not retrieve data");
        echo "}";
        return;
    }
    //display success message
    /*echo "{";
    echo jsonn("result", 1) . ",";
    echo jsons("message", " successful");
    echo "}";*/


//$row = mysql_fetch_assoc($dataset);
while ($row=$v->fetch()) {
    $json['Goods'][] = $row;
    //$row = mysql_fetch_assoc($dataset);
}

echo json_encode($json);
//echo "}";
}
?>