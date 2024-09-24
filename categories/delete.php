<?php

require_once("../controller/controllerCategories.php");
require_once("../model/modelCategories.php");

if($_SERVER["REQUEST_METHOD"] == "DELETE") {

    $query = $_SERVER["QUERY_STRING"];
    parse_str($query, $params);
    $id = $params["id"];

    $controllerCategories = new controllerCategories();
    $delete = $controllerCategories->delete($id);

    if($delete) {
        $msg = array("msg" => "Category was deleted successfully.");
        echo json_encode($msg);
    } else {
        $msg = array("msg" => "Error, category was not deleted.");
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}