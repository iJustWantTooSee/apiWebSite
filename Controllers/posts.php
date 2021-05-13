<?php
session_start();
use DataBase\DatabaseConnector;
require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/PostsServices.php';
require_once "DatabaseConnector.php";
$servicePosts = new PostsServices();
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
    global $servicePosts;
    switch(sizeof($urlData)){
        case 0:
            GetAllPosts($servicePosts);
            break;
        case 1:
            GetSelectedPost($servicePosts, $urlData[0]);
            break;
        case 2:
            break;
        default:
        //TODO сделать обработку ошибок
            break;
    }
}

function GetAllPosts($servicePosts){
    $posts= $servicePosts->GetAllPosts();
    if ($posts){
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'posts' => $posts
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
}

function GetSelectedPost($servicePosts, $postId){
    $posts= $servicePosts->GetSelectedPost($postId);
    if ($posts){
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'posts' => $posts
        ));
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo json_encode(array(
            'error' => 'Bad Request'
        ));
    }
}

function Post($method, $urlData, $formData){
    global $servicePosts;
    switch(sizeof($urlData)){
        case 0:
            CreatePost($servicePosts, $formData["Text"], $formData["UserId"]);
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

function CreatePost($service, $text, $UserId){
    if ($_SESSION["user"] != "" and isset($_SESSION["user"]) and  $service->AddPosts($UserId, $text)){
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

function Patch($method, $urlData, $formData){
    global $servicePosts;
    switch(sizeof($urlData)){
        case 0:
            break;
        case 1:
            EditPost($servicePosts,$urlData[0], $formData["Text"]);
            break;
        case 2:
           
            break;
        default:
        //TODO сделать обработку ошибок
            break;
    }
}

function EditPost($servicePosts, $postId, $text){
    if ($servicePosts->EditPost($_SESSION['user'], $postId, $text)) {
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

function Delete($method, $urlData, $formData){
    global $servicePosts;
    if ($servicePosts->DeletePosts($_SESSION['user'],$urlData[0])) {
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