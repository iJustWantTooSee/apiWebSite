<?php
    session_start();
     require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/LogoutServices.php';
     $service = new LogoutServices();
     
 
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
         $service->Logout($formData);
         header('HTTP/1.0 200 OK');
                    echo json_encode(array(
                        'HTTP/1.0' => '200 OK'));
         #if($service->Logout($formData)){
         #   print_r("Success");
         #}
         #else{
         #    //TODO error message
         #    print_r("Error");
         #}
     }