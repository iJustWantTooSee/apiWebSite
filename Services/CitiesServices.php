<?php
    session_start();

    use DataBase\DatabaseConnector;
    require_once "DatabaseConnector.php";
    $db = new DatabaseConnector();
   
    class CitiesServices{
        
        function GetSelectedCity($id) : array{
            global $db;
            $request = "SELECT * FROM `cities` WHERE Id = $id";
            $data = $db->GetResultsQueriesWithName($request);
            return $data;
        }

        function OutputPeopleFromCity($cityId){
            global $db;
            $request = "SELECT `users`.`Id`, `users`.`Name`, Surname, `users`.UserName, `users`.Avatar,`users`.Status, c.`Name`, r.`Name`
             FROM `users`
                 JOIN `roles` AS r 
                    ON `users`.RoleId = r.`Id` 
                 JOIN `cities` AS c 
                    ON c.`Id`=`users`.`CityId`
                         WHERE `users`.CityId = $cityId";
            $tempData = $db->GetResultsQueries($request,8);
            $data = array();
            $temp = array();
            foreach ($tempData as $value) {
                $temp["Id"] = $value[0];
                $temp["Name"] = $value[1];
                $temp["Surname"] = $value[2];
                $temp["UserName"] = $value[3];
                $temp["Avatar"] = $value[4];
                $temp["Status"] = $value[5];
                $temp["City"] = $value[6];
                $temp["Role"]  = $value[7];
                $data[]=$temp;
            }
            return $data;
        }
    } 
?>