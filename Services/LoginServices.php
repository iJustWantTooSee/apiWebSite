<?php
    session_start();
     use DataBase\DatabaseConnector;
     require_once "DatabaseConnector.php";
     $db = new DatabaseConnector();
     class LoginServices{
        function Login($formData) : bool{
            global $db;
            $MySqlLink= $db->GetMySqlLink();
            $Username = htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Username"]));  
	        $Password = md5(htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Password"])));  
            $request = "SELECT Id FROM `users` WHERE Username = '$Username' and Password ='$Password'";
            $user = $db->GetResultsQueries($request, 7);
            if (sizeof($user)==1){
                $_SESSION["user"] = $user[0][0];
                return true;
            }
            else{
                //TODO обработка ошибок
                return false;
            }
        }
     }
?>