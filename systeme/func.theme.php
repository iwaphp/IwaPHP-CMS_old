<?php
# IwaPHP CMS - Système de gestion de contenu 

$echo_gmenu = '';
$req2 = mysql_query("SELECT * FROM ".$db->prefix_tables."menu WHERE emplacement='gauche' ORDER BY position");  
while ($res2 = mysql_fetch_array ($req2)) {

	if($res2['type'] == 'perso') {
	
	$echo_gmenu .= $theme_open_boite_titre;

	$titre_gmenu = $res2['titre'];

	$echo_gmenu .= $titre_gmenu; 

	$echo_gmenu .= $theme_close_boite_titre;

		$req3 = mysql_query("SELECT * FROM ".$db->prefix_tables."menu_contenu WHERE titre='".$res2['titre']."' AND type='lien' ORDER BY position");  
		while ($res3 = mysql_fetch_array ($req3)) {
	
		$contenu_gmenu = '<a href="'.$res3['url'].'"><div id="link_nav">'.$res3['valeur'].'</div></a>';
	
		$echo_gmenu .= $contenu_gmenu;
		
		}

		$echo_gmenu .= $theme_close_boite;

	} else {
	
	$req7 = mysql_query("SELECT * FROM ".$db->prefix_tables."menu_module WHERE module='".$res2['titre']."'"); 
	while ($res7 = mysql_fetch_array ($req7)) {
	
	require ($index->rootpath.'/modules/'.$res7['module'].'/menu.'.$res7['bloc'].$index->phpEx);
	$echo_gmenu .= $contenu ;
	}
	
	}
} 



 
$echo_dmenu = '';
$req4 = mysql_query("SELECT * FROM ".$db->prefix_tables."menu WHERE emplacement='droite' ORDER BY position");  
while ($res4 = mysql_fetch_array ($req4)) {

	if($res4['type'] == 'perso') {
	
	$echo_dmenu .= $theme_open_boite_titre;

	$titre_dmenu = $res4['titre'];

	$echo_dmenu .= $titre_dmenu; 

	$echo_dmenu .= $theme_close_boite_titre;

		$req5 = mysql_query("SELECT * FROM ".$db->prefix_tables."menu_contenu WHERE titre='".$res4['titre']."' AND type='lien' ORDER BY position");  
		while ($res5 = mysql_fetch_array ($req5)) {
	
		$contenu_dmenu = '<a href="'.$res5['url'].'"><div id="link_nav">'.$res5['valeur'].'</div></a>';
	
		$echo_dmenu .= $contenu_dmenu;
		
		}
		
		$echo_dmenu .= $theme_close_boite;

	} else {
	
	$req6 = mysql_query("SELECT * FROM ".$db->prefix_tables."menu_module WHERE module='".$res4['titre']."'"); 
	while ($res6 = mysql_fetch_array ($req6)) {
	
	require ($index->rootpath.'/modules/'.$res6['module'].'/menu.'.$res6['bloc'].$index->phpEx);
	$echo_dmenu .= $contenu ;
	}
	
	}
} 






$gmenu = $echo_gmenu;
$dmenu = $echo_dmenu;

?>