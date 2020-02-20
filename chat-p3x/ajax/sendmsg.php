<?php
	require '../init.php';
	
	if(isset($_POST['message']) && !empty($_POST['message']) && isset($_SESSION['id_utilisateur']))
	{
		$usr = 0;
		if(isset($_POST['usr'])){ $usr = $_POST['usr']; }
		
		$sql = "INSERT INTO p3x_chat_message(id_utilisateur,id_utilisateur_prive,message) VALUES(".intval($_SESSION['id_utilisateur']).",".intval($usr).",:message)";
		$query = $db->prepare($sql);
		$query->bindValue(':message', $_POST['message'], PDO::PARAM_STR);
		$query->execute();
	}
?>