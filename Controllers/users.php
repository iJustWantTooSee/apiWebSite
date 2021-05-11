<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/UsersServices.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/LoginServices.php';
$service = new UsersServices();
$serviceLogin = new LoginServices();


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
            break;
        case 'DELETE':
            break;
    }
}

//TODO продумать, как лучше сделать разбиение на свичкейсе
function Post($method, $urlData, $formData)
{
    global $service, $serviceLogin;
    switch (sizeof($urlData)) {
        case 0:
            if (($_SESSION["role"] == "admin" or $_SESSION["token"] == "") and $service->AddUser($method, $urlData, $formData)) {
                if ($_SESSION["role"] != "admin") {
                    $serviceLogin->Login($formData);
                }
                header('HTTP/1.0 200 OK');
                echo json_encode(array(
                    'HTTP/1.0' => '200 OK'
                ));
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo json_encode(array(
                    'error' => 'Bad Request'

                ));
            }
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

function Get($method, $urlData, $formData)
{
    global $service, $serviceLogin;
    switch (sizeof($urlData)) {
        case 0:
            $users = $service->GetUsers();
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'users' => $users

            ));
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