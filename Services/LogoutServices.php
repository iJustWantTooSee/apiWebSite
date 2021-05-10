<?php
    session_start();
    class LogoutServices{
        function Logout() {
            unset($_SESSION['user']);
        }
    } 
?>