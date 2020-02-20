<?php
session_start();
 
// Suppression des variables de session et de la session
$_SESSION = array();
session_destroy();
 
// Suppression des cookies de connexion automatique
setcookie('loggedin', '');
setcookie('password', '');
 
 
header('Location: ../Auth/login.php');
 
 
?>