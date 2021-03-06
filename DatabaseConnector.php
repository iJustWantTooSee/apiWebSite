<?php

namespace DataBase;
use enums\UserStatus;
use mysqli;
use stdClass;

require_once 'C:\viktor\key\connection.php';
require_once "Enums/Status.php";
class DatabaseConnector
{
    function GetMySqlLink(): mysqli
    {
        global  $host, $user, $password, $database;
        $link = mysqli_connect($host, $user, $password, $database)
            or die("Ошибка " . mysqli_error($link));

        return $link;
    }

    function GetResultsQueries($request, $amountRows = 1): array
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
            for ($i = 0; $i < $amount_rows; $i++) {
                $temp_data = mysqli_fetch_row($res);
                for ($j = 0; $j < $amountRows; $j++) {
                    $dataFromRow[] = $temp_data[$j];
                }
                $data[] = $dataFromRow;
                $dataFromRow = array();
            }
            $link->close();
            return $data;
        }
        $link->close();
    }

    function DB_Request($request): bool
    {
        $link = $this->GetMySqlLink();
        $result = mysqli_query($link, $request) or die("Ошибка " . mysqli_error($link));
        if (!$result) {
            return false;
        }
        $link->close();
        return true;
    }

    function GetUserInfo($request): array
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
            for ($i = 0; $i < $amount_rows; $i++) {
                $temp_data = mysqli_fetch_assoc($res);
                foreach ($temp_data as $key => $value) {
                    if ($_SESSION['role'] == "admin" and $key == "Birthday") {
                        $dataFromRow[$key] = $value;
                    } else {
                        if ($_SESSION['role'] == "admin" and $key == "RoleId") {
                            $request = "SELECT Name FROM `roles` WHERE Id =" . $value;
                            $newValue = $this->GetResultsQueries($request);
                            $dataFromRow[$key] = $newValue[0][0];
                        }
                    }
                    if ($key != "RoleId" and $key != "Birthday") {
                        if($key=="Status" and $value!=null){
                            $dataFromRow[$key] = UserStatus::$status[$value];
                        }
                        else{
                            if($key=="CityId" and $value!=null){
                                $dataFromRow[$key] = $this->GetResultsQueries("SELECT Name FROM `cities` WHERE Id = $value")[0][0];
                            }
                            else{
                                $dataFromRow[$key] = $value;
                            }
                        }
                    }
                }
                $data[] = $dataFromRow;
                $dataFromRow = array();
            }
            $link->close();
            return $data;
        }
        $link->close();
    }
    
    function GetResultsQueriesWithName($request): array
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
            for ($i = 0; $i < $amount_rows; $i++) {
                $temp_data = mysqli_fetch_assoc($res);
                foreach ($temp_data as $key => $value) {
                    $dataFromRow[$key] = $value;
                }
                $data[] = $dataFromRow;
                $dataFromRow = array();
            }
            $link->close();
            return $data;
        }
        $link->close();
    }


    function GetCities($request){
        $link = $this->GetMySqlLink();
        $res = mysqli_query($link, $request) or die("Ошибка " . mysqli_error($link));
        if (!$res) //SQL
        {
            echo "Не удалось выполнить запрос: (" . $link->errno . ") " . $link->error;
        } else {
            $data = new stdClass();
            while($city = $res->fetch_object()){
                $data->temp[] = $city;
            }
            $link->close();
            return $data->temp;
        }
        $link->close();
    }
}
?>