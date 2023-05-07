<?php
session_start(); // start the session

// unset all session variables
$_SESSION = array();

// delete the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// destroy the session
session_destroy();

// redirect the user to the home page
header('Location: index.php');
exit;
?>
