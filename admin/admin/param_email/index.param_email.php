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
		if (preg_match("/\bcommunication\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >

$contenu = null;

if (isset($_POST['email_admin']) AND isset($_POST['nom_expediteur']) AND isset($_POST['fonction_envoi_mail']))
{

$body .= $operation->UpdateBdd ($_POST['email_admin'], 'email_admin', 'options');
$body .= $operation->UpdateBdd ($_POST['nom_expediteur'], 'nom_expediteur', 'options');
$body .= $operation->UpdateBdd ($_POST['fonction_envoi_mail'], 'fonction_envoi_mail', 'options');

$body .= submit_form;

} else {

$body .= $operation->OpenFormPost ('param_email', 'general', 'Param&egrave;tres des e-mail');
$body .= $operation->InputText ('Adresse e-mail de l\'administrateur', null, 'email_admin', null, 1, false);
$body .= $operation->InputText ('Nom de l\'exp&eacute;diteur', null, 'nom_expediteur', null, 1, false);
$body .= $operation->InputText ('Fonction d\'envoi des e-mail', null, 'fonction_envoi_mail', null, 1, false);
$body .= $operation->CloseFormPost ();

}
}}
?>