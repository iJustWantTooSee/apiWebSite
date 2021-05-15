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
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}
//TODO продумать, как лучше сделать разбиение на свичкейсе
function Get($method, $urlData, $formData)
{
    global $servicePosts;
    switch (sizeof($urlData)) {
        case 0:
            GetAllPosts($servicePosts);
            break;
        case 1:
            if (is_numeric($urlData[0]))
                GetSelectedPost($servicePosts, $urlData[0]);
            else
                header('HTTP/1.0 501 Not Implemented');
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function GetAllPosts($servicePosts)
{
    $posts = $servicePosts->GetAllPosts();
    header('HTTP/1.0 200 OK');
    echo json_encode(array(
        'posts' => $posts
    ));
}

function GetSelectedPost($servicePosts, $postId)
{
    $posts = $servicePosts->GetSelectedPost($postId);
    header('HTTP/1.0 200 OK');
    echo json_encode(array(
        'posts' => $posts
    ));
}

function Post($method, $urlData, $formData)
{
    global $servicePosts;
    switch (sizeof($urlData)) {
        case 0:
            CreatePost($servicePosts, $formData["Text"], $formData["UserId"]);
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function CreatePost($service, $text, $UserId)
{
    if ($_SESSION["user"] != "" and isset($_SESSION["user"]) and  $service->AddPosts($UserId, $text)) {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => '200 OK'
        ));
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}

function Patch($method, $urlData, $formData)
{
    global $servicePosts;
    switch (sizeof($urlData)) {
        case 1:
            if (is_numeric($urlData[0]))
                EditPost($servicePosts, $urlData[0], $formData["Text"]);
            else
                header('HTTP/1.0 501 Not Implemented');
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}

function EditPost($servicePosts, $postId, $text)
{
    if ($servicePosts->EditPost($_SESSION['user'], $postId, $text)) {
        header('HTTP/1.0 200 OK');
        echo json_encode(array(
            'HTTP/1.0' => '200 OK'
        ));
    } else {
        header('HTTP/1.0 403 Forbidden');
    }
}

function Delete($method, $urlData, $formData)
{
    if(is_numeric($urlData[0]) and $urlData[1] ==""){
        global $servicePosts;
        if ( $servicePosts->DeletePosts($_SESSION['user'], $urlData[0])) {
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'HTTP/1.0' => "200 OK"
            ));
        } else {
            header('HTTP/1.0 403 Forbidden');
        }
    }
    else{
        header('HTTP/1.0 501 Not Implemented'); 
    }
  
}
