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
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}
//TODO продумать, как лучше сделать разбиение на свичкейсе
function Get($method, $urlData, $formData)
{
    global $serviceRoles;
    switch (sizeof($urlData)) {
        case 0:
            OutputRoles();
            break;
        case 1:
            if(is_numeric($urlData[0])){
                OutputSelectedRole($serviceRoles, $urlData[0]);
            }
            else{
                header('HTTP/1.0 501 Not Implemented');
            }
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function Post($method, $urlData, $formData)
{
    global $serviceRoles;
    switch (sizeof($urlData)) {
        case 0:
            AddRole($serviceRoles, $formData["Name"]);
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function Patch($method, $urlData, $formData)
{
    global $serviceRoles;
    switch (sizeof($urlData)) {
        case 1:
            if(is_numeric($urlData[0])){
                EditRole($serviceRoles, $urlData[0], $formData["Name"]);
            }
            else{
                header('HTTP/1.0 501 Not Implemented'); 
            }
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function Delete($method, $urlData, $formData)
{
    if (is_numeric($urlData[0]) and $urlData[1]==""){
        global $serviceRoles;
        if ($_SESSION["role"] == "admin" and $serviceRoles->DeleteRole($urlData[0])) {
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

function OutputRoles()
{
    global $db;
    $roles = $db->GetResultsQueriesWithName("SELECT * FROM `roles`", 2);
    header('HTTP/1.0 200 OK');
    echo json_encode(array(
        'roles' => $roles
    ));
}

function OutputSelectedRole($service, $RoleId)
{
    $roles = $service->GetSelectedRole($RoleId);
    if ($roles) {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'roles' => $roles
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');

    }
}

function  AddRole($service, $name)
{
    if ($_SESSION["role"] == "admin" and $service->AddRole($name)) {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => '200 OK'
        ));
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}

function EditRole($service, $id, $name)
{
    if ($_SESSION["role"] == "admin" and $service->EditRole($id, $name)) {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => '200 OK'
        ));
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}
?>