<?php
# IwaPHP CMS - Système de gestion de contenu 


$body .= $theme_open_boite_titre;
$body .= 'Groupes du site' ;
$body .= $theme_close_boite_titre;

$body .='<table width="100%"  border="0" cellspacing="2" cellpadding="0" id="tableau">';
  
$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."groupes");
while ($result = $db->sql_fetchrow($data))
{

$body .='<tr>
<td id=titre_tableau><span style="color :'.$result['couleur'].'"><b>Groupe :</b> '.$result['nom'].'</span></td>
</tr>
<tr><td><b>Description :</b> '.(!empty($result['description']) ? $result['description'] : '<em>Aucune description</em>').'<br /><b>Niveaux d\'administration :</b> '.$result['niveaux'].'<br /><br /><b>Membres :</b><table width="100%" align="center" border="0" cellpadding="0" cellspacing="2">';
	
	$data2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE grade='".$result['niveaux']."'");
	while ($result2 = $db->sql_fetchrow($data2))
	{
	$body .= '
  <tr>
    <td id=tableau>- <a href="'.$index->targetfile.'=memberlist&profil='.$result2['id'].'">'.$result2['pseudo'].'</a></td>
  </tr>
';
	}

$body .='</table><br /></td></tr>';

}

$body .='</table>';
$body .= $theme_close_boite;


?>