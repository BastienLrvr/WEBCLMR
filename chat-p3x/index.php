<?php
	require 'init.php';
	
	if(isset($_POST['action']) && $_POST['action']=='deconnexion')
	{
		unset($_SESSION);
		session_destroy();
		header('Location:'.URL_SITE);
	}
	if(!empty($_POST['login']) && !empty($_POST['password']))
	{
		$sql = "SELECT id_utilisateur FROM p3x_chat_utilisateur WHERE login=:login AND pass=:password";
		$query = $db->prepare($sql);
		$query->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
		$query->bindValue(':password', md5($_POST['password']), PDO::PARAM_STR);
		$query->execute(); 
		$row = $query->fetch();
		if(!empty($row[0])){ $_SESSION['id_utilisateur'] = $row[0]; }
	}
	
	if(isset($_SESSION['id_utilisateur']))
	{
		$sql = "SELECT id_session FROM p3x_chat_session WHERE id_utilisateur=".intval($_SESSION['id_utilisateur']);
		$query = $db->prepare($sql);
		$query->execute();
		$row = $query->fetch();
		if(!empty($row[0]))
		{
			// MAJ session
			$sql = "UPDATE p3x_chat_session SET date=CURRENT_TIMESTAMP WHERE id_utilisateur=".intval($_SESSION['id_utilisateur']);
			$query = $db->prepare($sql);
			$query->execute();
		}
		else
		{
			// Insertion session
			$sql = "INSERT INTO p3x_chat_session(id_utilisateur) VALUES(".intval($_SESSION['id_utilisateur']).")";
			$query = $db->prepare($sql);
			$query->execute();
		}
	}
?>
<!doctype html>
<html lang="fr-FR">
	<head>
		<meta charset="utf-8" />
		<title>Chat p3x : mini chat, chatbox, mini forum instantané</title>
		<style type="text/css">
			body{font-family:Arial;}
			h1,h2,p{text-align:center;}
			
			#main-wrapper{max-width:600px;margin:auto;}
			
			#message{background-color:#f3f2f7;padding:0 10px;height:300px;width:100%;box-sizing:border-box;border-radius:5px;overflow-y:scroll;border:1px solid #cccccc;}
			#utilisateur{list-style:none;padding:0;background-color:#f3f2f7;height:100px;width:100%;box-sizing:border-box;border-radius:5px;overflow-y:scroll;margin-bottom:10px;border:1px solid #cccccc;}
			#send{margin-top:10px;width:100%;padding:5px;border-radius:5px;border:1px solid #cccccc;box-sizing:border-box;}

			.message{border-bottom:1px solid #cccccc;padding:10px 0;font-size:0.9em;}
				.message img{float:left;margin-top:-5px;margin-right:5px;}
			.utilisateur{padding:5px;font-size:0.9em;}
				.utilisateur{color:#3e3e3e;cursor:default;}
					.utilisateur:hover{cursor:pointer;background-color:#cccccc !important;}
				.utilisateur:nth-child(2n+2){background-color:#ffffff;}
				.utilisateur .usr{width:100%;padding-right:5px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;}
					.utilisateur .usr img{float:left;margin-right:5px;}
				.utilisateur-action{position:absolute;box-shadow:1px 1px 3px #cccccc;padding:5px;background-color:#ffffff;border-radius:5px;}
				.utilisateur-action-close{position:absolute;left:130px;top:0px;}
				
			.button{cursor:pointer;padding:10px 15px;font-weight:bold;border-radius:5px;color:#ffffff;border:0px;background:#3e679b;box-sizing:border-box;text-align:center;text-decoration:none;}
				.button-blue:hover{background:#5980B8;}
				
			.clear{clear:both;}
		</style>
	</head>
	<body>
		<div id="main-wrapper">
			<?php
				if(!isset($_SESSION['id_utilisateur']))
				{
				?>
					<h2>Connectez-vous</h2>
					<form method="post" action="<?php echo URL_SITE; ?>">
						<p>Login<br /><input type="text" name="login" /></p>
						<p>Mot de passe<br /><input type="password" name="password" /></p>
						<p><input type="submit" class="button" value="Connexion" /></p>
					</form>
				<?php
				}
				else
				{
				?>
					<form method="post" action="<?php echo URL_SITE; ?>">
						<input type="hidden" name="action" value="deconnexion" />
						<p><input type="submit" value="Se déconnecter" class="button" /></p>
					</form>
					<hr />
					<div class="box-light" id="salle">
						<p>Utilisateurs connectés</p>
						<input type="hidden" name="attentelogin" id="attentelogin" value="<?php echo $_SESSION['id_utilisateur']; ?>" />
						<ul id="utilisateur"></ul>
						<p>Canal de discussion</p>
						<div id="message"></div>
						<input type="text" name="send" id="send" placeholder="Message..." />
						<p><input type="button" id="send-button" class="button" value="Envoyer le message" /></p>
					</div>
					<script src="https://media.p3x.fr/js/jquery-3.2.1.min.js"></script>
					<script>
						// Envoi message
						$('#send-button').click(function(){
							if($('#send').val()!='')
							{
								$.ajax({
								  method: 'POST',
								  url: '<?php echo URL_SITE; ?>ajax/sendmsg.php',
								  data: { message: $('#send').val() }
								});
								$('#send').val('');
							}
						});
						$('#send').keypress(function(event){
							if(event.which==13)
							{
								$('#send-button').click();
							}
						});

						// Affichage des messages
						var timeout = 1000;
						var showmsg = function() {
							$.ajax({
							  method: 'POST',
							  url: '<?php echo URL_SITE; ?>ajax/showmsg.php'
							})
							.done(function(msg){
								var tab = jQuery.parseJSON(msg);
								tab.forEach(function(message){
									if(!$('#message-' + message.id_message).length)
									{
										var pv = '';
										var img = '<?php echo URL_MEDIA; ?>avatar/' + message.avatar + '.png';

										if(message.avatar_url!=''){ img = message.avatar_url; }
										if(message.prive!=0){ pv = '[Privé] '; }

										$('<div></div>')
											.attr('id', 'message-' + message.id_message)
											.addClass('message')
											.html('<img src="' + img + '" alt="' + message.login + '" width="25" height="25" /><strong>' + message.login + '</strong><div class="clear"></div>' + pv + message.message)
											.appendTo('#message');
										var div = $('#message');
										var height = div[0].scrollHeight;
										div.scrollTop(height);
									}
								});
							});
							setTimeout(showmsg, timeout);
						};
						showmsg();

						// Affichage des utilisateurs
						var mousex = 0;
						var mousey = 0;
						$(document).on("mousemove", function(event){
						  mousex = event.pageX;
						  mousey = event.pageY;
						});
						var timeouta = 5000;
						var showuser = function() {
							$.ajax({
							  method: 'POST',
							  url: '<?php echo URL_SITE; ?>ajax/showuser.php'
							})
							.done(function(msg){
								var tab = jQuery.parseJSON(msg);
								var tabusr = [];
								tab.forEach(function(utilisateur){
									tabusr.push('utilisateur-' + utilisateur.id_utilisateur);

									var img = '<?php echo URL_MEDIA; ?>avatar/' + utilisateur.avatar + '.png';

									if(utilisateur.avatar_url!=''){ img = utilisateur.avatar_url; }

									if(!$('#utilisateur-' + utilisateur.id_utilisateur).length)
									{
										$('<li></li>')
											.attr('id', 'utilisateur-' + utilisateur.id_utilisateur)
											.addClass('utilisateur')
											.click(function(){
												$('.utilisateur-action').hide();
												$('#utilisateur-action-' + utilisateur.id_utilisateur)
												.css('top',mousey)
												.css('left',mousex)
												.show();
											})
											.appendTo('#utilisateur');
										$('<div></div>')
											.attr('id', 'utilisateur-usr-' + utilisateur.id_utilisateur)
											.addClass('usr')
											.appendTo('#utilisateur-' + utilisateur.id_utilisateur);
										$('<img />')
											.attr('src', img)
											.css('width', '25px')
											.css('height', '25px')
											.appendTo('#utilisateur-usr-' + utilisateur.id_utilisateur);
										$('<strong></strong>')
											.html(utilisateur.login)
											.appendTo('#utilisateur-usr-' + utilisateur.id_utilisateur);
										$('<div></div>')
											.addClass('clear')
											.appendTo('#utilisateur-' + utilisateur.id_utilisateur);

										if($('#attentelogin').val()!=utilisateur.id_utilisateur)
										{
											$('<div></div>')
												.attr('id', 'utilisateur-action-' + utilisateur.id_utilisateur)
												.addClass('utilisateur-action')
												.hide()
												.appendTo('#utilisateur-' + utilisateur.id_utilisateur);
											$('<img />')
												.attr('src', '<?php echo URL_MEDIA; ?>graphic/deconnexion.png')
												.addClass('utilisateur-action-close')
												.click(function(){
													$('#utilisateur-action-' + utilisateur.id_utilisateur).hide();
													return false;
												})
												.appendTo('#utilisateur-action-' + utilisateur.id_utilisateur);
											$('<div></div>')
												.attr('id', 'utilisateur-action-profil-' + utilisateur.id_utilisateur)
												.html('<img src="<?php echo URL_MEDIA; ?>graphic/profil.png" /> Voir le profil')
												.click(function(){
													window.open('<?php echo URL_PROFIL; ?>' + utilisateur.login,'_blank');
													$('#utilisateur-action-' + utilisateur.id_utilisateur).hide();
													return false;
												})
												.addClass('utilisateur-action-profil')
												.appendTo('#utilisateur-action-' + utilisateur.id_utilisateur);
											$('<div></div>')
												.attr('id', 'utilisateur-action-prive-' + utilisateur.id_utilisateur)
												.html('<img src="<?php echo URL_MEDIA; ?>graphic/message.png" /> Message privé')
												.click(function(){
													var pvmsg = prompt("Votre message privé");
													if(pvmsg!='')
													{
														$.ajax({
														  method: 'POST',
														  url: '<?php echo URL_SITE; ?>ajax/sendmsg.php',
														  data: { message: pvmsg, usr: utilisateur.id_utilisateur }
														});
														$('#utilisateur-action-' + utilisateur.id_utilisateur).hide();
														return false;
													}
												})
												.addClass('utilisateur-action-prive')
												.appendTo('#utilisateur-action-' + utilisateur.id_utilisateur);
										}
									}
								});
								$('.utilisateur').each(function(){
									var comp = '*' + tabusr.join('*') + '*';
									if(!(comp.indexOf('*' + $(this).attr('id') + '*')>-1))
									{
										$(this).remove();
									}
								});
							});
							setTimeout(showuser, timeouta);
						};
						showuser();
					</script>
				<?php
				}
			?>
		</div>
	</body>
</html>