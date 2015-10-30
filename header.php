<?php
# IwaPHP CMS - Système de gestion de contenu 

# récupération du thème par défaut suivant la session
(!isset($_SESSION['pseudo']) ? require $index->rootpath.'/themes/'.recuperer('theme').'/theme'.$index->phpEx :
	
	(empty($utilisateur->themeUtilisateur) ? require $index->rootpath.'/themes/'.recuperer('theme').'/theme'.$index->phpEx : 
	require $index->rootpath.'/themes/'.$utilisateur->themeUtilisateur.'/theme'.$index->phpEx)) ;

# messages prédéfinis
require $index->rootpath.'/systeme/func.messages'.$index->phpEx ;

# affichage du site
$head = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
\"http://www.w3.org/TR/html4/loose.dtd\">";
$head .= "<html>\n";
$head .= "<head>\n";
$head .= "<title>".recuperer('nom_site')." - ".recuperer('description')."</title>\n";



# meta tags
(!isset($_SESSION['pseudo']) ? include($index->rootpath.'/themes/'. recuperer('theme') .'/meta'.$index->phpEx) :
(!empty($utilisateur->themeUtilisateur) ? include($index->rootpath.'/themes/'. $utilisateur->themeUtilisateur .'/meta'.$index->phpEx) : NULL)) ;
	
# javascripts d'entête
include($index->rootpath.'/systeme/javascripts/js.head'.$index->phpEx);
	
	# icône du favoris
	$head .= (!isset($_SESSION['pseudo']) ?
		(file_exists($index->rootpath."/themes/". recuperer('theme') ."/images/favicon.ico") ?
		"<link REL=\"shortcut icon\" HREF=\"themes/".recuperer('theme')."/images/favicon.ico\" TYPE=\"image/x-icon\">\n"  
		: NULL )
	: 
		(empty($utilisateur->themeUtilisateur) ?
			(file_exists($index->rootpath."/themes/". recuperer('theme') ."/images/favicon.ico") ?
			"<link REL=\"shortcut icon\" HREF=\"themes/".recuperer('theme')."/images/favicon.ico\" TYPE=\"image/x-icon\">\n" 
			: NULL )
		:
			(file_exists($index->rootpath."/themes/". $utilisateur->themeUtilisateur ."/images/favicon.ico") ?
			"<link REL=\"shortcut icon\" HREF=\"themes/".$utilisateur->themeUtilisateur."/images/favicon.ico\" TYPE=\"image/x-icon\">\n" 
			: NULL )
		)
	) ;
	
	
$head .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n";
	
	# feuille de style
	$head .= (!isset($_SESSION['pseudo']) ?
	"<LINK REL=\"StyleSheet\" HREF=\"themes/".recuperer('theme')."/style.css\" TYPE=\"text/css\">\n\n\n" :
		
		(empty($utilisateur->themeUtilisateur) ?
		"<LINK REL=\"StyleSheet\" HREF=\"themes/".recuperer('theme')."/style.css\" TYPE=\"text/css\">\n\n\n"
		:
		"<LINK REL=\"StyleSheet\" HREF=\"themes/".$utilisateur->themeUtilisateur."/style.css\" TYPE=\"text/css\">\n\n\n"
		)
	);
	# feuille de style jTPS
	$head .= (!isset($_SESSION['pseudo']) ?
	"<LINK REL=\"StyleSheet\" HREF=\"themes/".recuperer('theme')."/jQuery/jTPS.css\" TYPE=\"text/css\">\n\n\n" :
		
		(empty($utilisateur->themeUtilisateur) ?
		"<LINK REL=\"StyleSheet\" HREF=\"themes/".recuperer('theme')."/jQuery/jTPS.css\" TYPE=\"text/css\">\n\n\n"
		:
		"<LINK REL=\"StyleSheet\" HREF=\"themes/".$utilisateur->themeUtilisateur."/jQuery/jTPS.css\" TYPE=\"text/css\">\n\n\n"
		)
	);
	

	

$head .= "\n\n\n</head>\n\n";
$body = "<body>\n";


	
	# javascripts du corps
	include($index->rootpath.'/systeme/javascripts/js.body'.$index->phpEx);

	# variable login
	if (isset($_GET['login'])) { 
		(isset($_GET['action']) ? ($_GET['action'] == 'connexion' || 'deconnexion' ?  (file_exists($index->rootpath.'/modules/espace_membre/index'.$index->phpEx) ? include($index->rootpath.'/modules/espace_membre/index'.$index->phpEx) : $body .=erreur) : null) : (file_exists($index->rootpath.'/modules/espace_membre/index'.$index->phpEx) ? include($index->rootpath.'/modules/espace_membre/index'.$index->phpEx) : $body .=erreur)); 
	# variable admin
	} elseif (isset($_GET['admin'])) {
		include ($index->rootpath.'/admin/index.admin'.$index->phpEx); 
	} else {

$body .= $theme_open_header.$theme_open_gmenu.$theme_close_gmenu.$theme_open_corps;

		# construction
		if (recuperer('travaux') == 'enabled') {
			$body .= $theme_open_boite . '<table width="100%"  border="0" cellspacing="0">
			  <tr>
				<td width="61"><img src="'.$index->rootpath.'/images/ponctuation-gif-009.gif" border="0" alt="" /></td>
				<td>' . UC . '</td>
			  </tr>
			</table>' . $theme_close_boite;

			if (!isset($_SESSION['pseudo'])) {
			
				$body .= '&nbsp;'.$theme_open_boite ;
				$body .= '<span>';
				$body .= '<form name="form1" method="post" action="'.$index->rootfile.'?login&action=connexion" onsubmi="return verifForm(this);">';
				$body .= '<FIELDSET>';
				$body .= '<table width="100%" border="0" cellspacing="0"><tr><td>';

				$body .= (empty($utilisateur->themeUtilisateur) ? "<img src=\"".$index->rootpath."/themes/".recuperer('theme')."/images/icones/login.png\" alt=\"".TITRE_CEM."\" width=\"48\" height=\"48\" \>\n" : "<img src=\"".$index->rootpath."/themes/".$utilisateur->themeUtilisateur."/images/icones/login.png\" alt=\"".TITRE_CEM."\" width=\"48\" height=\"48\" \>\n");
				$body .= '</td><td width="100%"><b>'.FALSEUC.'</b></td></tr></table>';
				$body .= '<p><label>'.SAISIEPSEUDO_CEM.' : <input name="pseudo" type="text" value="';

								if (isset($_COOKIE['pseudo'])) { 
								$body .= $_COOKIE['pseudo'];
								} 
				$body .= '"  /></label></p>';
				$body .= '<p><label>'.SAISIEPASS_CEM.' : <input name="password" type="password" value="';

								if (isset($_COOKIE['pass'])) { 
								$body .= $_COOKIE['pass']; 
								}

				$body .= '" /></label></p>';
				$body .= '<p><input name="Submit" value="'.SUBMIT_CONNECT.'" type="submit" onClick="verifForm(this.form);this.form.submit();this.disabled=true;this.value=\''.ONCLICK_SUBMIT_CONNECT.'\'"></p></FIELDSET>';
				$body .= $theme_close_boite ; 
				
			} else {
			
				$body .= '&nbsp;'.$theme_open_boite ;

				if ($travaux_droits_utilisateur->boolean == 'oui') { 
					if (isset($_GET['maintenance'])) {  
					
						$body .= "<SCRIPT LANGUAGE='JavaScript'>\n";
						$body .= "<!--\n";
						$body .= "function redirect() \n";
						$body .= "{\n";
						$body .= "window.location='".$index->rootfile."?' \n"; 
						$body .= "}\n";
						$body .= "setTimeout('redirect()',300); \n";
						$body .= "-->\n";
						$body .= "</SCRIPT>\n";
				
						$db->sql_query("UPDATE ".$db->prefix_tables."options SET travaux='".$_GET['maintenance']."' WHERE id='1'");

					}

					$body .= '<a href="'.$index->rootfile.'?maintenance=disabled">'.FALSEUC.'</a>';

				} else {

					$body .= LOW;
				
				}
				
				$body .= $theme_close_boite ;
			
			}
		
		} elseif (recuperer('travaux') == 'disabled') {
		


		
			if (!isset($_GET[$index->rootget])) { 
			  
				include ($index->rootpath.'/modules/edito/index'.$index->phpEx); 

				(file_exists($index->rootpath."/modules/".recuperer('module_demarrage')."/index".$index->phpEx) ? include ($index->rootpath.'/modules/'.recuperer('module_demarrage').'/index'.$index->phpEx) : $body .='Le module de démarrage séléctionné n\'existe pas.'); 

			} else {

				$page = (!empty($_GET[$index->rootget])) ? htmlentities($_GET[$index->rootget]) : 'index';

			

				if(is_file($index->rootpath.'/modules/'.$page.'/index'.$index->phpEx))  {

					include($index->rootpath.'/modules/'.$page.'/index'.$index->phpEx);

				} else {

					$body .=erreur;
				} 

			}
		 
		  
		 
		  
		} 
	
$body .= $theme_close_corps.$theme_open_dmenu.$theme_close_dmenu.$theme_close_header;
	
	}

$body .= "\n\n\n</body>\n\n";
$body .= "\n\n\n</html>\n\n";

$html = $head . $body ;

?>
