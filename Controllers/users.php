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
                if($service->AddUser($method, $urlData, $formData)){
                    header('HTTP/1.0 200 OK');
                    echo json_encode(array(
                        'HTTP/1.0' => '200 OK'));
                }
                else{
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

    

?>