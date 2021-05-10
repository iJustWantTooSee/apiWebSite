<?php
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
         $service->Login($formData);
         if($service->Login($formData)){
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
        
     }
 


?>