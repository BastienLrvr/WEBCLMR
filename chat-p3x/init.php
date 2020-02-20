<?php
	header('Content-Type:text/html;charset=utf-8');
	
	// BDD
	define('BDD_USER', 'root');
	define('BDD_PWD', '');
	define('BDD_SERVER', 'localhost');
	define('BDD_NAME', 'webclmr');
	
	// Infos site
	define('URL_SITE', 'http://localhost/WEBCLMR/chat-p3x/');
	define('URL_MEDIA', 'http://localhost/WEBCLMR/chat-p3x/images/');
	define('URL_PROFIL', 'http://localhost/?q=');
	define('PATH_SITE', '/WEBCLMR/chat-p3x/');
	
	// Connexion BDD
	$db = new PDO('mysql:host='.BDD_SERVER.';dbname='.BDD_NAME.';charset=utf8mb4', BDD_USER, BDD_PWD);
	
	// Session
	session_start();
?>