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

if (isset($_POST['activation_compte']) AND isset($_POST['long_max_nom_utilisateur']) AND isset($_POST['long_min_nom_utilisateur']) AND isset($_POST['interdire_caractere_nom_utilisateur']) AND isset($_POST['complexite_mdp']) AND isset($_POST['long_min_mdp']) AND isset($_POST['changer_pseudo']) AND isset($_POST['autoriser_modifier_email']) AND isset($_POST['autoriser_enregistrement_email_multi']))
{

$body .= $operation->UpdateBdd ($_POST['activation_compte'], 'activation_compte', 'options');
$body .= $operation->UpdateBdd ($_POST['long_max_nom_utilisateur'], 'long_max_nom_utilisateur', 'options');
$body .= $operation->UpdateBdd ($_POST['long_min_nom_utilisateur'], 'long_min_nom_utilisateur', 'options');
$body .= $operation->UpdateBdd ($_POST['interdire_caractere_nom_utilisateur'], 'interdire_caractere_nom_utilisateur', 'options');
$body .= $operation->UpdateBdd ($_POST['complexite_mdp'], 'complexite_mdp', 'options');
$body .= $operation->UpdateBdd ($_POST['long_min_mdp'], 'long_min_mdp', 'options');
$body .= $operation->UpdateBdd ($_POST['autoriser_enregistrement_email_multi'], 'autoriser_enregistrement_email_multi', 'options');

$body .= submit_form;

} else {

$body .= $operation->OpenFormPost ('param_inscription', 'general', 'Param&egrave;tres des inscriptions');
$body .= '
  <tr>
    <td>Activation du compte par : </td>
    <td>';
	if (recuperer('activation_compte') == 'rien')	
	{
	  $body .= '<input type="radio" name="activation_compte" value="rien" checked>
      Rien<br>
      <input type="radio" name="activation_compte" value="email">
      E-mail<br>
      <input type="radio" name="activation_compte" value="admin">
      Administrateur';
	} elseif (recuperer('activation_compte') == 'email')	
	{
	  $body .= '<input type="radio" name="activation_compte" value="rien">
      Rien<br>
      <input type="radio" name="activation_compte" value="email" checked>
      E-mail<br>
      <input type="radio" name="activation_compte" value="admin">
      Administrateur';
	} elseif (recuperer('activation_compte') == 'admin')	
	{
	  $body .= '<input type="radio" name="activation_compte" value="rien">
      Rien<br>
      <input type="radio" name="activation_compte" value="email">
      E-mail<br>
      <input type="radio" name="activation_compte" value="admin" checked>
      Administrateur 
	  </td>
	  </tr>';
	}
$body .= $operation->InputText ('Longueur maximum du nom d\'utilisateur', 'caract&egrave;res', 'long_max_nom_utilisateur', '5', 1, false);
$body .= $operation->InputText ('Longueur minimum du nom d\'utilisateur', 'caract&egrave;res', 'long_min_nom_utilisateur', '5', 1, false);	 
$body .= $operation->TextArea ('Interdire les caract&egrave;res suivants', 'interdire_caractere_nom_utilisateur', '20', null, 1);
$body .= '<tr>
    <td>Complexit&eacute; du mot de passe : </td>
    <td>';
	
	if (recuperer('complexite_mdp') == 'non')
	{
	$body .= '<select name="complexite_mdp">
      <option value="non" selected="selected">Pas de complexit&eacute;</option>
      <option value="oui">Doit contenir des chiffres et des lettres</option>
    </select>';
	} elseif (recuperer('complexite_mdp') == 'oui')
	{
	$body .= '<select name="complexite_mdp">
      <option value="non">Pas de complexit&eacute;</option>
      <option value="oui" selected="selected">Doit contenir des chiffres et des lettres</option>
    </select>';
	}
	
$body .= '</td>
  </tr>';
$body .= $operation->InputText ('Nombre de caract&egrave;res minimum du mot de passe', 'caract&egrave;res', 'long_min_mdp', '5', 1, false);
$body .= $operation->BooleanRadioButton ('Autoriser l\'enregistrement sous la m&ecirc;me adresse e-mail', 'autoriser_enregistrement_email_multi', 'Oui', 'Non');
$body .= $operation->CloseFormPost ();

}
}}
?>