<?php

require_once("../controller/controllerProducts.php");
require_once("../model/modelProducts.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents("php://input"), true);

    $controllerProducts = new controllerProducts();
    $save = $controllerProducts->save($data);

    if($data) {
        $msg = array("msg" => "Product has been created.");
        echo json_encode($msg);
    } else {
        $msg = array("msg" => "Error, product does not created.");
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}