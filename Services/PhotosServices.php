<?php
use DataBase\DatabaseConnector;

require_once "DatabaseConnector.php";
$db = new DatabaseConnector();

class PhotosServices{

    function OutputPhotos($userId){
        global $db;
        $data = array();
        $request = "SELECT * FROM `photos` WHERE CreatorId=$userId";
        $data = $db->GetResultsQueriesWithName($request);
        return $data;
    }

    function AddPhoto($id, $dir):array{
        global $db;
        $data = array();
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $detectedType = exif_imagetype($_FILES['File']['tmp_name']);
        if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK 
        && in_array($detectedType,$allowedTypes)) {

            $name = htmlspecialchars(basename($_FILES["File"]["name"]));
            $path =  "Uploads/$dir/" . time() . $name;
            if (move_uploaded_file($_FILES["File"]["tmp_name"], $path)) {
                $request="INSERT INTO `photos`(`Id`, `CreatorId`, `Link`) VALUES (null,$id,'/$path')";
                $db->DB_Request($request);
                $request = "SELECT * FROM `photos` WHERE Link = '/$path'";
                $data = $db->GetResultsQueriesWithName($request);
            } else {
                echo 'ERROR';
            }
        }
        return $data;
    }

    function DeletePhoto($photoId):bool{
        global $db;
        $request = "SELECT CreatorId, Link FROM `photos` WHERE Id=$photoId";
        $data=$db->GetResultsQueries($request,2);
        if($_SESSION['role']=="admin" or $_SESSION['user']==$data[0][0]){
            $path = substr($data[0][1],1);
            if(!unlink($path)){
                return false;
            }
            $request="DELETE FROM `photos` WHERE Id=$photoId";
            $db->DB_Request($request);
            return true;
        }
        return false;
    }

}