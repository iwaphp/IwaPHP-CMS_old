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

if (isset($_POST['activer_messagerie_privee']) AND isset($_POST['nbr_msg_privee_max_dossier']) AND isset($_POST['autoriser_bbcodes']) AND isset($_POST['autoriser_smileys']))
{

$body .= $operation->UpdateBdd ($_POST['activer_messagerie_privee'], 'activer_messagerie_privee', 'options');
$body .= $operation->UpdateBdd ($_POST['nbr_msg_privee_max_dossier'], 'nbr_msg_privee_max_dossier', 'options');
$body .= $operation->UpdateBdd ($_POST['autoriser_bbcodes'], 'autoriser_bbcodes', 'options');
$body .= $operation->UpdateBdd ($_POST['autoriser_smileys'], 'autoriser_smileys', 'options');


$body .=  submit_form;

} else {

$body .= $operation->OpenFormPost ('messagerie', 'general', 'Messagerie interne');
$body .= $operation->BooleanRadioButton ('Activer la messagerie priv&eacute;e', 'activer_messagerie_privee', 'Activer', 'D&eacute;sactiver');
$body .= $operation->InputText ('Nombre de messages priv&eacute;e par page', null, 'nbr_msg_privee_max_dossier', '3', 1, false);
$body .= $operation->BooleanRadioButton ('Autoriser la mise en forme', 'autoriser_bbcodes', 'Oui', 'Non');
$body .= $operation->BooleanRadioButton ('Autoriser les smileys', 'autoriser_smileys', 'Oui', 'Non');

$body .= $operation->CloseFormPost ();
}
}}
?>