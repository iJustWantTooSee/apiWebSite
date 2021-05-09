<?php

    require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/UsersServices.php';
    $service = new UsersServices();
    

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
    function Post($method, $urlData, $formData){
        global $service;
        switch(sizeof($urlData)){
            case 0:
                $service->AddUser($method, $urlData, $formData);
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