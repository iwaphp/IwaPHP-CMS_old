<?php
# IwaPHP CMS - Système de gestion de contenu 
	
# includes
require $index->rootpath.'/systeme/class.login'.$index->phpEx;
require $index->rootpath.'/systeme/class.connectionwizard'.$index->phpEx;

#
	
if (isset($_GET['action'])) { 
	
	if (!isset($_GET[$index->rootget])) { 
		
		if ($_GET['action'] == "connexion") { 
			# nouvelle session
			$login = new login();
			$login->connexion($_POST['pseudo'], $_POST['password']);
			$func->redirection($login->reponse, $login->redirection, 3000);
			
		} elseif ($_GET['action'] == "deconnexion") { 
			# fin de session
			$login = new login();
			$login->deconnexion($utilisateur->idUtilisateur);
			$func->redirection($login->reponse, $login->redirection, 3000);
			
		}  
		
} 
elseif ($_GET['action'] == "inscription") { 
include ('modules/espace_membre/inscription.php');
} 
elseif ($_GET['action'] == "recuppass") { 
		
		if(isset($_POST['mail'])) {
			
			if(empty($_POST['mail'])) 
			{
			$reponse = ''.RIPM_ERROR_MAIL.'';
			}
			else
			{	

			$mail = htmlentities($_POST['mail']); 
  
			$data = $db->sql_query("SELECT COUNT(*) FROM ".$db->prefix_tables."membre WHERE mail='".$mail."'");                                
			$result = $db->sql_fetchrow($data);	
	
				if($result['COUNT(*)'] != 1) 
				{
				$reponse = ''.RIPM_ERROR_NOTEXIST_MAIL.'';
				}
				else
				{  
	  
				$data2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE mail='".$mail."'");
				$result2 = $db->sql_fetchrow($data2);
				
				$message = '<html><body>'.BONJOUR.',<br><br>';
				$message .= ''.RIPM_TXTI.',<br>';
				$message .= ''.RIPM_TXTII.' :<br>';
				$message .= ''.MESSAGE1_2.'' . $result2['pseudo'] .'<br>';
				$message .= ''.MESSAGE1_3.' :' . $result2['pass'] .'<br><br>';
				$message .= ''.MESSAGE1_7.' <br>';
				$message .= ''.MESSAGE1_8.' ' .recuperer('nom_site'). '<br>';
				$message .= '<a href="'.recuperer('url_site').'">' .recuperer('nom_site'). '</a>';  
		
				$entete = "MIME-Version: 1.0\r\n";
				$entete .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$entete .= "From: <".recuperer('email_admin').">\r\n";
				$entete .= "Reply-To: ".recuperer('email_admin')."\r\n";	   
	
				mail($mail,''.RIPM_TXTIII.'' , $message, $entete); 
	
				$reponse = ''.RIPM_TXTIV.'';
				}
			}
			
		$body .= $theme_open_boite . $reponse . $theme_close_boite ;
		
		} else {
		 
			
		$body .=$theme_open_boite.'<form name="form1" method="post" action="'.$index->targetfile.'=espace_membre&action=recuppass">';
		$body .=''.VOTREADRESSEEMAIL.'&nbsp;<input name="mail" type="text" id="mail">';
		$body .='<br>';
		$body .='<br>';
		$body .='<input type="submit" name="Submit" value="Envoyer">';
		$body .='</form>'.$theme_close_boite;
		}
	}
	
} elseif (isset($_GET['dossier'])) {  
	if ($_GET['dossier'] == "admin") { 
	header('location:'.$index->targetfile.'=admin');
	}
	if ($_GET['dossier'] == "mes_options") { 
	include ('modules/espace_membre/mes_options.php');
	}
	if ($_GET['dossier'] == "mon_compte") { 
	include ('modules/espace_membre/mon_compte.php');
	}
	if ($_GET['dossier'] == "friends") { 
	include ('modules/espace_membre/friends.php');
	}
	if ($_GET['dossier'] == "changeravatar") { 
	include ('modules/espace_membre/changeravatar.php');
	}
} else {

	if (!isset($_SESSION['pseudo'])) {

		$body .= $theme_open_boite ;
		$body .= '<span>';
		$body .= '<b>';
		$body .= ''.WARNING.'';
		$body .= '</b>';
		$body .= '&nbsp;';
		$body .= ''.MESSAGE_CEM.'';
		$body .= '<form name="form1" method="post" action="'.$index->rootfile.'?login&action=connexion" onsubmi="return verifForm(this);">';
		$body .= '<br><FIELDSET>';
		$body .= '<table width="100%" border="0" cellspacing="0"><tr><td>';
		$body .= (empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/icones/login.png\" alt=\"".TITRE_CEM."\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/login.png\" alt=\"".TITRE_CEM."\" width=\"48\" height=\"48\" \>\n");
		$body .= '</td><td width="100%"><b>'.TITRE_CEM.'</b></td></tr></table>';
		
		
		# assistant de connexion
		$formConnection = new ConnectionWizard ();
		(isset($_GET['connexion']) ? $formConnection->NewConnection (1) : $formConnection->ConnectionDefined ());
		
	
	

		$body .= '</FIELDSET>';
		$body .= '<br><FIELDSET><LEGEND>'.TITRE_OPTIONS_CEM.'</LEGEND><p>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"5\" height=\"7\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"5\" height=\"7\" \>\n").'<a onMouseOver="poplink(\''.INFO_PASSPERDU.'\');" onmouseout="killlink()"  href="'.$index->targetfile.'=espace_membre&action=recuppass">Mot de passe oubli&eacute; ?</a><br>
		'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"5\" height=\"7\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"5\" height=\"7\" \>\n").'<a onMouseOver="poplink(\''.INFO_CCOMPTE.'\');" onmouseout="killlink()"  href="'.$index->targetfile.'=espace_membre&action=inscription">'.NO_LOGIN.'<br><br></a><select name="choixlog"><option value="pseudopass">'.R_PSEUDOPASS.'</option><br><option value="pseudo" selected="selected">'.R_PSEUDO.'</option><br><option value="aucun">'.R_WRONG.'</option><br></select>';
		$body .= '<br><input type="checkbox" name="offline" value="checkbox"> 
Connectez-moi en invisible
</p></FIELDSET></form>';
		$body .= $theme_close_boite ;

	} else {
	
	# Menu espace membre
	$elements->OpenDynamicMenu (ESPACE_MEMBRE);
	
	$elements->ButtonDynamicMenu ('mon_compte.png', 'Mes informations', 'Modifier vos informations personnelles et votre compte', 'espace_membre&dossier=mon_compte', 0);
	$elements->NbspDynamicMenu ();
	
	$elements->ButtonDynamicMenu ('avatar.png', 'Changer d\'image perso.', 'Modifier votre image personnelle', 'espace_membre&dossier=changeravatar', 0);
	$elements->NbspDynamicMenu ();
	
	$elements->ButtonDynamicMenu ('mes_options.png', 'Configuration', 'Modifier vos parametres de navigation', 'espace_membre&dossier=mes_options', 0);
	$elements->NbspDynamicMenu ();
	
	if (recuperer('activer_messagerie_privee') == 'oui') {
	$elements->ButtonDynamicMenu ('messagerie.png', 'Messagerie', 'Envoyez des messages aux autres membres', 'messagerie&dossier=reception', 0);
	$elements->NbspDynamicMenu ();
	}
	
	$elements->ButtonDynamicMenu ('friends.png', 'Ami(e)s', 'G&eacute;rez votre liste d\'ami(e)s', 'espace_membre&dossier=friends', 0);
	$elements->NbspDynamicMenu ();
	
	# Determine le niveau de l'utilisateur en cours
	$db_user = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$utilisateur->idUtilisateur."'");
	$result_user = $db->sql_fetchrow($db_user);

	# Compare le niveau d'utilisateur
	$db_level = $db->sql_query("SELECT * FROM ".$db->prefix_tables."niveaux WHERE numero='".$result_user['grade']."'");
	$result_level = $db->sql_fetchrow($db_level);
	
		# Recherche si une de ces partie est existante pour le niveau de l'utilisateur trouvé
		if (preg_match("/\butilisateurs\b/i", $result_level['valeur']) or preg_match("/\bapparence\b/i", $result_level['valeur'])
		or preg_match("/\bconfiguration\b/i", $result_level['valeur']) or preg_match("/\bcommunication\b/i", $result_level['valeur']) 
		or preg_match("/\bconfig_server\b/i", $result_level['valeur']) or preg_match("/\bupdate\b/i", $result_level['valeur'])) {

		
		
		
		$elements->ButtonDynamicMenu ('admin.png', ADMIN, DEFINE_ADMIN, 'index.php?admin', 1);
		$elements->NbspDynamicMenu ();
		}
		
	if (preg_match("/\bmodules\b/i", $result_level['valeur'])) { 
		$elements->ButtonDynamicMenu ('modules.png', 'Gestion des modules', DEFINE_ADMIN, 'index.php?admin&onglet=modules', 1);
		$elements->NbspDynamicMenu ();
	} 
	
	$elements->ButtonDynamicMenu ('deconnexion.png', SEDECONNECTER, null, $index->rootfile.'?login&action=deconnexion', 1);
	$elements->CloseDynamicMenu ();

	} 
}
?>