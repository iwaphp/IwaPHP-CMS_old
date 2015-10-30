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
# initialise la variable "contenu"
$contenu = null;

# si il existe un poste
if(isset($_POST['autoriser_avatars']) AND isset($_POST['autoriser_envoi_avatars']) AND isset($_POST['poid_max_avatar']) AND isset($_POST['poid_max_avatar_memoiretype']) AND isset($_POST['repertoire_stockage_avatars']) AND isset($_POST['largeur_max_avatar']) AND isset($_POST['hauteur_max_avatar']))
{
	# enregistrement des données dans la base de données
	$body .= $operation->UpdateBdd ($_POST['autoriser_avatars'], 'autoriser_avatars', 'options');
	$body .= $operation->UpdateBdd ($_POST['autoriser_envoi_avatars'], 'autoriser_envoi_avatars', 'options');
	$body .= $operation->UpdateBdd ($_POST['poid_max_avatar'], 'poid_max_avatar', 'options');
	$body .= $operation->UpdateBdd ($_POST['poid_max_avatar_memoiretype'], 'poid_max_avatar_memoiretype', 'options');
	$body .= $operation->UpdateBdd ($_POST['repertoire_stockage_avatars'], 'repertoire_stockage_avatars', 'options');
	$body .= $operation->UpdateBdd ($_POST['largeur_max_avatar'], 'largeur_max_avatar', 'options');
	$body .= $operation->UpdateBdd ($_POST['hauteur_max_avatar'], 'hauteur_max_avatar', 'options');
	
	# affichage du message de réussite
	$body .= submit_form;

} else {

# sinon on affiche le formulaire avec les valeurs prédéfinies
$body .= '<form name="param_upload" method="post" action="index.php?admin&op=param_avatar"><fieldset><legend>Paramètres des avatars</legend><table width="100%" id=tableau border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td>Autoriser les avatars :</td>
    <td>';
	
	if(recuperer('autoriser_avatars') == 'oui')
	{
	  $body .= '<input type="radio" name="autoriser_avatars" value="oui" checked>
      Oui<br>
      <input type="radio" name="autoriser_avatars" value="non"> 
      Non';
	} else {
	  $body .= '<input type="radio" name="autoriser_avatars" value="oui">
      Oui<br>
      <input type="radio" name="autoriser_avatars" value="non" checked> 
      Non';
	}
	  
	  $body .= '</td>
  </tr>
  <tr>
    <td>Autoriser l\'envoi d\'avatars  : </td>
    <td>';
	
	if(recuperer('autoriser_envoi_avatars') == 'oui')
	{
	  $body .= '<input type="radio" name="autoriser_envoi_avatars" value="oui" checked>
      Oui<br>
      <input type="radio" name="autoriser_envoi_avatars" value="non">
      Non';
	 } else {
	  $body .= '<input type="radio" name="autoriser_envoi_avatars" value="oui">
      Oui<br>
      <input type="radio" name="autoriser_envoi_avatars" value="non" checked>
      Non';
	 }
	  
	  $body .= '</td>
  </tr>
  <tr>
    <td>Poids maximum d\'un avatar : </td>
    <td><input name="poid_max_avatar" value="'.recuperer('poid_max_avatar').'" type="text" size="5">
      <select name="poid_max_avatar_memoiretype">';
	if (recuperer('poid_max_avatar_memoiretype') == 'ko')
	{
		$body .= '<option value="ko" selected>Ko</option>
        <option value="mo">Mo</option>
        <option value="go">Go</option>';
	}
	elseif (recuperer('poid_max_avatar_memoiretype') == 'mo')
	{
		$body .= '<option value="ko">Ko</option>
        <option value="mo" selected>Mo</option>
        <option value="go">Go</option>';
	}
	elseif (recuperer('poid_max_avatar_memoiretype') == 'go')
	{
		$body .= '<option value="ko">Ko</option>
        <option value="mo">Mo</option>
        <option value="go" selected>Go</option>';
	}
	  
      $body .= '</select></td>
  </tr>
  <tr>
    <td>R&eacute;pertoire de stockage des avatars : </td>
    <td><input type="text" name="repertoire_stockage_avatars" value="'.recuperer('repertoire_stockage_avatars').'"></td>
  </tr>
  <tr>
    <td>Dimensions maximale d\'un avatar : </td>
    <td><input name="largeur_max_avatar" value="'.recuperer('largeur_max_avatar').'" type="text" size="5">
      x
      <input name="hauteur_max_avatar" value="'.recuperer('hauteur_max_avatar').'" type="text" size="5"> 
      px </td>
  </tr>
</table></fieldset><br>
<fieldset><legend>Actions</legend>
<div align="center">
  <input type="submit" name="Submit" value="Envoyer">
  <input type="reset" name="Submit" value="R&eacute;initialiser">
</div>
</fieldset>';
}
}}
?>