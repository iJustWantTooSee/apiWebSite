<?php

use DataBase\DatabaseConnector;
use enums\UserStatus;

require_once "DatabaseConnector.php";
require_once "Enums/Status.php";
$db = new DatabaseConnector();
class UsersServices
{
    function AddUser($method, $urlData, $formData): bool
    {
        global $db;
        $MySqlLink = $db->GetMySqlLink();
        $Name = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Name"]));
        $Surname = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Surname"]));
        $Username = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Username"]));
        $Password = md5(htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Password"])));
        $Birthday = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Birthday"]));

        if ($this->IsExistenceUser($Username)) {
            exit("Данный юзер уже существует");
        }
        if (!isset($Birthday) or $Birthday == "") {
            $query = "INSERT INTO `users`
            (`Id`, `Name`, `Surname`, `UserName`, `Birthday`, `Avatar`, `Status`, `CityId`, `RoleId`, `Password`)
             VALUES (null,'$Name','$Surname','$Username',null,null,null,null,1,'$Password')";
        } else {
            $query = "INSERT INTO `users`
                (`Id`, `Name`, `Surname`, `UserName`, `Birthday`, `Avatar`, `Status`, `CityId`, `RoleId`, `Password`)
                 VALUES (null,'$Name','$Surname','$Username','$Birthday',null,null,null,1,'$Password')";
        }

        if (!$db->DB_Request($query))
            return false;
        return true;
    }

    function IsExistenceUser($Username): bool
    {
        global $db;
        $amountUser = $db->GetResultsQueries("SELECT Username FROM users WHERE Username = " . '"' . $Username . '"');
        if (sizeof($amountUser) > 0) {
            return true;
        }
        return false;
    }

    function GetUsers(): array
    {
        global $db;
        if ($_SESSION['role'] == "admin") {
            $request = "SELECT Id, Name,Surname,UserName,Birthday,Avatar, Status, CityId, RoleId FROM users; ";
            $data = $db->GetUserInfo($request);
        } else {
            $request = "SELECT Id, Name,Surname,UserName,Birthday,Avatar, Status, CityId FROM users; ";
            $data = $db->GetUserInfo($request);
        }
        return $data;
    }

    function GetSpecifficUser($id): array
    {
        global $db;
        if ($_SESSION['role'] == "admin") {
            $request = "SELECT Id, Name,Surname,UserName, Birthday ,Avatar, Status, CityId, RoleId
                FROM users
                    WHERE Id =$id ";
            $data = $db->GetUserInfo($request);
        } else {
            $request = "SELECT Id, Name,Surname,UserName,Birthday,Avatar,Status, CityId
                 FROM users
                    WHERE Id =$id; ";
            $data = $db->GetUserInfo($request);
        }
        return $data;
    }

    function GetSelectedUserPhotos($id) : array{
        global $db;
        $request = "SELECT * FROM `photos` WHERE CreatorId=$id";
        return $db->GetResultsQueriesWithName($request);
    }

    function SendMessage($creatorId, $userId, $text)
    {
        global $db;
        $request = "SELECT MAX(Id) FROM `messages`";
        $maxId = $db->GetResultsQueries($request)[0][0]+1;
        $request = "INSERT INTO `messages`(`Id`, `Text`, `Date`, `UserId`, `CreatorId`)
         VALUES ($maxId,'$text',NOW(),$userId,$creatorId)";
        $db->DB_Request($request);
        return  $maxId;
    }

    function GetUserMessages($creatorId,$userId, $offset,$limit){
        global $db;
        $request = "SELECT * FROM `messages`
         WHERE (CreatorId = $creatorId AND UserId = $userId)
             OR (CreatorId = $userId AND UserId = $creatorId) LIMIT $limit OFFSET $offset";
        return $db->GetResultsQueriesWithName($request);
    }

    function AddAvatar($id, $dir): array
    {
        global $db;
        $user = array();
        $user = $this->GetSpecifficUser($id);
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $detectedType = exif_imagetype($_FILES['File']['tmp_name']);
        if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK 
        && in_array($detectedType,$allowedTypes) and $user) {

            $name = htmlspecialchars(basename($_FILES["File"]["name"]));
            $path = "Uploads/$dir/" . time() . $name;
            if (move_uploaded_file($_FILES["File"]["tmp_name"], $path)) {
                $request = "UPDATE `users` SET Avatar = '/$path' WHERE Id = $id";
                if ($user[0]["Avatar"]  != null) {
                    if (!unlink(substr($user[0]["Avatar"],1))) {
                        echo 'ERROR';
                    }
                }
                $user[0]["Status"] = UserStatus::$status[$user[0]["Status"]];
                $user[0]["Avatar"] = "/" . $path;
                $db->DB_Request($request);
            } else {
                echo 'ERROR';
            }
        }
        return $user;
    }

    function GetUserPosts($UserId) :array{
        global $db;
        $request = "SELECT * FROM `posts` WHERE UserId=$UserId";
        return $db->GetResultsQueriesWithName($request);
    }

    function EditUser($id, $formData)
    {
        global $db;
        $MySqlLink = $db->GetMySqlLink();
        $Name = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Name"]));
        $Surname = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Surname"]));
        $Username = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Username"]));
        $Password = md5(htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Password"])));
        $Birthday = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Birthday"]));
        $Avatar = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Avatar"]));
        $request = "SELECT Id,Name,Surname,UserName,Password,Birthday,Avatar,Status, CityId
            FROM users
               WHERE Id =$id; ";
        $user = $db->GetResultsQueriesWithName($request);
        $newRequest = 'UPDATE `users` SET ';
        if ($Name != "") {
            $newRequest .= "Name='$Name', ";
            $user[0]["Name"] = $Name;
        }

        if ($Surname != "") {
            $newRequest .= "Surname='$Surname', ";
            $user[0]["Surname"] = $Surname;
        }

        if ($Username != "") {
            $query = "SELECT Id FROM `users` WHERE Username='$Username'";
            $temp = $db->GetResultsQueries($query);
            if ($temp == null) {
                $newRequest .= "UserName='$Username', ";
                $user[0]["Username"] = $Username;
            }
        }

        if ($Password != "") {
            $newRequest .= "Password='$Password', ";
            $user[0]["Password"] = $Password;
        }

        if ($Birthday != "") {
            $newRequest .= "Birthday='$Birthday', ";
            $user[0]["Birthday"] = $Birthday;
        }

        if ($Avatar != "") {
            $newRequest .= "Avatar='$Avatar' ";
            $user[0]["Avatar"] = $Avatar;
        }
        else{
            mb_substr($newRequest,0,-2);
        }


        $newRequest .= "WHERE Id=$id";
        if (!$db->DB_Request($newRequest)) {
            echo 'Error';
        }
        unset($user[0]["Password"]);
        $user[0]["Status"] = UserStatus::$status[$user[0]["Status"]];
        return $user;
    }

    function SetUserCity($id, $cityId): bool
    {
        global $db;
        $MySqlLink = $db->GetMySqlLink();
        $request = "UPDATE `users` SET CityId = '$cityId' WHERE Id = $id";
        if (!$db->DB_Request($request)) {
            return false;
        }
        return true;
    }

    function SetUserStatus($id, $formData): bool
    {
        global $db;
        $MySqlLink = $db->GetMySqlLink();
        $Status = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["Status"]));
        $request = "UPDATE `users` SET Status = '$Status' WHERE Id = $id";
        if (!$db->DB_Request($request)) {
            return false;
        }
        return true;
    }

    function SetUserRole($id, $formData): bool
    {
        global $db;
        $MySqlLink = $db->GetMySqlLink();
        $RoleId = htmlentities(mysqli_real_escape_string($MySqlLink, $formData["RoleId"]));
        $request = "UPDATE `users` SET RoleId = '$RoleId' WHERE Id = $id";
        if (!$db->DB_Request($request)) {
            return false;
        }
        return true;
    }

    function DeleteUser($id): bool
    {
        global $db;
        $request = "DELETE FROM `users` WHERE Id = $id";
        if (!$db->DB_Request($request)) {
            return false;
        }
        return true;
    }
}
?>