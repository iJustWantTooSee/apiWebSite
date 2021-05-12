<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUTCH,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
#header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];
$formData = getFormData($method);

$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);

$router = $urls[0];
$urlData = array_slice($urls, 1);
//Проверка на наличие аргументов для дальнейшего роутинга
if(isset($router) and $router!=""){
    //TODO вынести в отдельный файл, где будет проверяться наличие пути при роутинге
    try{
        $file = 'Controllers/' . $router . '.php';
        if (!file_exists($file)) {
            throw new Exception ('Твою ж мать!... А куды файл-то делся?');
        }
        include_once $file;
        route($method, $urlData, $formData);
    }
    catch(Exception $e){
        echo 'Такого адреса не существует';
    }
   
}
else{
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(array(
        'error' => 'Bad Request'
    ));
   
}
?>


<?php
//разбиение юрл на маршруты
function getFormData($method) {    
    if ($method === 'GET') return $_GET;
    if ($method === 'POST' && !empty($_POST)) return $_POST;

    $incomingData = file_get_contents('php://input');
    $decodedJSON = json_decode($incomingData, true); 
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

