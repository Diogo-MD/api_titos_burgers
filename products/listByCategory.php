<?php 

require_once("../controller/controllerProducts.php");
require_once("../model/modelProducts.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {

    $id = $_GET["id_category"];

    $controllerProducts = new controllerProducts();
    $list = $controllerProducts->listByCategory($id);

    if($list) {
        $msg = array("products" => $list);
        echo json_encode($msg);
    } else {
        $msg = array("products" => [], "msg" => "Products not found");
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}