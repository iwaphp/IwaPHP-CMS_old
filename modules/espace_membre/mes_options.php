<?php
# IwaPHP CMS - Système de gestion de contenu 

	
if (!isset($_SESSION['pseudo'])) { $body .= erreur ; } else {

	if (isset($_POST['theme_m']) && isset($_POST['statut'])) {
	
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET theme_selected='" . $_POST['theme_m'] . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
			$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."statut WHERE id_='".$utilisateur->idUtilisateur."'");
			$result = $db->sql_fetchrow($data);
			(empty($result['statut']) ? $db->sql_query("INSERT INTO ".$db->prefix_tables."statut (`id`, `id_`, `statut`) VALUES (NULL, '".$utilisateur->idUtilisateur."', '".$_POST['statut']."')") : $db->sql_query("UPDATE ".$db->prefix_tables."statut SET statut='" . $_POST['statut'] . "' WHERE id_='".$utilisateur->idUtilisateur."'"));
		
			$body .= $theme_open_boite_titre;
			$body .= 'Configuration';
			$body .= $theme_close_boite_titre;
			$body .='<div align="center">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/icones/appliquer.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/appliquer.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" \>\n").'<br /><br />Modifications apport&eacute;es<br /><br>
			- <a href="'.$index->targetfile.'=espace_membre&dossier=mes_options">Configuration</a><br>
			<br>
			- <a href="'.$index->targetfile.'=espace_membre">Vers l\'espace membre</a>
			<br />'.(!empty($MessageForm) ? $MessageForm : NULL) .'</div>';
			$body .=$theme_close_boite;
	
	} else {
		$body .= $theme_open_boite_titre;
		$body .= 'Configuration';
		$body .= $theme_close_boite_titre;

		  $body .='<form action="index.php?page=espace_membre&dossier=mes_options" method="post" id="formulaire">';
		$body .='<fieldset><legend>Apparence du site</legend>';
		  $body .='<table border="0" cellspacing="0">';
		$body .='<tr>';
		$body .='<td width="35%">Fichier d\'apparence :<br>';


		$body .= '<select name="theme_m">';

		$reponse7 = opendir($index->rootpath.'/themes') ;
		while ($file7 = readdir($reponse7)) 
		{
		if($file7 != '..' && $file7 !='.' && $file7 !='' && $file7 !='' && $file7 !='' && $file7 !='' && $file7 !='index.html' && $file7 !='index.htm')
		{
		$dir_theme_utilisateur = $file7;

		if ($dir_theme_utilisateur == $utilisateur->themeUtilisateur) 
				{
				 
				$body .= '<option selected="selected" value='.$dir_theme_utilisateur.'>'.$dir_theme_utilisateur.'</option>'; 
				 
				} else { 
				
				$body .= '<option value='.$dir_theme_utilisateur.'>'.$dir_theme_utilisateur.'</option>'; 
				
				}

		} 


		}
		$body .= '<br></select>';

		$body .='</td>';
		$body .='</tr>';
		$body .='</table></fieldset><br>';
		$body .='<fieldset><legend>Statut</legend><table border="0" width="100%" align="center" cellspacing="0">';
		$body .='<tr>';
		$body .='<td width="35%">Statut de connexion :<br /><select name="statut" id="select">';
		
		$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."statut WHERE id_='".$utilisateur->idUtilisateur."'");
		$result = $db->sql_fetchrow($data);
		
		if ($result['statut'] == 'online') {
			$body .='<option value="online" selected/>Disponible</option>
		<option value="busy">Occup&eacute;(e)</option>
		<option value="off">Absent(e)</option>
		<option value="hidden">Invisible</option>
		</select>';
		}
		elseif ($result['statut'] == 'busy') {
			$body .='<option value="online">Disponible</option>
		<option value="busy" selected/>Occup&eacute;(e)</option>
		<option value="off">Absent(e)</option>
		<option value="hidden">Invisible</option>
		</select>';
		}
		elseif ($result['statut'] == 'off') {
		
		$body .='<option value="online">Disponible</option>
		<option value="busy">Occup&eacute;(e)</option>
		<option value="off" selected/>Absent(e)</option>
		<option value="hidden">Invisible</option>
		</select>';
		}
		elseif ($result['statut'] == 'hidden') {
		$body .='<option value="online">Disponible</option>
		<option value="busy">Occup&eacute;(e)</option>
		<option value="off">Absent(e)</option>
		<option value="hidden" selected/>Invisible</option>
		</select>';
		}
		

		$body .='</td>';
		$body .='</tr>';
		$body .='</table></fieldset>';
		$elements->OpenDynamicMenuSimple();
		$elements->ButtonDynamicMenu ('appliquer.png', APPLIQUER, null, 'javascript:document.getElementById(\'formulaire\').submit()', 1);
		$elements->NbspDynamicMenu ();
		$elements->ButtonDynamicMenu ('retour.png', CANCEL, null, 'espace_membre', 0);
		$elements->CloseDynamicMenuSimple();
		$body .='</form>';
		 
		$body .= $theme_close_boite;


	}
}
?>