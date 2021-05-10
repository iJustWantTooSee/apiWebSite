<?php
namespace DataBase;
use mysqli;
require_once 'C:\viktor\key\connection.php';

class DatabaseConnector
{
    function GetMySqlLink() : mysqli
    { 
       global  $host, $user, $password, $database; 
       $link = mysqli_connect($host, $user, $password, $database) 
            or die("Ошибка " . mysqli_error($link)); 

       return $link; 
    }

    function GetResultsQueries($request, $amountRows=1) : array
    {
        $link = $this->GetMySqlLink();
        $res = mysqli_query($link, $request) or die("Ошибка " . mysqli_error($link));
        if (!$res) //SQL
        {
            echo "Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error;
        } else {
            $amount_rows = mysqli_num_rows($res);
            $data = array();
            $dataFromRow = array();
            for($i = 0; $i< $amount_rows; $i++){
                $temp_data = mysqli_fetch_row($res);
                for ($j=0; $j < $amountRows; $j++) { 
                    $dataFromRow[]=$temp_data[$j];
                }
                $data[]=$dataFromRow;
                $dataFromRow = array();
            }
            $link->close();
            return $data;
        }
        $link->close();
    }

    function Insert($request) : bool{
        $link = $this->GetMySqlLink();
        $result = mysqli_query($link, $request) or die("Ошибка " . mysqli_error($link)); 
        if(!$result)
        {
            echo "Произошла ошибка парсинга";
            return false;
        }
        $link->close();
        return true;
    }
}
?>