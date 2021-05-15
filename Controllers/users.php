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
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}


function Get($method, $urlData, $formData)
{
    global $service;
    switch (sizeof($urlData)) {
        case 0:
            GetAllUser($service);
            break;
        case 1:
            if (is_numeric($urlData[0])){
                GetUser($service, $urlData);
            }
            else{
                header('HTTP/1.0 400 Bad Request');
            }
            break;
        case 2:
            if ($urlData[0] == "photos") {
                GetSelectedUserPhotos($service, $urlData[1]);
            }
            if ($urlData[1] == "posts") {
                GetUserPosts($service, $urlData[0]);
            }
            if ($urlData[1] == "messages") {
                GetUserMessages($service, $urlData[0], $formData["offset"], $formData["limit"]);
            }
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function GetUserMessages($service, $userId, $offset, $limit)
{
    if ($_SESSION["user"] != "" and isset($_SESSION['user'])) {
        if ($limit == 0 or $limit > 100) {
            $limit = 100;
        }
        $messages = $service->GetUserMessages($_SESSION["user"], $userId, $offset, $limit);
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'messages' => $messages
        ));
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}

function GetAllUser($service)
{
    $users = $service->GetUsers();
    header('HTTP/1.0 200 OK');
    echo json_encode(array(
        'users' => $users
    ));
    exit();
}

function GetUser($service, $urlData)
{
    $user = $service->GetSpecifficUser($urlData[0]);
    header('HTTP/1.0 200 OK');
    echo json_encode(array(
        'users' => $user
    ));
}


function GetSelectedUserPhotos($service, $id)
{
    $photos = $service->GetSelectedUserPhotos($id);

    header('HTTP/1.0 200 OK');
    echo json_encode(array(
        'photos' => $photos
    ));
}

function GetUserPosts($service, $userId)
{
    $posts = $service->GetUserPosts($userId);

    header('HTTP/1.0 200 OK');
    echo json_encode(array(
        'posts' => $posts
    ));
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
            }
            break;
        case 2:
            if ($urlData[1] == "avatar") {
                if (($_SESSION["role"] == "admin" or $_SESSION["user"] == $urlData[0])) {
                    $user = $service->AddAvatar($urlData[0], "Avatars");
                    if($user){
                        header('HTTP/1.0 200 OK');
                        echo json_encode(array(
                            'user' => $user
                        ));
                    }
                    else{
                        header('HTTP/1.0 400 Bad Request');
                    }
                    
                } else {
                    header('HTTP/1.0 400 Bad Request');
                }
            }
            else{
                if ($urlData[1] == "messages") {
                    SendMessage($service, $urlData[0], $formData["message"]);
                }
                else{
                    header('HTTP/1.0 400 Bad Request');
                }
            }
            exit();
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function SendMessage($service, $userId, $text)
{
    if ($_SESSION["user"] != "" and isset($_SESSION["user"])) {
        $messageId =  $service->SendMessage($_SESSION['user'], $userId, $text);
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'Id' => $messageId
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
    }
}

function Patch($method, $urlData, $formData)
{
    global $service, $serviceLogin;
    switch (sizeof($urlData)) {
        case 1:
            if(is_numeric($urlData[0])){
                EditUser($service, $urlData, $formData);
            }
            else{
                header('HTTP/1.0 400 Bad Request');
            }
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
                    header('HTTP/1.0 501 Not Implemented');
                    break;
            }
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
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
    }
}

function SetUserCity($service, $urlData, $formData)
{
    if (($_SESSION["role"] == "admin" or $_SESSION["user"] == $urlData[0]) and is_numeric($formData["CityId"])
        and $service->SetUserCity($urlData[0], $formData["CityId"])
    ) {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => '200 OK'
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
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
    }
}

function SetUserRole($service, $urlData, $formData)
{
    if ($_SESSION["role"] == "admin" and $service->SetUserRole($urlData[0], $formData)
    ) {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => '200 OK'
        ));
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}


function Delete($service, $urlData, $formData)
{
    if(is_numeric($urlData[0]) and $urlData[1]==""){
        global $service, $serviceLogin;
        if ($_SESSION["role"] == "admin"  and $service->DeleteUser($urlData[0])) {
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'HTTP/1.0' => '200 OK'
            ));
        } else {
            header('HTTP/1.0 403 Forbidden');
        }
    }
    else {
        header('HTTP/1.0 501 Not Implemented');
    }
    
}
?>