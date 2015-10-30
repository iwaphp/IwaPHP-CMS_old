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

if (isset($_POST['activer_confirm_visuelle_inscription']))
{

$body .= $operation->UpdateBdd ($_POST['activer_confirm_visuelle_inscription'], 'activer_confirm_visuelle_inscription', 'options');

$body .= submit_form;

} else {

$body .= $operation->OpenFormPost ('param_visualconfirm', 'general', 'Param&egrave;tres de confirmation visuelle');
$body .= $operation->BooleanRadioButton ('Activer la confirmation visuelle &agrave; l\'inscription', 'activer_confirm_visuelle_inscription', 'Oui', 'Non');
$body .= $operation->CloseFormPost ();

}
}}
?>