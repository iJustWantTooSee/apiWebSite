<?php
session_start();

use DataBase\DatabaseConnector;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/CitiesServices.php';
require_once "DatabaseConnector.php";
$serviceCity = new CitiesServices();
$db = new DatabaseConnector();

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
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}
//TODO продумать, как лучше сделать разбиение на свичкейсе
function Get($method, $urlData, $formData)
{
    global $serviceCity;
    switch (sizeof($urlData)) {
        case 0:
            OutputCities();
            break;
        case 1:
            if(is_numeric($urlData[0])){
                OutputSelectedCity($serviceCity, $urlData[0]);
            }
           else{
            header('HTTP/1.0 403 Forbidden');
           }
            break;
        case 2:
            if ($urlData[1]=="peoples" and is_numeric($urlData[0])){
                OutputPeopleFromCity($serviceCity, $urlData[0]);
            }else{
                header('HTTP/1.0 403 Forbidden');
               }
            
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function Post($method, $urlData, $formData)
{
    global $serviceCity;
    switch (sizeof($urlData)) {
        case 0:
            if ($formData["Name"]!=""){
                AddCity($serviceCity, $formData["Name"]);
            }
            else{
                header('HTTP/1.0 400 Bad Request');
            }
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function Patch($method, $urlData, $formData)
{
    global $serviceCity;
    switch (sizeof($urlData)) {
        case 1:
            if($formData["Name"] != ""){
                EditCity($serviceCity, $urlData[0], $formData["Name"]);
            }
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function Delete($method, $urlData, $formData)
{
    if(is_numeric($urlData[0]) and $urlData[1]==""){
        global $serviceCity;
        if ($_SESSION["role"] == "admin" and $serviceCity->DeleteCity($urlData[0])) {
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'HTTP/1.0' => '200 OK'
            ));
        } else {
            header('HTTP/1.0 403 Forbidden');
        }
    }
    else{
        header('HTTP/1.0 501 Not Implemented');
    }
    
}

function OutputCities()
{
    global $db;
    $cities = $db->GetCities("SELECT * FROM cities", 2);
    echo json_encode(array(
        'cities' => $cities
    ));
}

function OutputSelectedCity($service, $CityId)
{
    $city = $service->GetSelectedCity($CityId);
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'cities' => $city
        ));
   
}

function OutputPeopleFromCity($service, $cityId)
{
    $people = $service->OutputPeopleFromCity($cityId);
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'cities' => $people
        ));
}

function  AddCity($service, $name)
{
    if ($_SESSION["role"] == "admin" and $service->AddCity($name)) {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => '200 OK'
        ));
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}

function EditCity($service, $id, $name)
{
    if ($_SESSION["role"] == "admin" and $service->EditCity($id, $name)) {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
           'HTTP/1.0' => "200 OK"
        ));
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
?>