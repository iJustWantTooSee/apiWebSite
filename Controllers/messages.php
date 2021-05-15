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
    global $serviceMessages;
    switch (sizeof($urlData)) {
        case 0:
            GetMessages($serviceMessages);
            break;
        case 1:
            if (is_numeric($urlData[0]) and $urlData[1] == "") {
                GetSelectedMessage($serviceMessages, $urlData[0]);
            } else {
                header('HTTP/1.0 501 Not Implemented');
            }
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function GetMessages($serviceMessages)
{
    if ($_SESSION["user"] != "" and isset($_SESSION['user'])) {
        $messages = $serviceMessages->GetMessages($_SESSION['user']);
        if ($messages) {
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'messages' => $messages
            ));
        } else {
            header('HTTP/1.0 403 Forbidden');
        }
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }
}

function GetSelectedMessage($serviceMessages, $messageId)
{
    if ($_SESSION["user"] != "" and isset($_SESSION['user'])) {
        $messages = $serviceMessages->GetSelectedMessage($_SESSION['user'], $messageId);
        if ($messages) {
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'messages' => $messages
            ));
        } else {
            header('HTTP/1.0 403 Forbidden');
        }
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }
}




function Delete($method, $urlData, $formData)
{
    if (is_numeric($urlData[0]) and $urlData[1] == "") {
        global $serviceMessages;
        if ($serviceMessages->DeleteMessage($_SESSION['user'], $urlData[0])) {
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
    } else {
        header('HTTP/1.0 401 Unauthorized');
    }
}
?>