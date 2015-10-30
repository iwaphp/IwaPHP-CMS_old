<?php
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
		if (preg_match("/\bmodules\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >

$body .='<table width="100%"  border="0" cellspacing="2" cellpadding="0">
			<tr>
			
		<td><table width="100%"  border="0" cellspacing="2" cellpadding="0">
		<tr>
		<td width="250" valign="top">'.$theme_open_boite.'
	'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&onglet=modules">Index des Modules</a><br>
<br>
		Modules<br>
    <hr>';
	$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."module WHERE install='1' AND type_menu='mod'");  
	while ($data = $db->sql_fetchrow($select)) {
		   $body .= (empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' 
		   <a href="index.php?admin&onglet=modules&mod='.$data['nom'].'">'.$data['titre_module'].'</a><br>';
	}
 $body .= $theme_close_boite.'</td>
		<td valign="top">';
		
	
	$body .= $theme_open_boite;
	if(isset($_GET['mod']) && !empty($_GET['mod']) && is_file($index->rootpath.'/modules/'.$_GET['mod'].'/admin'.$index->phpEx)){
        include $index->rootpath.'/modules/'.$_GET['mod'].'/admin'.$index->phpEx;
	} else {
        $body .='<fieldset><legend>Index des Modules</legend>';
		
			$body .='<table cellpadding="0" cellspacing="1" width="100%" border="0">';
			$body .='<tr>
			<td width="49" id="titre_tableau">Image</td>
			<td id="titre_tableau">Modules</td>
			<td id="titre_tableau">Nom systeme / Adresse du module</td>
			<td id="titre_tableau">Menu</td>
			<td id="titre_tableau">Statut</td>';
			$body .='</tr>';
			
		$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."module WHERE type_menu='mod'");  
	while ($data = $db->sql_fetchrow($select)) {
	
			
			$body .='<tr>
			<td id="tableau"><img src="modules/'.$data['nom'].'/'.$data['nom'].'.png" alt="" width="48" height="48" \></td>
			<td id="tableau">';
			$body .= (empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' 
		   <a href="index.php?admin&onglet=modules&mod='.$data['nom'].'">'.$data['titre_module'].'</a><br>';
			$body .='</td>
			<td id="tableau">'.$data['nom'].' / <a href="index.php?page='.$data['url'].'">index.php?page='.$data['url'].'</a></td>
			<td id="tableau">'.($data['active_menu'] == 1 ? 'Disponible' : 'Aucun').'</td>
			<td id="tableau">'.($data['install'] == 1 ? '<span style="color: #99cc00;"><strong>Install&eacute;</span></strong> [ <a href="index.php?admin&onglet=modules&mod='.$data['nom'].'&uninstall">D&eacute;sinstaller</a> ]' : '<span style="color: #ff0000;"><strong>Non install&eacute;</span></strong> [ <a href="index.php?admin&onglet=modules&mod='.$data['nom'].'&install">Installer</a> ]').'</td>
			</tr>';
		  
	}
		
		$body .='</table></fieldset>';
	}
	
		$body .='</td>
		</tr>
		</table>'.$theme_close_boite.'</td>
		</tr>
			</table>';
	} }
?>