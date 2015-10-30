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

if (isset($_POST['autoriser_signatures']) AND isset($_POST['autoriser_bbcodes_signatures']) AND isset($_POST['nbr_max_img_signature']) AND isset($_POST['largeur_max_img_signature']) AND isset($_POST['hauteur_max_img_signature']) AND isset($_POST['autoriser_liens_signatures']) AND isset($_POST['autoriser_img_signatures']) AND isset($_POST['autoriser_smileys_signatures']))
{

$body .= $operation->UpdateBdd ($_POST['autoriser_signatures'], 'autoriser_signatures', 'options');
$body .= $operation->UpdateBdd ($_POST['autoriser_bbcodes_signatures'], 'autoriser_bbcodes_signatures', 'options');
$body .= $operation->UpdateBdd ($_POST['nbr_max_img_signature'], 'nbr_max_img_signature', 'options');
$body .= $operation->UpdateBdd ($_POST['largeur_max_img_signature'], 'largeur_max_img_signature', 'options');
$body .= $operation->UpdateBdd ($_POST['hauteur_max_img_signature'], 'hauteur_max_img_signature', 'options');
$body .= $operation->UpdateBdd ($_POST['autoriser_liens_signatures'], 'autoriser_liens_signatures', 'options');
$body .= $operation->UpdateBdd ($_POST['autoriser_img_signatures'], 'autoriser_img_signatures', 'options');
$body .= $operation->UpdateBdd ($_POST['autoriser_smileys_signatures'], 'autoriser_smileys_signatures', 'options');
$body .=  submit_form;

} else {

$body .= $operation->OpenFormPost ('param_sign', 'general', 'Param&egrave;tres des signatures');
$body .= $operation->BooleanRadioButton ('Autoriser les signatures', 'autoriser_signatures', 'Oui', 'Non');
$body .= $operation->BooleanRadioButton ('Autoriser la mise en forme dans les signatures', 'autoriser_bbcodes_signatures', 'Oui', 'Non');
$body .= $operation->InputText ('Nombre maximale d\'images dans une signature', null, 'nbr_max_img_signature', '10', 1, false);
$body .= $operation->InputTextDimensions ('Taille maximale d\'une image dans la signature', 'img_signature', 'max');
$body .= $operation->BooleanRadioButton ('Autoriser les liens', 'autoriser_liens_signatures', 'Oui', 'Non');
$body .= $operation->BooleanRadioButton ('Autoriser les images', 'autoriser_img_signatures', 'Oui', 'Non');
$body .= $operation->BooleanRadioButton ('Autoriser les smileys', 'autoriser_smileys_signatures', 'Oui', 'Non');
$body .= $operation->CloseFormPost ();

}

}}
?>