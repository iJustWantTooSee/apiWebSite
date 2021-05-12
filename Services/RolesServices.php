<?php
session_start();

use DataBase\DatabaseConnector;

require_once "DatabaseConnector.php";
$db = new DatabaseConnector();

class RolesServices
{

    function GetSelectedRole($id): array
    {
        global $db;
        $request = "SELECT * FROM `roles` WHERE Id = $id";
        $data = $db->GetResultsQueriesWithName($request);
        return $data;
    }

    function AddRole($name): bool
    {
        global $db;
        $query = "INSERT INTO `roles` (`Id`, `Name`) VALUES (null, '$name')";
        if (!$db->DB_Request($query))
            return false;
        return true;
    }

    function EditRole($id, $name): bool
    {
        global $db;
        $query = "UPDATE `roles` SET Name = '$name' WHERE Id = '$id'";
        if ($id != 1 and $id != 2 and $id != 3) {
            if (!$db->DB_Request($query))
                return false;
            return true;
        }
        return false;
    }

    function DeleteRole($id): bool
    {
        global $db;
        $query = "DELETE FROM `roles` WHERE Id = '$id'";
        if ($id != 1 and $id != 2 and $id != 3) {
            if (!$db->DB_Request($query))
                return false;
            return true;
        }
        return false;
    }
}
?>