<?php
session_start();
     require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/LoginServices.php';
     $service = new LoginServices();
     
 
     function route($method, $urlData, $formData)
     {
         global $service;
         switch ($method) {
             case 'GET':
                 break;
             case 'POST':
                 break;
             case 'PATCH':
                 break;
             case 'DELETE':
                 break;
         }
         if( $_SESSION["token"] == ""  and $service->Login($formData)){
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'Authorization' => "Bearer " . $_SESSION["token"]));
         }
         else{
            header('HTTP/1.0 400 Bad Request');
            echo json_encode(array(
                'error' => 'Bad Request'
            ));
         }
        
     }
 


?>