<?php
session_start();
use DataBase\DatabaseConnector;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/RolesServices.php';
require_once "DatabaseConnector.php";
$serviceRoles = new RolesServices();
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
    global $serviceRoles;
    switch(sizeof($urlData)){
        case 0:
            OutputRoles();
            break;
        case 1:
            OutputSelectedRole($serviceRoles, $urlData[0]);
            break;
        case 2:
            break;
        default:
        //TODO сделать обработку ошибок
            break;
    }
}

function Post($method, $urlData, $formData){
    global $serviceRoles;
    switch(sizeof($urlData)){
        case 0:
            AddRole($serviceRoles, $formData["Name"]);
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
    global $serviceRoles;
    switch(sizeof($urlData)){
        case 0:
            break;
        case 1:
            EditRole($serviceRoles, $urlData[0] ,$formData["Name"]);
            break;
        case 2:
           
            break;
        default:
        //TODO сделать обработку ошибок
            break;
    }
}

function Delete($method, $urlData, $formData){
    global $serviceRoles;
    if ($_SESSION["role"] == "admin" and $serviceRoles->DeleteRole($urlData[0])) {
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

function OutputRoles(){
    global $db;
    $roles=$db->GetResultsQueriesWithName("SELECT * FROM `roles`",2);
    
    echo json_encode(array(
        'HTTP/1.1' => '200 OK',
        'data' => $roles 
    )); 
}

function OutputSelectedRole($service, $RoleId){
    $roles = $service->GetSelectedRole($RoleId);
    if ($roles){
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => $roles
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Role Not Found'
        ));
    }
}

function  AddRole($service, $name){
    if ($_SESSION["role"] == "admin" and $service->AddRole($name)){
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

function EditRole($service,$id ,$name){
    if ($_SESSION["role"] == "admin" and $service->EditRole($id,$name)){
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