<?php
    use DataBase\DatabaseConnector;
    require_once "DatabaseConnector.php";
    $db = new DatabaseConnector();
    
    class UsersServices{
        function AddUser($method, $urlData, $formData) : bool{
            global $db;
            $MySqlLink= $db->GetMySqlLink();
            $Name = htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Name"]));  
	        $Surname = htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Surname"]));  
	        $Username = htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Username"]));  
	        $Password = md5(htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Password"])));  
	        $Birthday = htmlentities(mysqli_real_escape_string($MySqlLink,$formData["Birthday"]));

            if($this->IsExistenceUser($Username)){
                exit("Данный юзер уже существует");
            }
            if(!isset($Birthday) or $Birthday == ""){
                $query = "INSERT INTO `users`
            (`Id`, `Name`, `Surname`, `UserName`, `Birthday`, `Avatar`, `Status`, `CityId`, `RoleId`, `Password`)
             VALUES (null,'$Name','$Surname','$Username',null,null,null,null,null,'$Password')";
            }
            else{
                $query = "INSERT INTO `users`
                (`Id`, `Name`, `Surname`, `UserName`, `Birthday`, `Avatar`, `Status`, `CityId`, `RoleId`, `Password`)
                 VALUES (null,'$Name','$Surname','$Username','$Birthday',null,null,null,1,'$Password')";
            }

            if(!$db->DB_Request($query))
                return false;
            return true;

        }

        function IsExistenceUser($Username) : bool{
            global $db;
            $amountUser = $db->GetResultsQueries("SELECT Username FROM users WHERE Username = " . '"' . $Username .'"');
            if (sizeof($amountUser)>0){
                return true;
            }
            return false;
        }

        function GetUsers() : array {
            global $db;
            if($_SESSION['role'] == "admin"){
                $request = "SELECT Name,Surname,UserName,Birthday,Avatar, Status, CityId, RoleId FROM users; ";
                $data = $db->GetUserInfo($request);
            }
            else{
                $request = "SELECT Name,Surname,UserName,Birthday,Avatar, Status, CityId FROM users; ";
                $data = $db->GetUserInfo($request);
            }
            return $data;
        }

        function GetSpecifficUser($id) : array {
            global $db;
            if($_SESSION['role'] == "admin"){
                $request = "SELECT Name,Surname,UserName, Birthday ,Avatar, Status, CityId, RoleId
                FROM users
                    WHERE Id =$id; ";
                $data = $db->GetUserInfo($request);
            }
            else{
                $request = "SELECT Name,Surname,UserName,Birthday,Avatar,Status, CityId
                 FROM users
                    WHERE Id =$id; ";
                $data = $db->GetUserInfo($request);
            }
            return $data;
        }

        function AddAvatar($id, $dir) : array {
            global $db;
            $user = Array();
            if ($_FILES && $_FILES["filename"]["error"]== UPLOAD_ERR_OK)
            {
               
                $name = htmlspecialchars(basename($_FILES["File"]["name"]));
                $path = "Uploads/$dir/". time() . $name;
                if(move_uploaded_file($_FILES["File"]["tmp_name"], $path)){
                    $request = "UPDATE `users` SET Avatar = '$path' WHERE Id = $id";
                    $user = $this->GetSpecifficUser($id);
                    if($user[0]["Avatar"]  != null){
                        if (!unlink($user[0]["Avatar"])){
                            echo 'ERROR';
                        }     
                    }
                    $user[0]["Avatar"] = $path;
                    $db->DB_Request($request);
                }
                else{
                    echo 'ERROR';
                }
            }
            return $user;
        }
    }

?>