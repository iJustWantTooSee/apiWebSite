<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUTCH,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];
$formData = getFormData($method);
$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);
print_r($formData);
?>

<?php
function getFormData($method) {    
    if ($method === 'GET') return $_GET;
    if ($method === 'POST' && !empty($_POST)) return $_POST;

    $incomingData = file_get_contents('php://input');
    $decodedJSON = json_decode($incomingData); 
    if ($decodedJSON) 
    {
        $data = $decodedJSON;
    } 
        else 
    {
    $data = array();
        $exploded = explode('&', file_get_contents('php://input'));     
        foreach($exploded as $pair) 
        {
            $item = explode('=', $pair);
            if (count($item) == 2) 
            {
                $data[urldecode($item[0])] = urldecode($item[1]);
            }
        } 
    }
    return $data;
}

?>