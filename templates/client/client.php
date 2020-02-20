<!DOCTYPE html>
<html>
<head>
	<link href="../../public/CSS/bulma.css" rel="stylesheet">
  <link href="../../public/CSS/bulma.min.css" rel="stylesheet">
    <link href="../../public/CSS/style.css" rel="stylesheet">
    <meta charset="UTF-8">
</head>
<body>
	
	<nav class="navbar is-mobile">
		<img class="logoCLMR" src="../../public/img/Logo_CLMR.png"/>
		<div class="buttonDeco is-mobile">
			<button class="button is-link">Déconnexion</button>
		</div>
	</nav>
	<div class="box">
		<?php require('lister_client.php') ?>
	</div>

</body>
</html>