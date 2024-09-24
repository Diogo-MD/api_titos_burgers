<?php

require_once("../controller/controllerProducts.php");
require_once("../model/modelProducts.php");

if($_SERVER["REQUEST_METHOD"] == "PUT") {

    $query = $_SERVER["QUERY_STRING"];
    parse_str($query, $params);

    $id = $params["id"];

    $data = json_decode(file_get_contents("php://input"), true);

    $controllerProducts = new controllerProducts();
    $update = $controllerProducts->update($id, $data);

    if($update) {
        $msg = array("msg" => "Product has been updated successfully.");
        echo json_encode($msg);
    } else {
        $msg = array("msg" => "Product does not updated.");
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}