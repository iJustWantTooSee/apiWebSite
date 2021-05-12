<?php
session_start();
use DataBase\DatabaseConnector;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/PhotosServices.php';
require_once "DatabaseConnector.php";
$servicePhotos = new PhotosServices();
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
    global $servicePhotos;
    switch(sizeof($urlData)){
        case 0:
            OutputPhotos($servicePhotos);
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

function OutputPhotos($service){
    if($_SESSION['user']!="" and isset($_SESSION['user'])){
        $photo = $service->OutputPhotos($_SESSION['user']);
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'photo' => $photo
        ));
    }
    else{
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
}

function Post($method, $urlData, $formData){
    global $servicePhotos;
    switch(sizeof($urlData)){
        case 0:
            AddPhoto($servicePhotos, $urlData, $formData);
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
    global $servicePhotos;
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

function AddPhoto($service, $urlData, $formData){
    if($_SESSION['user']!="" and isset($_SESSION['user'])){
        $photo = $service->AddPhoto($_SESSION['user'], "Photos");
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'photo' => $photo
        ));
    }
    else{
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
}

?>