<?php
session_start();

include_once('config_url.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other page
    header("Location: $_admin_login");
    exit();
} else {    
    header("Location: $_uc_manager");
    exit();
}