
<?php

include_once("adb.php");

class marketclass extends adb {

    function marketclass() {
        adb::adb();
    }

    function addUser($name,$password) {
        return $this->query("INSERT INTO `market_people`(`username`, `user_password`)"
                . " VALUES ('$name','$password')");
    }

    function getUser($name,$password) {
        return $this->query("SELECT `username` FROM `market_people` WHERE username='$name' "
                . "and user_password='$password'");
    }

    function addGood($trader, $good) {
        return $this->query("INSERT INTO `goodstable`(`trader`, `good`)"
                . " VALUES ('$trader', '$good')");
    }

    function updateGood($goodNo, $price, $lat, $long) {
        return $this->query("UPDATE `goodstable` SET `price`= $price,`lat`=$lat,`long`=$long,`date`=CURDATE() WHERE `goodNo`=$goodNo");
    }

    function getGoods($username) {
        return $this->query("SELECT * FROM `goodstable` WHERE trader='$username' ");
               
    }
    
    function updatePrice($goodNo,$price){
        
    return $this->query("UPDATE `goodstable` SET `price`= $price,`date`=CURDATE() WHERE `goodNo`=$goodNo");
    }
    

}

?>
