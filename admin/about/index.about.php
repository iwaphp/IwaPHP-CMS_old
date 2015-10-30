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
		if (preg_match("/\bconfiguration\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >

$body .= $theme_open_boite;



	
	
	
$body .= '<h1 style="color: #ff0000;"><img src="admin/images/logo-admin.png" alt="" width="234" height="108" /><br /><span style="color: #000000;">IwaPHP Content Management System</span></h1>
<p>Cr&eacute;e par <strong>Damien GALICHER</strong> sous <a rel="license" href="http://creativecommons.org/licenses/by-nd/3.0/fr/">Licence Creative Commons 3.0</a>.<br /><br />IwaPHP est un syst&egrave;me de gestion de contenu programm&eacute; en PHP MySQL open source libre d\'utilisation.<br />Il permet &agrave; ses utilisateurs de cr&eacute;er un site web sans connaissances approfondies du langage de programmation.</p>
<p><img src="logo.png" alt="" width="130" height="37" /><br />IwaPHP et d&eacute;velopp&eacute; par ses utilisateurs d&eacute;butant ou confirm&eacute;s.<br /><br />Si vous souhaitez participer au d&eacute;veloppement de IwaPHP rendez-vous sur la page du site <a href="http://www.iwaphp.fr/" target="_blank">http://www.iwaphp.fr/</a></p>';
	
	
$body .= $theme_close_boite;
	
	
	
}}
 
?>