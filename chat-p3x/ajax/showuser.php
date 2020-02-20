<?php
	require '../init.php';
	
	if(isset($_SESSION['id_utilisateur']))
	{	
		// MAJ session
		$sql = "UPDATE p3x_chat_session SET date=CURRENT_TIMESTAMP WHERE id_utilisateur=".intval($_SESSION['id_utilisateur']);
		$query = $db->prepare($sql);
		$query->execute();
		
		// Liste utilisateurs
		$utilisateur = array();
		$sql = "SELECT p3x_chat_session.id_utilisateur, p3x_chat_utilisateur.login, p3x_chat_utilisateur.avatar, p3x_chat_utilisateur.avatar_url FROM p3x_chat_session
				LEFT JOIN p3x_chat_utilisateur ON p3x_chat_utilisateur.id_utilisateur=p3x_chat_session.id_utilisateur
				WHERE (p3x_chat_session.date BETWEEN timestamp(DATE_SUB(NOW(), INTERVAL 10 SECOND)) AND timestamp(NOW()))
				GROUP BY p3x_chat_session.id_utilisateur";
		foreach($db->query($sql) as $data)
		{
			$usr = array('id_utilisateur' => $data['id_utilisateur'],
						'login' => $data['login'],
						'avatar' => $data['avatar'],
						'avatar_url' => $data['avatar_url']);
			$utilisateur[] = $usr;
		}
		
		echo json_encode($utilisateur);
	}
?>