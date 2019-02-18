<?php
/**
 * Created by PhpStorm.
 * User: kkoud
 * Date: 18/02/2019
 * Time: 08:41
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../config.php";

$dbConn = new DatabaseConnector();

$zamestnanci = $dbConn->GetAllZamestnanci();

echo (json_encode($zamestnanci));