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
$contenu = null;

if (isset($_POST['autoriser_surveillance_reponses']) AND isset($_POST['autoriser_liens_msg'])  AND isset($_POST['confirmation_visuelle_visiteurs']) AND isset($_POST['largeur_max_img_msg']) AND isset($_POST['hauteur_max_img_msg']) AND isset($_POST['autoriser_bbcodes_msg']) AND isset($_POST['autoriser_smileys_msg']) AND isset($_POST['autoriser_fichiers_joints_msg']))
{
	$body .= $operation->UpdateBdd ($_POST['autoriser_surveillance_reponses'], 'autoriser_surveillance_reponses', 'autoriser_surveillance_reponses');
	$body .= $operation->UpdateBdd ($_POST['autoriser_liens_msg'], 'autoriser_liens_msg', 'autoriser_liens_msg');
	$body .= $operation->UpdateBdd ($_POST['confirmation_visuelle_visiteurs'], 'confirmation_visuelle_visiteurs', 'confirmation_visuelle_visiteurs');
	$body .= $operation->UpdateBdd ($_POST['largeur_max_img_msg'], 'largeur_max_img_msg', 'largeur_max_img_msg');
	$body .= $operation->UpdateBdd ($_POST['hauteur_max_img_msg'], 'hauteur_max_img_msg', 'hauteur_max_img_msg');
	$body .= $operation->UpdateBdd ($_POST['autoriser_bbcodes_msg'], 'autoriser_bbcodes_msg', 'autoriser_bbcodes_msg');
	$body .= $operation->UpdateBdd ($_POST['autoriser_smileys_msg'], 'autoriser_smileys_msg', 'autoriser_smileys_msg');
	
	$body .= submit_form;
} else {
$body .= '<form name="form1" method="post" action="'.$index->targetfile.'=admin&onglet=general&admin=param_msg"><fieldset><legend>Param&egrave;tres des messages</legend><table width="100%" id=tableau border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td>Autoriser la surveillance de r&eacute;ponses  : </td>
    <td>';
	
	if (recuperer('autoriser_surveillance_reponses') == 'oui')
	{
		$body .= '<input type="radio" name="autoriser_surveillance_reponses" value="oui" checked>
      Oui<br>
      <input type="radio" name="autoriser_surveillance_reponses" value="non">
      Non';
	} else {
		$body .= '<input type="radio" name="autoriser_surveillance_reponses" value="oui">
      Oui<br>
      <input type="radio" name="autoriser_surveillance_reponses" value="non" checked>
      Non';
	}

$body .= '</td>
  </tr>
  <tr>
    <td>Autoriser les liens dans les messages  :</td>
    <td>';
	
	if (recuperer('autoriser_liens_msg') == 'oui')
	{
		$body .= '<input type="radio" name="autoriser_liens_msg" value="oui" checked>
      Oui<br>
      <input type="radio" name="autoriser_liens_msg" value="non">
      Non';
	} else {
		$body .= '<input type="radio" name="autoriser_liens_msg" value="oui">
      Oui<br>
      <input type="radio" name="autoriser_liens_msg" value="non" checked>
      Non';
	}

$body .= '</td>
  </tr>
  <tr>
    <td>Confirmation visuelle pour les visiteurs : </td>
    <td>';
	
	if (recuperer('confirmation_visuelle_visiteurs') == 'oui')
	{
		$body .= '<input type="radio" name="confirmation_visuelle_visiteurs" value="oui" checked>
      Oui<br>
      <input type="radio" name="confirmation_visuelle_visiteurs" value="non">
      Non';
	} else {
		$body .= '<input type="radio" name="confirmation_visuelle_visiteurs" value="oui">
      Oui<br>
      <input type="radio" name="confirmation_visuelle_visiteurs" value="non" checked>
      Non';
	}

$body .= '</td>
  </tr>
  <tr>
    <td>Taille maximale d\'une image : </td>
    <td><input name="largeur_max_img_msg" value="'.recuperer('largeur_max_img_msg').'" type="text" size="5">
      x
      <input name="hauteur_max_img_msg" value="'.recuperer('hauteur_max_img_msg').'" type="text" size="5">
      px</td>
  </tr>
  <tr>
    <td>Autoriser la mise en forme : </td>
    <td>';
	
	if (recuperer('autoriser_bbcodes_msg') == 'oui')
	{
		$body .= '<input type="radio" name="autoriser_bbcodes_msg" value="oui" checked>
      Oui<br>
      <input type="radio" name="autoriser_bbcodes_msg" value="non">
      Non';
	} else {
		$body .= '<input type="radio" name="autoriser_bbcodes_msg" value="oui">
      Oui<br>
      <input type="radio" name="autoriser_bbcodes_msg" value="non" checked>
      Non';
	}

$body .= '</td>
  </tr>
  <tr>
    <td>Autoriser les smileys : </td>
    <td>';
	
	if (recuperer('autoriser_smileys_msg') == 'oui')
	{
		$body .= '<input type="radio" name="autoriser_smileys_msg" value="oui" checked>
      Oui<br>
      <input type="radio" name="autoriser_smileys_msg" value="non">
      Non';
	} else {
		$body .= '<input type="radio" name="autoriser_smileys_msg" value="oui">
      Oui<br>
      <input type="radio" name="autoriser_smileys_msg" value="non" checked>
      Non';
	}

$body .= '</td>
  </tr>
  
</table></fieldset>
<br>
<fieldset><legend>Actions</legend>
<div align="center">
  <input type="submit" name="Submit" value="Envoyer">
  <input type="reset" name="Submit" value="R&eacute;initialiser">
</div></fieldset></form>
';
}
}}
?>