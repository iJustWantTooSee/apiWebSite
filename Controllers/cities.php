<?php
session_start();
use DataBase\DatabaseConnector;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/CitiesServices.php';
require_once "DatabaseConnector.php";
$serviceCity = new CitiesServices();
$db = new DatabaseConnector();
//куда перенаправляется
function route($method, $urlData, $formData)
{
    switch ($method) {
        case 'GET':
            Get($method, $urlData, $formData);
            break;
        case 'POST':
            Post($method, $urlData, $formData);
            break;
        case 'PATCH':
            Patch($method, $urlData, $formData);
            break;
        case 'DELETE':
            Delete($method, $urlData, $formData);
            break;
    }
}
//TODO продумать, как лучше сделать разбиение на свичкейсе
function Get($method, $urlData, $formData){
    global $serviceCity;
    switch(sizeof($urlData)){
        case 0:
            OutputCities();
            break;
        case 1:
            OutputSelectedCity($serviceCity, $urlData[0]);
            break;
        case 2:
            OutputPeopleFromCity($serviceCity, $urlData[0]);
            break;
        default:
        //TODO сделать обработку ошибок
            break;
    }
}

function Post($method, $urlData, $formData){
    global $serviceCity;
    switch(sizeof($urlData)){
        case 0:
            AddCity($serviceCity, $formData["Name"]);
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

function Patch($method, $urlData, $formData){
    global $serviceCity;
    switch(sizeof($urlData)){
        case 0:
            break;
        case 1:
            EditCity($serviceCity, $urlData[0] ,$formData["Name"]);
            break;
        case 2:
           
            break;
        default:
        //TODO сделать обработку ошибок
            break;
    }
}

function Delete($method, $urlData, $formData){
    global $serviceCity;
    if ($_SESSION["role"] == "admin" and $serviceCity->DeleteCity($urlData[0])){
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => "200 OK"
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
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

function  AddCity($service, $name){
    if ($_SESSION["role"] == "admin" and $service->AddCity($name)){
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => "200 OK"
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
}

function EditCity($service,$id ,$name){
    if ($_SESSION["role"] == "admin" and $service->EditCity($id,$name)){
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => "200 OK"
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
}

?>