<?php
// DREAMGRAY 2 Released by tokushiro

$colorbox = '#ffffff';
$borderbox = '#00A8A8';
$couleur_erreur_module = '#FF6600';

////---- Apparence des menus ----////

//Pour mettre un titre
$theme_open_boite_titre = '<div id="boite"><div id="open_boite_titre">';
$theme_close_boite_titre = '</div><hr />';

//Sans titre
$theme_open_boite = '<div id="boite">';	
	
//fermer une boite	
	
	$theme_close_boite = '</div>';

//login boite

//$theme_open_login_boite = '<table id="tableau" bgcolor="#ffffff" align="center" border="0" cellspacing="0" width="100%"><tr><td>';
//$theme_close_login_boite = '</td></tr></table>';

require($index->rootpath.'/systeme/func.theme'.$index->phpEx); // Parametre pour l'affichage

////---- Corps du site ----////

$theme_open_header = '<div id="superglobal"><div id="en-tete"><table id="sb_header" class="bar_header" border="0" cellpadding="5" align="right">
  <tr>
    <td><div>'.$recovery->SessionStatut().'</div></td>
  
    
  </tr>
</table>
<br><a href="index.php"><img src="'.recuperer('url_logo').'" border="0" alt="'.recuperer('nom_site').'"></a><br />
<div align="center"><table border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="170"><a href="'.$index->rootfile.'?"><div align="center" id="link_entete">Accueil</div></a></td>';

		# Determine le niveau de l'utilisateur en cours
		$db_user = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$utilisateur->idUtilisateur."'");
		$result_user = $db->sql_fetchrow($db_user);

		# Compare le niveau d'utilisateur
		$db_level = $db->sql_query("SELECT * FROM ".$db->prefix_tables."niveaux WHERE numero='".$result_user['grade']."'");
		$result_level = $db->sql_fetchrow($db_level);
		
		# Recherche si une de ces partie est existante pour le niveau de l'utilisateur trouvé
		if (preg_match("/\butilisateurs\b/i", $result_level['valeur']) or preg_match("/\bapparence\b/i", $result_level['valeur'])
		or preg_match("/\bconfiguration\b/i", $result_level['valeur']) or preg_match("/\bcommunication\b/i", $result_level['valeur']) 
		or preg_match("/\bconfig_server\b/i", $result_level['valeur']) or preg_match("/\bupdate\b/i", $result_level['valeur'])) {
			$theme_open_header .= '<td width="170"><a href="index.php?admin"><div align="center" id="link_entete">'.ADMIN.'</div></a></td>'; 
		}

$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."module WHERE type_menu='fixed'");                                
while($result = $db->sql_fetchrow($data)) {	
	
	($result['nom'] != '' && $result['nom'] != '.' && $result['nom'] != '..' && $result['nom'] != 'edito' && $result['nom'] != 'admin' && $result['nom'] != 'articles' && $result['nom'] != 'statistiques' && $result['nom'] != 'boite_reception' ? $theme_open_header .='<td width="170"><a href="'.$index->targetfile.'='.$result['nom'].'"><div align="center" id="link_entete">'.$result['titre_module'].'</div></a></td> ' : NULL);
}
$theme_open_header .= '</tr></table></div>
</div>


<div id="enveloppe-exterieure"> <div id="conteneur">
      <div id="contenu">';
if (empty($gmenu)) { 
$theme_open_gmenu .='<div id="gauche">&nbsp;';
$theme_close_gmenu = '</div>';
} else {
$theme_open_gmenu .='<div id="gauche">'.$gmenu.' ';
$theme_close_gmenu = '</div>';
}

 
$theme_open_corps = '<div id="principal">';
$theme_close_corps = '</div>';


if (empty($dmenu)) { 
$theme_open_dmenu = ' </div>
    </div>';
$theme_close_dmenu = '';
} else {
$theme_open_dmenu = ' </div>
    </div><div id="barre-laterale">'.$dmenu.'';
$theme_close_dmenu = '</div>
 ';
}
$theme_close_header =' 
      <div class="deblayage">&nbsp;</div>
  </div>
  
</div>

<div id="pied-de-page"><div align="center">'.$afficherFooter.'</div></div></div>';


?>