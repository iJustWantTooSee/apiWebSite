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
    global $servicePhotos;
    switch (sizeof($urlData)) {
        case 0:
            OutputPhotos($servicePhotos);
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function OutputPhotos($service)
{
    if ($_SESSION['user'] != "" and isset($_SESSION['user'])) {
        $photo = $service->OutputPhotos($_SESSION['user']);
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'photo' => $photo
        ));
        exit();
    } else {
        header('HTTP/1.0 403 Forbidden');
        exit();
    }
}

function Post($method, $urlData, $formData)
{
    global $servicePhotos;
    switch (sizeof($urlData)) {
        case 0:
            AddPhoto($servicePhotos, $urlData, $formData);
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            exit();
            break;
    }
}

function Delete($method, $urlData, $formData)
{
    if(is_numeric($urlData[0]) and $urlData[1]==""){
        global $servicePhotos;
        if ($servicePhotos->DeletePhoto($urlData[0])) {
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
    exit();
}

function AddPhoto($service, $urlData, $formData)
{
    if ($_SESSION['user'] != "" and isset($_SESSION['user'])) {
        $photo = $service->AddPhoto($_SESSION['user'], "Photos");
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'photo' => $photo
        ));
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
    exit();
}
?>