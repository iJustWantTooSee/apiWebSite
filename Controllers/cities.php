<?php

use DataBase\DatabaseConnector;

require_once "DatabaseConnector.php";
$db = new DatabaseConnector();
function route($method, $urlData, $formData)
{
    switch ($method) {
        case 'GET':
            Get($method, $urlData, $formData);
            break;
        case 'POST':
            break;
        case 'PATCH':
            break;
        case 'DELETE':
            break;
    }
}

function Get($method, $urlData, $formData){
    switch(sizeof($urlData)){
        case 0:
            OutputCities();
            break;
        case 1:
            break;
        case 2:
            break;
        default:
        //TODO сделать обработку ошибок
            break;
    }
}

function Post($method, $urlData, $formData){

}

function Patch($method, $urlData, $formData){

}

function Delete($method, $urlData, $formData){

}

function OutputCities(){
    global $db;
    $cities=$db->GetResultsQueries("SELECT Name FROM cities");
    print_r($cities);
}

?>