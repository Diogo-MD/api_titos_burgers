<?php

require_once("../controller/controllerStatus.php");
require_once("../model/modelStatus.php");

if($_SERVER["REQUEST_METHOD"] == "PUT") {

    $query = $_SERVER["QUERY_STRING"];
    parse_str($query, $params);

    $id = $params["id"];

    $data = json_decode(file_get_contents("php://input"), true);
    
    $controllerStatus = new controllerStatus();
    $update = $controllerStatus->update($id, $data);

    if($update) {
        $msg = array("msg" => "Status Updated Successfully.");
        echo json_encode($msg);
    } else {
        $msg = array("msg" => "Error, Status was not updated.");
        echo json_encode($msg);
    }

} else {
    header("HTTP/1.1 404 Method Not Allowed.");
}