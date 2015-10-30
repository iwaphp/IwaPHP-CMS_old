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


# si il existe un poste
if(isset($_POST['autoriser_upload_fichier']) AND isset($_POST['repertoire_envoi_upload']) AND isset($_POST['quota_max_upload']) AND isset($_POST['quota_max_upload_memoiretype']) AND isset($_POST['taille_max_fichier_upload']) AND isset($_POST['taille_max_fichier_upload_memoiretype']) AND isset($_POST['largeur_max_img_joint']) AND isset($_POST['hauteur_max_img_joint']))
{
	# enregistrement des données dans la base de données
	$body .= $operation->UpdateBdd ($_POST['autoriser_upload_fichier'], 'autoriser_upload_fichier', 'options');
	$body .= $operation->UpdateBdd ($_POST['repertoire_envoi_upload'], 'repertoire_envoi_upload', 'options');
	$body .= $operation->UpdateBdd ($_POST['quota_max_upload'], 'quota_max_upload', 'options');
	$body .= $operation->UpdateBdd ($_POST['quota_max_upload_memoiretype'], 'quota_max_upload_memoiretype', 'options');
	$body .= $operation->UpdateBdd ($_POST['taille_max_fichier_upload'], 'taille_max_fichier_upload', 'options');
	$body .= $operation->UpdateBdd ($_POST['taille_max_fichier_upload_memoiretype'], 'taille_max_fichier_upload_memoiretype', 'options');
	$body .= $operation->UpdateBdd ($_POST['largeur_max_img_joint'], 'largeur_max_img_joint', 'options');
	$body .= $operation->UpdateBdd ($_POST['hauteur_max_img_joint'], 'hauteur_max_img_joint', 'options');
	
	# affichage du message de réussite
	$body .= submit_form;

} else {

# sinon on affiche le formulaire avec les valeurs prédéfinies
$body .= $operation->OpenFormPost ('param_upload', 'general', 'Param&egrave;tres uploads');
$body .= $operation->BooleanRadioButton ('Autoriser l\'upload de fichier', 'autoriser_upload_fichier', 'Oui', 'Non');
$body .= $operation->InputText ('R&eacute;pertoire d\'envoi', null, 'repertoire_envoi_upload', null, 1, false);
$body .= $operation->InputText ('Quota maximal', $operation->SelectMemoireType('quota_max_upload'), 'quota_max_upload', '5', 1, false);
$body .= $operation->InputText ('Taille maximale d\'un fichier', $operation->SelectMemoireType('taille_max_fichier_upload'), 'taille_max_fichier_upload', '5', 1, false);
$body .= $operation->InputTextDimensions ('Dimensions maximale des images jointes', 'img_joint', 'max');
$body .= $operation->CloseFormPost ();

}
}}
?>