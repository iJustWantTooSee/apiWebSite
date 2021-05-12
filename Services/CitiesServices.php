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
    } 
?>