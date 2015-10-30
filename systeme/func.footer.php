<?php
# IwaPHP CMS - Système de gestion de contenu 


// --- /!\ Il est formellement interdit de supprimer les copyrights officiel du portail /!\ --- //

$beta = null;
	
	define ('GENERATOR', 'IwaPHP');

	define ('NO_CORRECTIF', '00');
	
	define ('VERSION', '1.00.'.NO_CORRECTIF);

	define ('LANG', recuperer('lang_general'));

	define ('PATCH', 'aucun');

	define ('WEBSITE', ''); //Lien de mise à jour original

	define ('UPDATE_INFO', ''.WEBSITE.'index.php?update&generator='.GENERATOR.'&version='.VERSION.'&correctif='.NO_CORRECTIF.'&lang='.LANG.'&patch='.PATCH.'');
	
$end = $index->microtime_float();	

$contenu = '- <a href="'.$index->rootfile.'?">Accueil</a>';
if ($membre_droits_utilisateur->boolean == 'non' AND $rangs_droits_utilisateur->boolean == 'non' AND $interface_droits_utilisateur->boolean == 'non' AND $options_droits_utilisateur->boolean == 'non' AND $travaux_droits_utilisateur->boolean == 'non') {  null; } else {
$contenu .= '<br />- <a href="index.php?admin">'.ADMIN.'</a>';
}
$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."module WHERE type_menu='mod'");                                
while($result = $db->sql_fetchrow($data)) {	
	
	($result['nom'] != '' && $result['nom'] != '.' && $result['nom'] != '..' && $result['nom'] != 'edito' && $result['nom'] != 'admin' && $result['nom'] != 'articles' && $result['nom'] != 'statistiques' && $result['nom'] != 'boite_reception' ? $contenu .='<br />- <a href="'.$index->targetfile.'='.$result['nom'].'">'.$result['titre_module'].'</a>' : NULL);
}
$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."module WHERE type_menu='fixed'");                                
while($result = $db->sql_fetchrow($data)) {	
	
	($result['nom'] != '' && $result['nom'] != '.' && $result['nom'] != '..' && $result['nom'] != 'edito' && $result['nom'] != 'admin' && $result['nom'] != 'articles' && $result['nom'] != 'statistiques' && $result['nom'] != 'boite_reception' ? $contenu .='<br />- <a href="'.$index->targetfile.'='.$result['nom'].'">'.$result['titre_module'].'</a>' : NULL);
}

$afficherFooter = '<table border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="300"><h3><div id="titre_cat_footer">Navigation</div></h3></td>
    <td width="300"><h3><div id="titre_cat_footer">Statistiques</div></h3></td>
    <td width="300"><h3><div id="titre_cat_footer">Mentions</div></h3></td>
  </tr>
  <tr>
    <td valign="top">'.$contenu.'</td>
    <td valign="top">'.$statistiques.'</td>
    <td valign="top">'.recuperer('copyrights').'<br />'.(empty($utilisateur->themeUtilisateur) ? "<b>".round($end - $start, 4)."</b>&nbsp;".GS."&nbsp;<strong>&nbsp;".$db->num_queries."</strong>&nbsp;".GR."\n" : "<b>".round($end - $start, 4)."</b>&nbsp;".GS.",&nbsp;<strong>".$db->num_queries."</strong>&nbsp;".GR."\n").'.<br /><br />Propuls&eacute; par<a href="http://www.iwaphp.fr/" target="_blank"> IwaPHP</a> '.VERSION.'&nbsp;, distribu&eacute; selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by-nd/3.0/fr/">Licence Creative Commons 3.0</a>.
</td>
  </tr>
</table>';




?>