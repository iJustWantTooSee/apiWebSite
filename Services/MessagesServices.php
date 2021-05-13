<?php

use DataBase\DatabaseConnector;

require_once "DatabaseConnector.php";
$db = new DatabaseConnector();

class PostsServices
{
    function DeleteMessage($userId, $messageId)
    {
        global $db;
        $request = "SELECT UserId, CreatorId FROM `messages` WHERE Id = $messageId";
        $creatorId = $db->GetResultsQueries($request,2);
        if($_SESSION['role']=="admin" or ($creatorId[0][1] == $userId or $creatorId[0][0]==$userId)){
            $request = "DELETE FROM `messages` WHERE Id = $messageId";
            if (!$db->DB_Request($request))
                return false;
            return true;
        }
       return false;
    }


    function GetMessages($userId){
        global $db;
        $request = "SELECT * FROM `messages` WHERE UserId=$userId OR CreatorId = $userId";
        return $db->GetResultsQueriesWithName($request);
    }

    function GetSelectedMessage($userId,$messageId){
        global $db;
        $request = "SELECT * FROM `messages` WHERE Id = $messageId";
        $message = $db->GetResultsQueriesWithName($request);
        if($message[0]['UserId'] == $userId or $message[0]['CreatorId']==$userId){
            return $message;
        }
        return null;
    }

    function EditPost($userId, $postId,$text):bool{
        global $db;
        $request = "SELECT UserId FROM `posts` WHERE Id = $postId";
        $creatorId = $db->GetResultsQueries($request);
        if($_SESSION['role']=="admin" or $_SESSION['role']=="moderator" or $creatorId[0][0]==$userId){
            $request = "UPDATE `posts` SET Text='$text' WHERE Id = $postId";
            if (!$db->DB_Request($request))
                return false;
            return true;
        }
       return false;
    }
}
