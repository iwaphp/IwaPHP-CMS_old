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
$body .= '<fieldset><legend>Param&egrave;tres du serveur</legend><table width="100%" id=tableau border="0" cellspacing="2" cellpadding="0">
     
  <tr>
    <td>Emplacement des avatars : </td>
    <td><input type="text" name="textfield"></td>
  </tr>
 
  <tr>
    <td>Emplacement du r&eacute;pertoire de mises &agrave; jour : </td>
    <td><input type="text" name="textfield"></td>
  </tr>
  
  <tr>
    <td>Emplacement du r&eacute;pertoire temporaire : </td>
    <td><input type="text" name="textfield"></td>
  </tr>
</table></fieldset><br>
<fieldset><legend>Actions</legend>
<div align="center">
  <input type="submit" name="Submit" value="Envoyer">
  <input type="reset" name="Submit" value="R&eacute;initialiser">
</div></fieldset>';
}}
?>