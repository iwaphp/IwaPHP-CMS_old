<?php
# IwaPHP CMS - Système de gestion de contenu 

$menu_dyn_name = 'Navigation';
$menu_dyn_description = 'Accéder rapidement aux pages du site.';
$exImg = 'jpg';

$contenu = $theme_open_boite_titre ;
$contenu .= 'Navigation';
$contenu .= $theme_close_boite_titre ;
$contenu .= '<a href="'.$index->rootfile.'?"><div id="link_nav">Accueil</div></a>';
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
				$contenu .= '<a href="index.php?admin"><div id="link_nav">'.ADMIN.'</div></a>';
		}
$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."module WHERE type_menu='mod'");                                
while($result = $db->sql_fetchrow($data)) {	
	
	($result['nom'] != '' && $result['nom'] != '.' && $result['nom'] != '..' && $result['nom'] != 'edito' && $result['nom'] != 'admin' && $result['nom'] != 'articles' && $result['nom'] != 'statistiques' && $result['nom'] != 'boite_reception' ? $contenu .='<a href="'.$index->targetfile.'='.$result['nom'].'"><div id="link_nav">'.$result['titre_module'].'</div></a>' : NULL);
}
$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."module WHERE type_menu='fixed'");                                
while($result = $db->sql_fetchrow($data)) {	
	
	($result['nom'] != '' && $result['nom'] != '.' && $result['nom'] != '..' && $result['nom'] != 'edito' && $result['nom'] != 'admin' && $result['nom'] != 'articles' && $result['nom'] != 'statistiques' && $result['nom'] != 'boite_reception' ? $contenu .='<a href="'.$index->targetfile.'='.$result['nom'].'"><div id="link_nav">'.$result['titre_module'].'</div></a>' : NULL);
}


$contenu .= $theme_close_boite ;

?>