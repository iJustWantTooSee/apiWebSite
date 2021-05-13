<?php

use DataBase\DatabaseConnector;

require_once "DatabaseConnector.php";
$db = new DatabaseConnector();

class PostsServices
{
    function DeletePosts($userId, $postId)
    {
        global $db;
        $request = "SELECT UserId FROM `posts` WHERE Id = $postId";
        $creatorId = $db->GetResultsQueries($request);
        if($_SESSION['role']=="admin" or $_SESSION['role']=="moderator" or $creatorId[0][0]==$userId){
            $request = "DELETE FROM `posts` WHERE Id = $postId";
            if (!$db->DB_Request($request))
                return false;
            return true;
        }
       return false;
    }
    function AddPosts($creatorId, $text)
    {
        global $db;
        date_default_timezone_set('UTC');
        $date = date('Y-m-d H:i:s');
        $request = "INSERT INTO `posts`(`UserId`, `Id`, `Text`, `Date`) VALUES ($creatorId,null,'$text',NOW())";
        if (!$db->DB_Request($request))
            return false;
        return true;
    }

    function GetAllPosts(){
        global $db;
        $request = "SELECT * FROM `posts`";
        return $db->GetResultsQueriesWithName($request);
    }

    function GetSelectedPost($postId){
        global $db;
        $request = "SELECT * FROM `posts` WHERE Id = $postId";
        return $db->GetResultsQueriesWithName($request);
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
