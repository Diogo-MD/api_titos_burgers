<?php

require_once("../controller/controllerProducts.php");
require_once("../model/modelProducts.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {

    $controllerProducts = new controllerProducts();
    $list= $controllerProducts->listAll();

    if($list) {
        $msg = array("products" => $list);
        echo json_encode($list);
    } else {
        $msg = array("products" => []);
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}