<?php
error_reporting(E_ALL);
ini_set("display_errors", 0);

function lister_fichiers($rep)  
{  
	if(is_dir($rep))  
	{  
		if($iteration = opendir($rep))  
		{  
			while(($fichier = readdir($iteration)) !== false)  
			{  
				if($fichier != "." && $fichier != ".." && $fichier != "Thumbs.db")  
				{  
					echo '<a href="'.$rep.$fichier.'" target="_blank" >'.$fichier.'</a><br />'."\n";  
				}  
			}  
			closedir($iteration);  
		}  
	}  
} 

lister_fichiers("./");
?>

