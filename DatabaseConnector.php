<?php
namespace DataBase;
use mysqli;
require_once 'C:\viktor\key\connection.php';
class DatabaseConnector
{
    function GetResultsQueries($request)
    {
        global $host, $user, $password, $database;
        $link = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($link)); 

        $request=htmlentities(mysqli_real_escape_string($link,$request));
        $res = mysqli_query($link, $request) or die("Ошибка " . mysqli_error($link));
        if (!$res) //SQL
        {
            echo "Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error;
        } else {
            $amount_rows = mysqli_num_rows($res);
            $cities = array();
            for($i = 0; $i< $amount_rows; $i++){
                $cities[] = mysqli_fetch_row($res)[0];
            }
            $link->close();
            return $cities;
        }
        $link->close();
    }
}
?>