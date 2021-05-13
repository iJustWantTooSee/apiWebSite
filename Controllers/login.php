<?php
session_start();
     require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/LoginServices.php';
     $service = new LoginServices();
     
 
     function route($method, $urlData, $formData)
     {
         global $service;
         switch ($method) {
             case 'POST':
                if( $_SESSION["token"] == ""  and $service->Login($formData)){
                    header('HTTP/1.0 200 OK');
                    echo json_encode(array(
                        'Authorization' => "Bearer " . $_SESSION["token"]));
                 }
                 else{
                    header('HTTP/1.0 403 Forbidden');
                 }
                 break;
            default:
            header('HTTP/1.0 501 Not Implemented');
                break;
         }

        
     }
 


?>