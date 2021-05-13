<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/Services/LogoutServices.php';
$service = new LogoutServices();


function route($method, $urlData, $formData)
{
    global $service;
    switch ($method) {
        case 'POST':
            $service->Logout($formData);
            header('HTTP/1.0 200 OK');
            echo json_encode(array(
                'HTTP/1.0' => '200 OK'
            ));
            break;
        default:
            header('HTTP/1.0 501 Not Implemented');
            break;
    }
}
?>