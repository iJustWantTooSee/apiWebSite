<?php

use DataBase\DatabaseConnector;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/CitiesServices.php';
require_once "DatabaseConnector.php";
$service = new CitiesServices();
$db = new DatabaseConnector();
//куда перенаправляется
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
//TODO продумать, как лучше сделать разбиение на свичкейсе
function Get($method, $urlData, $formData){
    global $service;
    switch(sizeof($urlData)){
        case 0:
            OutputCities();
            break;
        case 1:
            OutputSelectedCity($service, $urlData[0]);
            break;
        case 2:
            OutputPeopleFromCity($service, $urlData[0]);
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
    $cities=$db->GetResultsQueries("SELECT * FROM cities",2);
    
    echo json_encode(array(
        'HTTP/1.1' => '200 OK',
        'method' => 'GET',
        'data' => $cities 
    )); 
}

function OutputSelectedCity($service, $CityId){
    $city = $service->GetSelectedCity($CityId);
    if ($city){
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => $city
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'City Not Found'
        ));
    }
}

function OutputPeopleFromCity($service, $cityId){
    $people = $service->OutputPeopleFromCity($cityId);
    if ($people){
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => $people
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'City Not Found'
        ));
    }
}

?>