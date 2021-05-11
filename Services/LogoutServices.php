<?php
    session_start();
    class LogoutServices{
        function Logout() {
            unset($_SESSION['user']);
            unset($_SESSION["token"]);
            unset($_SESSION["role"]);
        }
    } 
?>