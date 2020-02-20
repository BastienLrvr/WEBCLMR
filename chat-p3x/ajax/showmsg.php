<?php
	require '../init.php';
	
	if(isset($_SESSION['id_utilisateur']))
	{
		$message = array();
		
		$sql = "SELECT p3x_chat_message.id_message, p3x_chat_utilisateur.login, p3x_chat_utilisateur.avatar, p3x_chat_utilisateur.avatar_url, p3x_chat_message.message, p3x_chat_message.date, p3x_chat_message.id_utilisateur_prive FROM p3x_chat_message
				LEFT JOIN p3x_chat_utilisateur ON p3x_chat_utilisateur.id_utilisateur=p3x_chat_message.id_utilisateur
				WHERE (date BETWEEN timestamp(DATE_SUB(NOW(), INTERVAL 2 MINUTE)) AND timestamp(NOW()))
				AND (p3x_chat_message.id_utilisateur_prive=0 OR p3x_chat_message.id_utilisateur=".intval($_SESSION['id_utilisateur'])." OR p3x_chat_message.id_utilisateur_prive=".intval($_SESSION['id_utilisateur']).") GROUP BY p3x_chat_message.id_message";
		foreach($db->query($sql) as $data)
		{
			$msg = array('id_message' => $data['id_message'],
						'login' => $data['login'],
						'prive' => $data['id_utilisateur_prive'],
						'message' => strip_tags($data['message']),
						'avatar' => $data['avatar'],
						'avatar_url' => $data['avatar_url'],
						'date' => $data['date']);
			$message[] = $msg;
		}
		
		echo json_encode($message);
	}
?>