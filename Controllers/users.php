<?php
session_start();

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
            Patch($method, $urlData, $formData);
            break;
        case 'DELETE':
            Delete($method, $urlData, $formData);
            break;
    }
}


function Get($method, $urlData, $formData)
{
    global $service, $serviceLogin;
    switch (sizeof($urlData)) {
        case 0:
            GetAllUser($service);
            break;
        case 1:
            GetUser($service, $urlData);
            break;
        case 2:
            if($urlData[0]=="photos"){
                GetSelectedUserPhotos($service, $urlData[1]);
            }
            break;
        default:
            //TODO сделать обработку ошибок
            break;
    }
}

function GetAllUser($service)
{
    $users = $service->GetUsers();
    header('HTTP/1.0 200 OK');
    echo json_encode(array(
        'users' => $users
    ));
}

function GetUser($service, $urlData)
{
    $user = $service->GetSpecifficUser($urlData[0]);
    if ($user == null) {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'User not found'

        ));
    } else {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'users' => $user
        ));
    }
}


function GetSelectedUserPhotos($service, $id){
    $photos = $service->GetSelectedUserPhotos($id);
    if ($photos == null) {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'User not found'

        ));
    } else {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'users' => $photos
        ));
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
            if (($_SESSION["role"] == "admin" or $_SESSION["user"] == $urlData[0])) {
                $user = $service->AddAvatar($urlData[0], "Avatars");
                header('HTTP/1.0 200 OK');
                echo json_encode(array(
                    'data' => $user
                ));
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo json_encode(array(
                    'error' => 'Bad Request'

                ));
            }
            break;
        default:
            //TODO сделать обработку ошибок
            break;
    }
}


function Patch($method, $urlData, $formData)
{
    global $service, $serviceLogin;
    switch (sizeof($urlData)) {
        case 0:
            break;
        case 1:
            EditUser($service, $urlData, $formData);
            break;
        case 2:
            switch ($urlData[1]) {
                case "city":
                    SetUserCity($service, $urlData, $formData);
                    break;
                case "status":
                    SetUserStatus($service, $urlData, $formData);
                    break;
                case "role":
                    SetUserRole($service, $urlData, $formData);
                    break;
                default:
                    break;
            }
            break;
        default:
            //TODO сделать обработку ошибок
            break;
    }
}

function EditUser($service, $urlData, $formData)
{
    if (($_SESSION["role"] == "admin" or $_SESSION["user"] == $urlData[0])) {
        $user = $service->EditUser($urlData[0], $formData);
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'user' => $user
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'

        ));
    }
}

function SetUserCity($service, $urlData, $formData)
{
    if (($_SESSION["role"] == "admin" or $_SESSION["user"] == $urlData[0])
        and $service->SetUserCity($urlData[0], $formData)
    ) {

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
}

function SetUserStatus($service, $urlData, $formData)
{
    if (($_SESSION["role"] == "admin" or $_SESSION["user"] == $urlData[0])
        and $service->SetUserStatus($urlData[0], $formData)
    ) {

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
}

function SetUserRole($service, $urlData, $formData)
{
    if (($_SESSION["role"] == "admin" or $_SESSION["user"] == $urlData[0])
        and $service->SetUserRole($urlData[0], $formData)
    ) {

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
}


function Delete($service, $urlData, $formData){
    global $service, $serviceLogin;
    if ($_SESSION["role"] == "admin"  and $service->DeleteUser($urlData[0])){
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
}
?>