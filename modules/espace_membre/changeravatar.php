<?php
# IwaPHP CMS - Système de gestion de contenu 

if(recuperer("autoriser_avatars") == 'non') { $body .= $theme_open_boite.'Les avatars ne sont pas autoris&eacute; sur ce site.'.$theme_close_boite; } else {
if (!isset($_SESSION['pseudo'])) { $body .= erreur ; } else {	

if( isset($_FILES['fichier']['tmp_name']) ) // si formulaire soumis
{
	$dossier = recuperer("repertoire_stockage_avatars");
	$fichier = basename($_FILES['fichier']['name']);
	if (recuperer("quota_max_upload_memoiretype") == 'Ko') {
	define('taille_maxi', recuperer("quota_max_upload") / 1000);
	} elseif (recuperer("quota_max_upload_memoiretype") == 'Mo') {
	define('taille_maxi', recuperer("quota_max_upload") / 1000000);
	} elseif (recuperer("quota_max_upload_memoiretype") == 'Go') {
	define('taille_maxi', recuperer("quota_max_upload") / 1000000000);
	}
	$taille = filesize($_FILES['fichier']['tmp_name']);

	$extensions = array('.png', '.gif', '.jpg', '.jpeg', '.PNG', '.GIF', '.JPG', '.JPEG');
	$extension = strrchr($_FILES['fichier']['name'], '.'); 
	//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
		$erreur = UP_ERROR_TYPE;
		}
		elseif($taille>taille_maxi)
		{
		$erreur = UP_ERROR_POIDS;
		}
		
		if(!empty($erreur)) //S'il n'y a pas d'erreur, on upload
		{
		//On formate le nom du fichier ici...
		$fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
			if(move_uploaded_file ($_FILES['fichier']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			{
			$body .= $theme_open_boite_titre;
			$body .= ''.CHANGE_AVATAR.'';
			$body .= $theme_close_boite_titre;	
			$body .= UPLOAD_OK;
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET avatar='" . $dossier . $fichier . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
			$body .= "<SCRIPT LANGUAGE='JavaScript'>\n";
			$body .= "<!--\n";
			$body .= "function redirect() \n";
			$body .= "{\n";
			$body .= "window.location='javascript:history.go(-1);' \n";
			$body .= "}\n";
			$body .= "setTimeout('redirect()',1000); \n";
			$body .= "-->\n";
			$body .= "</SCRIPT>\n";
			$body .= $theme_close_boite;	
			}
			else //Sinon (la fonction renvoie FALSE).
			{
			$body .= $theme_open_boite_titre;
			$body .= ''.CHANGE_AVATAR.'';
			$body .= $theme_close_boite_titre;	
			$body .= UPLOAD_ERROR;
			$body .= "<SCRIPT LANGUAGE='JavaScript'>\n";
			$body .= "<!--\n";
			$body .= "function redirect() \n";
			$body .= "{\n";
			$body .= "window.location='javascript:history.go(-1);' \n";
			$body .= "}\n";
			$body .= "setTimeout('redirect()',1000); \n";
			$body .= "-->\n";
			$body .= "</SCRIPT>\n";	
			$body .= $theme_close_boite;				
			}
		}
		else
		{	
		$body .= $theme_open_boite_titre;
		$body .= ''.CHANGE_AVATAR.'';
		$body .= $theme_close_boite_titre;		
		$body .= $erreur;
		$body .= $theme_close_boite;	
		}

} elseif (isset($_POST['urlavatar'])) 
{
$urlavatar = htmlentities($_POST['urlavatar']);

	$body .= $theme_open_boite_titre;
	$body .= ''.CHANGE_AVATAR.'';
	$body .= $theme_close_boite_titre;
    $body .= (empty($urlavatar) ? "Avatar supprimé" : "L'avatar à bien été changé, il sera affiché à partir de <b>".$urlavatar."</b>");
	$body .= "<SCRIPT LANGUAGE='JavaScript'>\n";
	$body .= "<!--\n";
	$body .= "function redirect() \n";
	$body .= "{\n";
	$body .= "window.location='javascript:history.go(-1);' \n";
	$body .= "}\n";
	$body .= "setTimeout('redirect()',1000); \n";
	$body .= "-->\n";
	$body .= "</SCRIPT>\n";	
	$body .= $theme_close_boite;	
	
$db->sql_query("UPDATE ".$db->prefix_tables."membre SET avatar='" . $urlavatar . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
} else {
$body .= $theme_open_boite_titre;
$body .= ''.CHANGE_AVATAR.'';
$body .= $theme_close_boite_titre;
$body .='<form action="'.$index->targetfile.'=espace_membre&dossier=changeravatar" method="post" id="formulaire" enctype="multipart/form-data">';

$body .='<table border="0" align="center" cellspacing="0">';
$body .='<tr>';
$body .='<td width="35%">';


$body .='<FIELDSET>';
$body .='<LEGEND>'.VOTRE_AVA_ACTUEL.' : </LEGEND>';
$body .= (!empty($utilisateur->avatarUtilisateur) ? '<img src="'.$utilisateur->avatarUtilisateur.'" border="0" width="'.recuperer("hauteur_max_avatar").'" height="'.recuperer("largeur_max_avatar").'" alt="'.VOTRE_AVA_ACTUEL.'">' : '<img src="images/noavatar.png" border="0" alt="">');
$body .='</FIELDSET>';
$body .='<br><FIELDSET>';
$body .='<LEGEND>'.MODIFIER_AVA.' : </LEGEND>';

if (recuperer("autoriser_envoi_avatars") == "oui") {
$body .= '<ul id="maintab" class="shadetabs">
<li class="selected"><a href="#default" rel="ajaxcontentarea">'.AVA_EXT.'</a></li>
'.(recuperer("autoriser_upload_fichier") == 'non' ? null : '<li><a href="modules/espace_membre/upavatar.php" rel="ajaxcontentarea">'.AVA_UP.'</a></li>').'
</ul>';

$body .='<div id="ajaxcontentarea" class="contentstyle">
<p>'.PHRASE_INFO_AVA.'<br>Laissez ce champ vide pour supprimer l\'avatar<br><input type="text" name="urlavatar" value="'.$utilisateur->avatarUtilisateur.'" /></p>
</div>

<script type="text/javascript">
startajaxtabs("maintab")
</script>';
} else {
$body .='Envoi d\'avatars d&eacute;sactiv&eacute;';
}

$body .='</FIELDSET>';
$body .='</td>';
$body .='</tr>';

$body .='</table>';
$elements->OpenDynamicMenuSimple();
$elements->ButtonDynamicMenu ('appliquer.png', APPLIQUER, null, 'javascript:document.getElementById(\'formulaire\').submit()', 1);
$elements->NbspDynamicMenu ();
$elements->ButtonDynamicMenu ('retour.png', CANCEL, null, 'espace_membre', 0);
$elements->CloseDynamicMenuSimple();
$body .= '</form>';
$body .= $theme_close_boite;
}
}
}
?>