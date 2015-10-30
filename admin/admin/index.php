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
		if (preg_match("/\butilisateurs\b/i", $result_level['valeur']) or preg_match("/\bapparence\b/i", $result_level['valeur'])
		or preg_match("/\bconfiguration\b/i", $result_level['valeur']) or preg_match("/\bcommunication\b/i", $result_level['valeur']) 
		or preg_match("/\bconfig_server\b/i", $result_level['valeur']) or preg_match("/\bupdate\b/i", $result_level['valeur'])
		or preg_match("/\bmodules\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >

$data = $db->sql_query("SELECT COUNT(*) FROM ".$db->prefix_tables."membre");
$result = $db->sql_fetchrow($data);
$data2 = $db->sql_query("SELECT COUNT(*) FROM ".$db->prefix_tables."module WHERE statut='install'");
$result2 = $db->sql_fetchrow($data2);

$body .=  '<fieldset><legend>Tableau de bord</legend>
<img src="admin/images/logo-banniere.png" border="0" />
<h2>Informations serveur</h2>
<strong>Version de IwaPHP : </strong>Version '.VERSION.' HAWK <strong>R&eacute;vision :</strong> <i>'.NO_CORRECTIF.'</i> ( <a href="index.php?admin&onglet=updater&verifier">V&eacute;rifier les mises &agrave; jour</a> )<br /><br />
<strong>Nom du serveur :</strong> '.$_SERVER['SERVER_NAME'].'<br />
<strong>Administrateur du serveur :</strong> '.$_SERVER['SERVER_ADMIN'].'<br />
<strong>Version du serveur :</strong> '.$_SERVER['SERVER_SIGNATURE'].'<br /><br />
<strong>Racine du site :</strong> '.$_SERVER['DOCUMENT_ROOT'].'<br />
'.$_ENV["HOSTNAME"].'<br />
'.$_ENV["COMPUTERNAME"].'
<h2>Informations site</h2>
<strong>Nom du site :</strong> '.recuperer('nom_site').'<br />
<strong>Adresse du script :</strong> '.recuperer('url_script').'<br />
<strong>Adresse du site :</strong> '.recuperer('url_site').'<br />
<br />
<strong>Module à afficher au d&eacute;marrage :</strong> '.recuperer('module_demarrage').' ( <a href="index.php?admin&op=fonctions">Changer</a> )<br />
<strong>Langue du site :</strong> '.recuperer('lang_general').' ( <a href="index.php?admin&op=fonctions">Changer</a> )<br />
</fieldset>';
}}
?>