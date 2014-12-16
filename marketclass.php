
<?php

include_once("adb.php");

class marketClass extends adb {

    function marketClass() {
        adb::adb();
    }

    function add_trader($username, $password) {
        return $this->query("INSERT INTO `market_people`(`username`,`user_password`) "
                        . "VALUES ('$username','$password')");
    }

    function getTraderDetails($username, $password) {
        return $this->query("select username from market_people where username='$username'
                && user_password='$password'");
    }

    function addGoods($trader, $good,$location/*,$date*/) {
        return $this->query("INSERT INTO `goodstable`(`trader`, `good`,`location`,`date`)"
                . "VALUES ('$trader','$good','$location',CURDATE())");
    }

    function getGoods($username) {
        return $this->query("SELECT goodNo,trader,good,price,location,date FROM `goodstable` WHERE trader='$username'");
       
    }

    function updateGoods($id, $good, $price,$location,$date) {
        return $this->query("UPDATE `goodstable` SET `good`='$good',`price`=$price,`location`='$location',`date`='$date' WHERE goodNo=$id");
    }

    function getAGoods() {
        return $this->query("Select trader,good,price,location,date FROM `goodstable` order by date ");
    }
}

?>
