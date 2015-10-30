<?php
# IwaPHP CMS - Système de gestion de contenu 

if (!isset($_SESSION['pseudo'])) { $body .= erreur ; } else {	

$body .=$theme_open_boite_titre ;
$body .=MSGENV;
$body .=$theme_close_boite_titre ;
$body .='<table width="100%" border="0" cellspacing="0">';
$body .='<tr><td><a href="'.$index->targetfile.'=espace_membre">'.ESPACE_MEMBRE.'</a> &gt; <a href="'.$index->targetfile.'=boite_reception">'.MSGINT.'</a> &gt; <strong>'.MSGENV.'</strong>';
$body .='</td>';
$body .='<td width="30%"></td>';
$body .='</tr>';
$body .='</table><br>';

$body .='<table width="100%" id="tableau" border="0" cellspacing="2">';

$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."mp WHERE archiv='0' and id_expediteur='".$utilisateur->idUtilisateur."' ORDER BY times DESC");// Requête SQL
while ($donnees = $db->sql_fetchrow($reponse) )
{
	$new = ($donnees['lu'] == 1) ? '<strong>'.NONLU.'</strong>' : '&nbsp;' ;
	$requetee = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$donnees['id_receveur']."'");
	$ideme = $db->sql_fetchrow($requetee);
	// Affichage message
	$body .='<tr>';
	$body .='<td width="10%">'.$new.'</td>';
	$body .='<td width="20%">'.$ideme['pseudo'].'</td>';
	$body .='<td width="50%"><strong><a href="'.$index->targetfile.'=boite_reception&dossier=envoi&msg='.$donnees['id'].'">'.$donnees['sujet'].'</a></td>
<td width="20%"></td> <br>';
	$body .="</strong>";
	$body .='</td>';
	$body .='</tr>';
}
// Fin message
$body .='</table>';
$body .='<p>';

$body .= $theme_close_boite ;
if (isset($_GET['msg']))
{
	$reponse2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."mp WHERE id='".$_GET['msg']."'");// Requête SQL
	$donnees2 = $db->sql_fetchrow($reponse2);
	$body .=$theme_open_boite_titre ;
	$body .=READMSG;
	$body .=$theme_close_boite_titre ;
	$body .='<table width="100%" border="0" cellspacing="0">';
	$body .='<tr>';
	$body .='<td width="30%"></td>';
	$body .='</tr>';
	$body .='</table>';
	$body .='<div align="center">';
	$body .='<p><b>'.READMSG.' : </b></p>';
	$body .='<table width="100%" id="tableau" border="0" cellspacing="0">';


	$new = ($donnees2['lu'] == 1) ? '<strong>'.NEWW.'</strong>' : '&nbsp;' ;
	$requetee2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$donnees2['id_expediteur']."'");
	$ideme2 = $db->sql_fetchrow ($requetee2);
	// Affichage message
	$body .='<tr>';
	$body .='<td colspan="2">'.PSEUDO_EXP.' : '.$ideme2['pseudo'].'</td></tr>';
	$body .='<tr><td width="50%"><strong>'.SUJET.' : '.$donnees2['sujet'].'</a></td>
<td width="20%"></td> <br>';
	$body .="</strong>";
	$body .='</td>';
	$body .='</tr>';
	$body .='<td colspan="2">'.MSG.' :</td></tr>';
	$body .='<td colspan="2" align="center"> '.$donnees2['message'].'</td></tr>';
	// Fin message
	$body .='</table>';
	$body .='<p>';
	$body .='</div>';
	$body .= $theme_close_boite ;
}
}
?>