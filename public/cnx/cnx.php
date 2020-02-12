
<?php

try
{
// connexion à la BDD en PDO
$cnxpdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');

}
catch (PDOException $erreur)
{
echo $erreur->getMessage();
}

?>