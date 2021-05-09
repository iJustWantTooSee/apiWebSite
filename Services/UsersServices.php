<?php
    use DataBase\DatabaseConnector;
    require_once "DatabaseConnector.php";
    $db = new DatabaseConnector();
    
    class UsersServices{
        function AddUser($method, $urlData, $formData){
            global $db;
            $MySqlLink= $db->GetMySqlLink();
            $Name = htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Name"]));  
	        $Surname = htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Surname"]));  
	        $Username = htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Username"]));  
	        $Password = md5(htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Password"])));  
	        $Birthday = htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Birthday"]));
            if(!isset($Birthday)){
                $Birthday = null;
            }
            if($this->IsExistenceUser($Username)){
                exit("Данный юзер уже существует");
            }
            $query = "INSERT INTO `users`
            (`Id`, `Name`, `Surname`, `UserName`, `Birthday`, `Avatar`, `Status`, `CityId`, `RoleId`, `Password`)
             VALUES (null,'$Name','$Surname','$Username','$Birthday',null,null,null,null,'$Password')";
            if(!$db->Insert($query))
                echo 'Произошла ошибка';
            

        }

        function IsExistenceUser($Username) : bool{
            global $db;
            $amountUser = $db->GetResultsQueries("SELECT Username FROM users WHERE Username = " . '"' . $Username .'"');
            if (sizeof($amountUser)>0){
                return true;
            }
            return false;
        }
    }

?>