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
            OutputSelectedCity($serviceCity, $urlData[0]);
            break;
        case 2:
            OutputPeopleFromCity($serviceCity, $urlData[0]);
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
            AddCity($serviceCity, $formData["Name"]);
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
            EditCity($serviceCity, $urlData[0], $formData["Name"]);
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function Delete($method, $urlData, $formData)
{
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

function OutputCities()
{
    global $db;
    $cities = $db->GetResultsQueries("SELECT * FROM cities", 2);

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