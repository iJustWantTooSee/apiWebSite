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
            $request = "SELECT Id, RoleId FROM `users` WHERE Username = '$Username' and Password ='$Password'";
            $user = $db->GetResultsQueries($request, 7);
            if (sizeof($user)==1){
                $_SESSION["user"] = $user[0][0];
                $request = "SELECT Name FROM roles WHERE Id =" . $user[0][1];
                $role = $db->GetResultsQueries($request);
                $_SESSION["role"] = $role[0][0];
                $_SESSION["token"] = $this->GetToken(); 
                return true;
            }
            else{
                //TODO обработка ошибок
                return false;
            }
        }

        private function GetToken() : string{
            $alfavit = "qwert4yuiopa5sdfghjk3lzx6cvbnmQW2ERTYU7IOPAS1DFG8HJK9LZX0CVBNM_";
            $str = "";
            for ($i=0; $i < 32 ; $i++) { 
                $str .= $alfavit[random_int(0,strlen($alfavit))];
            }
            return $str;
        }
     }
?>