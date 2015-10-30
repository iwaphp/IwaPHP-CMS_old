<?php
# IwaPHP CMS - Système de gestion de contenu 

	
//info ajout menu
$menu_dyn_name = ESPACE_MEMBRE;
$menu_dyn_description = 'Ce menu permet de se connecter au site et à accéder à ses options rapidement.';
$exImg = 'jpg';


if (!isset($_SESSION['pseudo'])) {
$boite_espace_membre = '<form method="post" action="index.php?login&action=connexion">';

$boite_espace_membre .= '<table width="100%" border="0">
  <tr>
    <td valign="top">
<a href="'.$index->targetfile.'=espace_membre"><center>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/login.png\" alt=\"\" border=\"0\" width=\"32\" height=\"32\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/login.png\" alt=\"\" border=\"0\" width=\"90\" height=\"90\" \>\n").'</a>'.BIENVENUE.', <b>'.ANONYMOUS.'</b></a></td>
    <td valign="top"><strong>Identifiant</strong><br>';
$boite_espace_membre .= '<input onMouseOver="poplink(\''.INFO_ID.'\');" onmouseout="killlink()" name="pseudo" type="text" size="12" value="';
if (isset($_COOKIE['pseudo'])) { 
$boite_espace_membre .= $_COOKIE['pseudo'];
} 
$boite_espace_membre .= '"><br>';
$boite_espace_membre .= '<strong>'.MDP.'</strong><br><input onMouseOver="poplink(\''.INFO_PASS.'\');" onmouseout="killlink()" name="password" type="password" size="12" value="';
if (isset($_COOKIE['pass'])) { 
$boite_espace_membre .= $_COOKIE['pass']; 
} 
$boite_espace_membre .= '" /><br><br><input type="submit" name="Submit" value="'.CONNEXION.'" onClick="this.form.submit();this.disabled=true;this.value=\''.ONCLICK_SUBMIT_CONNECT.'\'"><br><br>'.MESSAGE_CEMMINI.'</center></td>
  </tr>
</table></form>';
} else {
$pseudo_membre = $_SESSION['pseudo'];
$requete = mysql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE `pseudo`='$pseudo_membre'"); 
$result = mysql_fetch_array ($requete);
$id = $result['id'];
$pseudo = $result['pseudo'];
$grade = $result['grade'];
$urlavatar = $result['avatar'];
$boite_espace_membre = '<center>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer("theme")."/images/icones/user.png\" alt=\"\" width=\"16\" height=\"16\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/user.png\" alt=\"\" width=\"16\" height=\"16\" \>\n").BIENVENUE.', <b>'.$_SESSION['pseudo'].'</b><br>';

$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."statut WHERE id_='".$utilisateur->idUtilisateur."'");
		$result = $db->sql_fetchrow($data);
		
		if ($result['statut'] == 'online') {
			$boite_espace_membre .='Statut : <a href="'.$index->targetfile.'=espace_membre&dossier=mes_options" class="titre_link_statut"><img border=0 src="modules/espace_membre/online.png" width="17" height="17"> Disponible &#9660;</a></center><hr><div align="center">';
		}
		elseif ($result['statut'] == 'busy') {
			$boite_espace_membre .='Statut : <a href="'.$index->targetfile.'=espace_membre&dossier=mes_options" class="titre_link_statut"><img border=0 src="modules/espace_membre/busy.png" width="17" height="17"> Occup&eacute;(e) &#9660;</a></center><hr><div align="center">';
		}
		elseif ($result['statut'] == 'off') {
		
			$boite_espace_membre .='Statut : <a href="'.$index->targetfile.'=espace_membre&dossier=mes_options" class="titre_link_statut"><img border=0 src="modules/espace_membre/away.png" width="17" height="17"> Absent(e) &#9660;</a></center><hr><div align="center">';

		}
		elseif ($result['statut'] == 'hidden') {
			$boite_espace_membre .='Statut : <a href="'.$index->targetfile.'=espace_membre&dossier=mes_options" class="titre_link_statut"><img border=0 src="modules/espace_membre/offline.png" width="17" height="17"> Hors ligne/Invisible &#9660;</a></center><hr><div align="center">';

		} else {
$boite_espace_membre .='Statut : <a href="'.$index->targetfile.'=espace_membre&dossier=mes_options" class="titre_link_statut"><img border=0 src="modules/espace_membre/online.png" width="17" height="17"> Disponible &#9660;</a></center><hr><div align="center">';
	
		}

if (!empty($urlavatar)) { $boite_espace_membre .='<a onMouseOver="poplink(\''.INFAVA.'\');" onmouseout="killlink()" href="'.$index->targetfile.'=espace_membre&dossier=changeravatar"><img src="'.$urlavatar.'" border="0"  width="'.recuperer("hauteur_max_avatar").'" height="'.recuperer("largeur_max_avatar").'" alt=""></a><br>'; } else { 
$boite_espace_membre .='<a onMouseOver="poplink(\''.addslashes(INF_AJOUT_AVA).'\');" onmouseout="killlink()" href="'.$index->targetfile.'=espace_membre&dossier=changeravatar"><img src="images/noavatar.png" border="0" alt=""></a><br>';
}

$boite_espace_membre .= '<br></div><hr>
'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.png\" alt=\"\" \>\n").' <a onMouseOver="poplink(\''.MODIF_PROFIL.'\');" onmouseout="killlink()" href="'.$index->targetfile.'=espace_membre&dossier=mon_compte">Mes informations</a> 
<br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.png\" alt=\"\" \>\n").' <a onMouseOver="poplink(\''.MODIF_PROFIL.'\');" onmouseout="killlink()" href="'.$index->targetfile.'=espace_membre&dossier=changeravatar">Changer d\'image perso.</a>
<br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.png\" alt=\"\" \>\n").' <a onMouseOver="poplink(\''.CHANGE_AVA.'\');" onmouseout="killlink()" href="'.$index->targetfile.'=espace_membre&dossier=mes_options">Configuration</a>
<br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.png\" alt=\"\" \>\n").' <a onMouseOver="poplink(\''.CHANGE_AVA.'\');" onmouseout="killlink()" href="'.$index->targetfile.'=memberlist&profil='.$utilisateur->idUtilisateur.'">Mon profil</a>';

$data4 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."friends WHERE id_ami='".$utilisateur->idUtilisateur."' AND pseudo_ami='".$utilisateur->nomUtilisateur."' AND accept='0'");
$result4 = mysql_num_rows($data4);		
$boite_espace_membre .= '<br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.png\" alt=\"\" \>\n").(empty($result4) ? '<a onMouseOver="poplink(\''.CHANGE_AVA.'\');" onmouseout="killlink()" href="'.$index->targetfile.'=espace_membre&dossier=friends">Ami(e)s</a>' : '<strong><a onMouseOver="poplink(\''.CHANGE_AVA.'\');" onmouseout="killlink()" href="'.$index->targetfile.'=espace_membre&dossier=friends">Ami(e)s ('.$result4.')</a></strong>');
if (recuperer('activer_messagerie_privee') == 'oui') {
$boite_espace_membre .= '<br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.png\" alt=\"\" \>\n");
$data = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."mp WHERE lu='1' and id_receveur='".$utilisateur->idUtilisateur."'");
$result = $db->sql_fetchrow($data);
$poplink_messagerie = ($result['nbre_entrees'] == 0 ? 'Aucun messages' : 'Vous avez '.$result['nbre_entrees'].' nouveau(x) message(s)');

$boite_espace_membre .= "<A onMouseOver=\"poplink('".$poplink_messagerie."');\" onmouseout=\"killlink()\" href='".$index->targetfile."=messagerie&dossier=reception'>";
$boite_espace_membre .= ($result['nbre_entrees'] == 0 ? 'Messagerie' : '<b>Messagerie ('.$result['nbre_entrees'].')</b>');
$boite_espace_membre .= "</A>";
}

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

		
			$boite_espace_membre .='<br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.png\" alt=\"\" \>\n").' <a onMouseOver="poplink(\''.CHANG_SIGNATURE.'\');" onmouseout="killlink()" href="index.php?admin">Administration</a>';
		}

$boite_espace_membre .='<hr>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.png\" alt=\"\" \>\n").' <a onMouseOver="poplink(\''. addslashes(INF_GOEM) .'\');" onmouseout="killlink()" href="'.$index->targetfile.'=espace_membre">Espace Membre</a>';


$boite_espace_membre .= '<br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.png\" alt=\"\" \>\n").' <a onMouseOver="poplink(\''.DECONNEXION.'\');" onmouseout="killlink()" href="index.php?login&action=deconnexion">'.DECONNEXION.'</a>';
}



$contenu = $theme_open_boite_titre ;
$contenu .= ''.ESPACE_MEMBRE.'';
$contenu .= $theme_close_boite_titre ;
$contenu .= $boite_espace_membre ;
$contenu .= $theme_close_boite ;
?>