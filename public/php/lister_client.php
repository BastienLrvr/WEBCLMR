
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../CSS/bulma.css" >
	<link rel="stylesheet" type="text/css" href="../CSS/style.css">
	<meta charset="utf-8">
	<title>Liste des clients</title>
</head>
<body>
	<nav class="navbar" role="navigation" aria-label="main navigation">
  			<div class="navbar-brand">
    			<a class="navbar-item" href="#">
      				<img class="hgauche" src="../img/Logo_CLMR.png" />
    			</a>

    			<a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      				<span aria-hidden="true"></span>
      				<span aria-hidden="true"></span>
      				<span aria-hidden="true"></span>
    			</a>
  			</div>

  			<div id="navbarBasicExample" class="navbar-menu">
    			<div class="navbar-start">
      				<a class="navbar-item">
        			Client
      				</a>

      				<a class="navbar-item">
        			Facture
      				</a>

      				<a class="navbar-item">
        			Planning
    				</a>

      				<div class="navbar-item has-dropdown is-hoverable">
						<a class="navbar-link">
          					Mail
        				</a>
        			</div>
      			</div>
    		</div>

    		<div class="navbar-end">
      			<div class="navbar-item">
        			<div class="buttons">
          				<a class="button is-link">
            				<strong>Déconnexion</strong>
          				</a>
        			</div>
      			</div>
    		</div>
		</nav>
	<div class="box">
		<div class="notification is-link is-light"> Liste des clients
		</div>
		<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
			<?php
		 
			    include("../cnx/cnx.php");

			    $resultat = $cnxpdo->query("SELECT fil_nom FROM files");

			    echo "<tr>
			    <td><strong>Clients</strong></td>
			    <td><strong>Modification</strong></td>
			    <td><strong>Suppression</strong></td>
			    </tr>";

			    while ($donnees = $resultat->fetch())
			    {
			    echo "<tr>
			    <td>".$donnees['fil_nom']."</td>
			    <td></td>
			    <td></td></tr>";
			    }
			    $resultat->closeCursor();
		 	?>
		</table>
	</div>
<?php
	$link = "../../../../test_stage/files/Lettre_de_motivation.docx";
	echo "<a href=" .$link.">PDF</a>";
?>


</body>
</html>