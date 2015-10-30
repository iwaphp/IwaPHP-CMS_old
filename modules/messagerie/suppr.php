<?php
# IwaPHP CMS - Système de gestion de contenu 


if (!isset($_SESSION['pseudo'])) { $body .= erreur ; } else {	
$body .=$theme_open_boite_titre ;
$body .=INBOX;
$body .=$theme_close_boite_titre ;
$body .='<table width="100%" border="0" cellspacing="0">';
$body .='<tr><td><a href="'.$index->targetfile.'=espace_membre">'.ESPACE_MEMBRE.'</a> &gt; <a href="'.$index->targetfile.'=boite_reception">'.MSGINT.'</a> &gt; <strong>'.MSGSUP.'</strong>';

$body .='</td>';
$body .='<td width="30%"></td>';
$body .='</tr>';
$body .='</table><br>';

$body .='<table width="100%" id="tableau" border="0" cellspacing="2">';
if  (isset($_GET['action']) and $_GET['action'] == "del")
{
	$body .='<tr>';
	$body .='<td>'.MSGTOTALSUPP.' <meta http-equiv="refresh" content="5; url='.$index->targetfile.'=boite_reception&dossier=suppr" /></td>';
	$body .='</tr>';
	$db->sql_query("DELETE FROM ".$db->prefix_tables."mp WHERE id=".$_GET['id']."") or die(mysql_error());
	
	
}
else 
{
	
@$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."mp WHERE archiv='1' and id_receveur='".$utilisateur->idUtilisateur."' ORDER BY times DESC");// Requête SQL

while ($donnees = $db->sql_fetchrow($reponse) )
{
		$requetee = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$donnees['id_expediteur']."'");
	$ideme = $db->sql_fetchrow ($requetee);
	// Affichage message
	$body .='<tr>';
	$body .='<td width="10%">&nbsp;</td>';
	$body .='<td width="20%">'.$ideme['pseudo'].'</td>';
	$body .='<td width="50%"><strong><a href="'.$index->targetfile.'=boite_reception&dossier=reception&msg='.$donnees['id'].'">'.$donnees['sujet'].'</a></td>
<td width="20%">  <a href="'.$index->targetfile.'=boite_reception&dossier=suppr&action=del&id='.$donnees['id'].'">'.SUPPRIMER_NEWS.'</a></td> <br>';
	$body .="</strong>";
	$body .='</td>';
	$body .='</tr>';
}
// Fin message
$body .='<tr><td colspan="4" align="center">'.ACTION_IRREMEDIABLE.'</td></tr>';
}
$body .='</table>';
$body .='<p>';

$body .= $theme_close_boite ;
}

?>