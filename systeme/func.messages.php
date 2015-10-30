<?php
# IwaPHP CMS - Système de gestion de contenu 


//////////////////////////////
//  Messages pédéfinis		//
//////////////////////////////
	
// message de confirmation d'un formulaire
if (isset($_SESSION['pseudo'])) {
	
			$msgmodifok = '<fieldset><legend>Information</legend>'.MODIFICATIONS_PRISE_EN_COMPTE.'<br><br><a href="javascript:history.go(-1);">'.RETOUR_PAGE_PRECEDENTE.'</a><br><br><a href="index.php?admin">'.RETOUR_PAGE_ADMIN.'</a></fieldset>';
		
				define("submit_form", $msgmodifok);

			$msgmodifprofilok = '<fieldset><legend>Information</legend>Vos modifications ont bien &eacute;t&eacute; prise en compte.<br><br><a href="javascript:history.go(-1);">'.RETOUR_PAGE_PRECEDENTE.'</a><br><br><a href="index.php?page=espace_membre">Retour &agrave; l\'espace membre</a></fieldset>';
			
				define("submit_form_in_em", $msgmodifprofilok);
}
// fonction erreur dans la page
$reponse = $theme_open_boite . PAGE_DIE . $theme_close_boite ;
$redirection = 'javascript:history.go(-1);'; 
 
$erreur = $reponse; 
$erreur .= "<SCRIPT LANGUAGE='JavaScript'>\n";
$erreur .= "<!--\n";
$erreur .= "function redirect() \n";
$erreur .= "{\n";
$erreur .= "window.location='".$redirection."' \n";
$erreur .= "}\n";
$erreur .= "setTimeout('redirect()',1000); \n";
$erreur .= "-->\n";
$erreur .= "</SCRIPT>\n";

				define ("erreur", $erreur);

?>