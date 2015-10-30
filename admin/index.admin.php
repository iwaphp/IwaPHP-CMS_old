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
		if (preg_match("/\butilisateurs\b/i", $result_level['valeur']) or preg_match("/\bapparence\b/i", $result_level['valeur'])
		or preg_match("/\bconfiguration\b/i", $result_level['valeur']) or preg_match("/\bcommunication\b/i", $result_level['valeur']) 
		or preg_match("/\bconfig_server\b/i", $result_level['valeur']) or preg_match("/\bupdate\b/i", $result_level['valeur'])
		or preg_match("/\bmodules\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >
	
   


define('Admin_Version', '0.0.000');
define('IwaPHP_Version_forAdmin', '1.00.000');
define('Kernel_Version_forAdmin', '0.00');



	include $index->rootpath.'/admin/admin/form.class'.$index->phpEx;
	
	$operation = new Form ();
	
		$body .='<div id="en-tete"><table id="sb_header" class="bar_header" border="0" cellpadding="5" align="right">
  <tr>
    <td><div>'.$recovery->SessionStatut().'</div></td>
  
    
  </tr>
</table><img src="admin/images/logo-admin.png" border="0" /></div>';
		$body .= '<div id="enveloppe-exterieure"><h2>Administration de '.recuperer('nom_site').'</h2>
		
		<div align="center"><table border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    
	<td valign="middle" width="170"><a href="index.php?admin"><table id="link_nav" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/admin/configure_admin.png\" alt=\"\" border=\"0\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/admin/configure_admin.png\" alt=\"\" border=\"0\" \>\n").'
         </td>
          <td>Administration</td>
        </tr>
    </table></a></td><td valign="middle" width="170"><a href="index.php?admin&onglet=modules"><table id="link_nav" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/admin/configure_modules.png\" alt=\"\" border=\"0\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/admin/configure_modules.png\" alt=\"\" border=\"0\" \>\n").'
         </td>
          <td>Modules</td>
        </tr>
    </table></a></td>
    <td valign="middle" width="170"><a href="index.php?admin&onglet=updater"><table id="link_nav" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
           '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/admin/updates.png\" alt=\"\" border=\"0\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/admin/updates.png\" alt=\"\" border=\"0\" \>\n").'</td>
          <td>Mises à jour</td>
        </tr>
    </table></a></td>
    <td valign="middle" width="170"><a href="index.php?admin&onglet=about"><table id="link_nav" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
           '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/admin/about.png\" alt=\"\" border=\"0\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/admin/about.png\" alt=\"\" border=\"0\" \>\n").'</td>
          <td>A propos</td>
        </tr>
    </table></a></td>
	<td valign="middle" width="170"><a href="index.php"><table id="link_nav" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
          '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/admin/cancel.png\" alt=\"\" border=\"0\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/admin/cancel.png\" alt=\"\" border=\"0\" \>\n").'
         </td>
          <td>Index du site</td>
        </tr>
    </table></a></td>
    <td valign="middle" width="170"><a href="javascript:history.go(-1);"><table id="link_nav" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
           '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/admin/back.png\" alt=\"\" border=\"0\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/admin/back.png\" alt=\"\" border=\"0\" \>\n").'</td>
          <td>Précédente</td>
        </tr>
    </table></a></td>
    <td valign="middle" width="170"><a href="javascript:history.go(+1);"><table id="link_nav" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td>
           '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/admin/next.png\" alt=\"\" border=\"0\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/admin/next.png\" alt=\"\" border=\"0\" \>\n").'</td>
          <td>Suivante</td>
        </tr>
    </table></a></td>
  </tr>
</table></div>';
	
	if(isset($_GET['onglet']) && !empty($_GET['onglet']) && is_file($index->rootpath.'/admin/'.$_GET['onglet'].'/index.'.$_GET['onglet'].$index->phpEx)){
        include $index->rootpath.'/admin/'.$_GET['onglet'].'/index.'.$_GET['onglet'].$index->phpEx;
	} else {
       
	
		$body .='<table width="100%"  border="0" cellspacing="2" cellpadding="0">
			<tr>
			
		<td><table width="100%"  border="0" cellspacing="2" cellpadding="0">
		<tr>
		<td width="250" valign="top"><div id="menu_admin">
	'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin">Index de l\'Administration</a><br>
<br>';
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
		if (preg_match("/\butilisateurs\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >
	$body .='<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"><img src="admin/images/user.png" alt="" /></td><td><h3>Utilisateurs</h3></td>
  </tr>
</table> 
    <hr>
	
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=utilisateurs">Administration des utilisateurs</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=groupes">Gestion des groupes</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=niveaux">Niveaux utilisateurs</a><br>
   
   <br>';
 }
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
		if (preg_match("/\bapparence\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >
   $body .='<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"><img src="admin/images/design.png" alt="" /></td>
    <td><h3>Apparence</h3></td>
  </tr>
</table>
	<HR>
	'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=disposition">Disposition des menus</a><br>
	'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=edito">Page d\'accueil/edito</a><br>
    <br>
   
';
 }
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
   $body .='<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"><img src="admin/images/config.png" alt="" /></td>
    <td><h3>Configuration</h3></td>
  </tr>
</table>
    
    <hr>
	
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_upload">Param&egrave;tres upload fichiers</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=config">Configuration portail</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=fonctions">Fonctionnalit&eacute;s du portail</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_avatar">Param&egrave;tres des avatars</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=messagerie">Messagerie interne</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_msg">Param&egrave;tres des messages</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_sign">Param&egrave;tres de signature</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_inscription">Param&egrave;tres des inscriptions</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_visualconfirm">Param&egrave;tres de confirmation visuelle</a><br>
    <br>
	';
 }
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
		if (preg_match("/\bcommunication\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >
   $body .='<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"><img src="admin/images/communication.png" alt="" /></td>
    <td><h3>Communication</h3></td>
  </tr>
</table>
     
    <hr>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_email">Param&egrave;tres des e-mails</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=config_email">Configuration des e-mails envoy&eacute;s</a><br>
    <br>
	';
 }
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
		if (preg_match("/\bconfig_server\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >
   $body .='<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20"><img src="admin/images/server_settings.png" alt="" /></td>
    <td><h3>Configuration du serveur</h3></td>
  </tr>
</table>
    
    <hr> 
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_serveur">Param&egrave;tres du serveur</a><br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_secu">Param&egrave;tres de s&eacute;curit&eacute;</a>   <br>
    '.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=param_charge">Param&egrave;tres de charge</a>
    <br>';
}
$body .='</div></td>
		<td valign="top"><div id="menu_admin">';
		
		
	
	if(isset($_GET['op']) && !empty($_GET['op']) && is_file($index->rootpath.'/admin/admin/'.$_GET['op'].'/index.'.$_GET['op'].$index->phpEx)){
        include $index->rootpath.'/admin/admin/'.$_GET['op'].'/index.'.$_GET['op'].$index->phpEx;
	} else {
        include $index->rootpath.'/admin/admin/index'.$index->phpEx;
	}
	
		$body .='</div></td>
		</tr>
		</table></td>
		</tr>
			</table></div>';
			}
# --- Autrement on bloque l'acces ---		
} else {
		$body .= "Aucun droits trouvé";
}
	
	
}
	
	
	
 
?>