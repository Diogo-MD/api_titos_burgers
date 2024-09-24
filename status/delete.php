<?php

require_once("../controller/controllerStatus.php");
require_once("../model/modelStatus.php");

if($_SERVER["REQUEST_METHOD"] == "DELETE") {

    $query = $_SERVER["QUERY_STRING"];
    parse_str($query, $params);

    $id = $params["id"];

    $controllerStatus = new controllerStatus();
    $delete = $controllerStatus->delete($id);

    if($delete) {
        $msg = array("msg" => "Status deleted successfully.");
        echo json_encode($msg);
    } else {
        $msg = array("msg" => "Error, status does not deleted.");
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}