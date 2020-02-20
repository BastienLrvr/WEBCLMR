<head>
    <link href="../../public/CSS/bulma.css" rel="stylesheet">
  <link href="../../public/CSS/bulma.min.css" rel="stylesheet">
    <link href="../../public/CSS/style.css" rel="stylesheet">
    <meta charset="UTF-8">
</head>
<object width="800" height="500">
<center><table class="table is-striped" border="2px" cellspacing="5" cellpadding="5" color="solid black" >
 <?php
 
    include("../../public/cnx/cnx.php");

    $resultat = $cnxpdo->query("SELECT * FROM client");

    echo "<tr>
    <td><strong>Nom Prénom </strong></td>
    <td><strong>Téléphone</strong></td>
    <td><strong>Mail</strong></td>
    <td><strong>Fax</strong></td>
    <td><strong>Adversaire</strong></td>
    <td><strong>Ville</strong></td>
    <td><strong>Pays</strong></td>
    </tr>";

    while ($donnees = $resultat->fetch())
    {
    echo "<tr>
    <td>".$donnees['Nom_prenom']."</td>
    <td>".$donnees['tel']."</td>
    <td>".$donnees['mail']."</td>
    <td>".$donnees['fax']."</td>
    <td>".$donnees['adversaire']."</td>
    <td>".$donnees['ville']."</td>
    <td>".$donnees['pays']."</td></tr>";;
    }
    $resultat->closeCursor();
 ?>
</object>