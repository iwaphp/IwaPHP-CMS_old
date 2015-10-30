<?php
# IwaPHP CMS - Système de gestion de contenu 

# Dynamic menu IwaPHP
class DynamicMenu {

	function OpenDynamicMenu ($titre)
	{
		global $body, $theme_open_boite_titre, $theme_close_boite_titre;
		$body .=$theme_open_boite_titre ;
		$body .=$titre;
		$body .=$theme_close_boite_titre ;
		$body .='<div align="center"><table width="100%"  border="0" cellspacing="2" cellpadding="0"><tr><td>';
	}
	
	function OpenDynamicMenuSimple ()
	{
		global $body;
		$body .='<div align="center"><table width="100%"  border="0" cellspacing="2" cellpadding="0"><tr><td>';
	}
	
	function CloseDynamicMenuSimple ()
	{
		global $body;
		$body .='</td></tr></table></div>';
	}
	
	function ButtonDynamicMenu ($icone, $nom, $description, $href, $freeHref)
	{
		global $body, $utilisateur, $index;
		$body .= '<a class="no_decoration" onMouseOver="poplink(\''.$nom.'\');" onmouseout="killlink()" href="'.($freeHref == 1 ? $href : $index->targetfile.'='.$href ).'"><table width="100%" id="login_bouton" border="0" cellspacing="2">';
		$body .= '<tr>';
		$body .= '<td width="49">';
		$body .= (!empty($utilisateur->themeUtilisateur) ? "<img border=0 src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/".$icone."\" alt=\"".$nom."\" width=\"48\" height=\"48\" \>\n" : "<img border=0 src=\"themes/".recuperer('theme')."/images/icones/".$icone."\" alt=\"".$nom."\" width=\"48\" height=\"48\" \>\n");
		$body .= '</td><td><strong>'.$nom.' <br>';
		$body .= "</strong>".$description."";
		$body .= '</td>';
		$body .= '</tr></table></a>';
	}
	
	
	function NbspDynamicMenu ()
	{
		global $body;
		$body .= '</td></tr><tr><td>';
	}
	
	function CloseDynamicMenu ()
	{
		global $body, $theme_close_boite;
		$body .= '</td></tr></table></div>';
		$body .= $theme_close_boite ;
	}
	
	
}


?>