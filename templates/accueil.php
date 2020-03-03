<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link href="../public/CSS/bulma.css" rel="stylesheet">
  <link href="../public/CSS/bulma.min.css" rel="stylesheet">
    <link href="../public/CSS/style.css" rel="stylesheet">
    <meta charset="UTF-8">
</head>
<body>
	
	<nav class="navbar is-mobile">
		<img class="logoCLMR" src="../public/img/Logo_CLMR.png"/>
		<div class="bienvenue">
			<p class="subtitle"><?php echo "Bienvenue ", $_SESSION['username']; ?>  </p>
		</div>
	<div class="buttonDeco is-mobile">
		<a href="../Auth/logout.php"><input class="button is-info" type="button" value="Déconnexion"></a>
	</div>
	</nav>
	</br>
<div class="tile is-ancestor">
  <div class="tile is-vertical is-8">
    <div class="tile">
      <div class="tile is-parent is-vertical">
        <article class="tile is-child notification is-danger">
        <a href="https://mail.google.com/mail/u/0/" target="_blank">
          <img class="icon_accueil" src="../public/img/icon_gmail.png">
          <p class="subtitle">Gmail</p>
      	</a>
        </article>
        <article class="tile is-child notification is-info">
        <a href="https://outlook.live.com/owa/" target="_blank">
          <img class="icon_accueil" src="../public/img/icon_outlook.png">
          <p class="subtitle">Outlook</p>
      	</a>
        </article>
      </div>
      <div class="tile is-parent is-vertical">
        <article class="tile is-child notification is-success">
        <a href="client/client.php" target="_blank">
          <img class="icon_accueil" src="../public/img/icon_client.png">
          <p class="subtitle">Clients</p>
      	</a>
        </article>
        <article class="tile is-child notification">
        <a href="../chat-p3x/index.php" target="_blank">
          <img class="icon_accueil" src="../public/img/icon_membre.png">
          <p class="subtitle">Espace membre</p>
      	</a>
        </article>
      </div>
    </div>
  </div>
  <div class="tile is-parent is-vertical">
        <article class="tile is-child notification is-primary">
          <img class="icon_accueil" src="../public/img/icon_facture.png">
          <p class="subtitle">Factures</p>
        </article>
        <article class="tile is-child notification is-warning">
        <a href="calendrier/calendrier.php">
          <img class="icon_accueil" src="../public/img/icon_planning.png">
          <p class="subtitle">Planning</p>
      	</a>
        </article>
      </div>
</div>
</body>
</html>