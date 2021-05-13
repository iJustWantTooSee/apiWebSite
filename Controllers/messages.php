<?php
session_start();
use DataBase\DatabaseConnector;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/MessagesServices.php';
require_once "DatabaseConnector.php";
$serviceMessages = new PostsServices();
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
    global $serviceMessages;
    switch(sizeof($urlData)){
        case 0:
           GetMessages($serviceMessages);
            break;
        case 1:
            GetSelectedMessage($serviceMessages, $urlData[0]);
            break;
        case 2:
            break;
        default:
        //TODO сделать обработку ошибок
            break;
    }
}

function GetMessages($serviceMessages){
    if ($_SESSION["user"]!="" and isset($_SESSION['user'])){
        $messages = $serviceMessages->GetMessages($_SESSION['user']);
        if ($messages) {
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'HTTP/1.0' => $messages
            ));
        } else {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(array(
                'error' => 'Bad Request'
            ));
        }
    }
    else{
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
    
}

function GetSelectedMessage($serviceMessages, $messageId){
    if ($_SESSION["user"]!="" and isset($_SESSION['user'])){
        $messages = $serviceMessages->GetSelectedMessage($_SESSION['user'], $messageId);
        if ($messages) {
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'HTTP/1.0' => $messages
            ));
        } else {
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(array(
                'error' => 'Bad Request'
            ));
        }
    }
    else{
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
}

function Patch($method, $urlData, $formData){
    global $servicePosts;
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



function Delete($method, $urlData, $formData){
    global $serviceMessages;
    if ($serviceMessages->DeleteMessage($_SESSION['user'],$urlData[0])) {
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