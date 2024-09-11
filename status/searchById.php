<?php

require_once("../controller/controllerStatus.php");
require_once("../model/modelStatus.php");

if($_SERVER["REQUEST_METHOD"] == "GET") {

} else {
    header("HTTP/1.1 405 Method Not Allowed");
}