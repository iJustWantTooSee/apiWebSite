<?php
session_start();
use DataBase\DatabaseConnector;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/PhotosServices.php';
require_once "DatabaseConnector.php";
$servicePhotos = new CitiesServices();
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
    global $serviceCity;
    switch(sizeof($urlData)){
        case 0:
           
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
            break;
        case 2:
           
            break;
        default:
        //TODO сделать обработку ошибок
            break;
    }
}



?>