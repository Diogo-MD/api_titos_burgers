<?php

require_once("../controller/controllerProducts.php");
require_once("../model/modelProducts.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET["id"];

    $controllerProducts = new controllerProducts();
    $search = $controllerProducts->searchById($id);

    if($search) {
        $msg = array("product" => $search);
        echo json_encode($msg);
    } else {
        $msg = array("product" => [], "msg" => "Product not found.");
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}