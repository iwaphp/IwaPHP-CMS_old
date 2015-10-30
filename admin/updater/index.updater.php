<?php

# IwaPHP CMS - Système de gestion de contenu 

# Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['pseudo'])) { $body .='Interdit !'; } else {
######################################################################################################################################
#                                                  --- Instance d'autorisation ---                                                   #
######################################################################################################################################
	
	# Determine le niveau de l'utilisateur en cours
	$db_user = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$utilisateur->idUtilisateur."'");
	$result_user = $db->sql_fetchrow($db_user);

	# Compare le niveau d'utilisateur
	$db_level = $db->sql_query("SELECT * FROM ".$db->prefix_tables."niveaux WHERE numero='".$result_user['grade']."'");
	$result_level = $db->sql_fetchrow($db_level);
	
		# Recherche si une de ces partie est existante pour le niveau de l'utilisateur trouvé
		if (preg_match("/\bconfig_server\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >



	$body .= $theme_open_boite ;
	
	$body .= '<fieldset><legend>Vérification automatique des mises &agrave; jour</legend>
			</strong>IwaPHP Update vous permet de maintenir votre portail &agrave; jour.<br>
            <br> 
            <em><strong>Information sur votre version actuelle :</strong></em><br>
            Version : '.VERSION.' <BR>
           
			Num&eacute;ro du correctif : '.NO_CORRECTIF.' <BR>
			Langage par d&eacute;faut : '.LANG.'<BR>
			Patch install&eacute; : '.PATCH.'<BR>
			Site web des mises &agrave; jour : http://informatique-factory.com/update/<br>
			<br> ';
			
			$handle = fopen('http://informatique-factory.com/update/last_version.txt', 'r');
				if ($handle)
				{
					while (!feof($handle))
					{
						$buffer = fgets($handle);
						$body .= 'La version de IwaPHP la plus récente est : '.$buffer.'.';
						if ($buffer != VERSION) {
							$body .='<br /><span style="color:red">IwaPHP n\'est pas &agrave; jour !</span><br /><br />';
						} else {
							$body .='IwaPHP est &agrave; jour !';
						}
					}
					fclose($handle);
				} 

            $body .= '<br /><strong>Liste des mises &agrave; jour disponibles <br>
            </strong>IwaPHP Update a &eacute;tabli la liste des mises &agrave; jour disponible pour votre portail.<br>
            <br> 
            <em><strong>Mises &agrave; jour disponibles  :</strong></em><br><br>';
			
		
				$handle = fopen('http://informatique-factory.com/update/last_version.txt', 'r');
				if ($handle)
				{
					while (!feof($handle))
					{
						$buffer = fgets($handle);
							$handle2 = fopen('http://informatique-factory.com/update/'.$buffer.'/list.php', 'r');
							if ($handle2)
							{
								while (!feof($handle2))
								{
									$buffer2 = fgets($handle2);
									$body .= $buffer2;
								}
								fclose($handle2);
							} 
					}
					fclose($handle);
				}
			
	$body .= $theme_close_boite ;
				
	
	

	

}}
	
 

?>