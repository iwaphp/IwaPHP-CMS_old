<?php
# IwaPHP CMS - Système de gestion de contenu 

if (!isset($_SESSION['pseudo'])) { $body .= erreur ; } else {	
	if (recuperer('activer_messagerie_privee') == 'oui') {
	if (isset($_GET['msg']))
{

	$db->sql_query("UPDATE `".$db->prefix_tables."mp` SET `lu` = '0' WHERE `".$prefix."mp`.`id` =".$_GET['msg']." LIMIT 1 ;");
	
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
	$body .='<table width="100%" id=toolbar border="0" cellspacing="0">';


	$new = ($donnees2['lu'] == 1) ? NEWW : '' ;
	$requetee2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$donnees2['id_expediteur']."'");
	$ideme2 = $db->sql_fetchrow($requetee2);
	// Affichage message
	$body .='<tr>';
	$body .='<td id="tableau" colspan="2">'.NAMEEXPMSG.' : '.$ideme2['pseudo'].'</td></tr>';
	$body .='<tr><td id="titre_tableau" width="50%"><strong>'.SUJET.' : '.$donnees2['sujet'].'</a></td>
<td id="titre_tableau" width="20%"><a href="'.$index->targetfile.'=messagerie&dossier=reception&action=del&id='.$donnees2['id'].'">'.SUPPRIMER_NEWS.'</a> ; <a href="'.$index->targetfile.'=messagerie&dossier=reception&action=ans&id='.$donnees2['id'].'">'.REPONDRE.'</a></td> <br>';
	$body .="</strong>";
	$body .='</td>';
	$body .='</tr>';
	$body .='<td id="tableau" colspan="2">'.MSG.' : <br />'.$donnees2['message'].'</td></tr>';
	$body .='</tr>';
	// Fin message
	$body .='</table>';
	$body .='<p>';
	$body .='</div>';
	$body .= $theme_close_boite ;
	
}
if (isset($_GET['action']))
{

	$body .=$theme_open_boite_titre ;
	$body .=MSG.' : N°'.$_GET['id'];
	$body .=$theme_close_boite_titre ;
	if ($_GET['action'] == "lu")
	{
		$requetee2 = $db->sql_query("UPDATE `".$db->prefix_tables."mp` SET `lu` = '0' WHERE `".$db->prefix_tables."mp`.`id` =".$_GET['id']." LIMIT 1 ;");
		$body .= MSG_MARQUER_LU.'  <meta http-equiv="refresh" content="3; url='.$index->targetfile.'=messagerie" />';
	}
	elseif ( $_GET['action'] == "del")
	{

		$requetee2 = $db->sql_query("UPDATE `".$db->prefix_tables."mp` SET `archiv` = '1' WHERE `".$db->prefix_tables."mp`.`id` =".$_GET['id']." LIMIT 1 ;");
		$body .= MSG_DEPLACER_DANS_CORBEILLE.'  <meta http-equiv="refresh" content="3; url='.$index->targetfile.'=messagerie" />';
	}
	elseif ($_GET['action'] == "ans")
	{
		if (isset($_POST['action']) and $_POST["action"]== "send" )
		{
			$body .= '<h3>'.REP_SEND.'</h3>';
			$db->sql_query("INSERT INTO ".$db->prefix_tables."mp VALUES (NULL , '".$_POST['idarecu']."', '".$_POST['idaenvoyer']."', '".$_POST['sujet']."', '".nl2br($_POST['message'])."','1','0','".time()."')");
		}
else {
		
		$requetem = $db->sql_query("SELECT * FROM ".$db->prefix_tables."mp WHERE `id`='".$_GET['id']."'");
		$idemm = mysql_fetch_array ($requetem);



		
		$destinataire = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE `id`='".$idemm['id_expediteur']."'");
		$rdestinataire = $db->sql_fetchrow($destinataire);
		
		$body .= '<h3>'.REP_MSG.'</h3>';
		$body .= '<table border="0">';
		$body .= '<form action="'.$index->targetfile.'=messagerie&dossier=reception&action=ans&id='.$_GET['id'].'" METHOD="POST">';
		$body.='<tr><td>'.DESTINATAIRE.' :</td><td><input type="text" value="'.$rdestinataire['pseudo'].'" name="dest"></td></tr>';
		$body.='<tr><td>'.SUJET.' :</td><td><input type="text" value="RE::'.$idemm['sujet'].'" name="sujet"></td></tr>';
		$body.='<tr><td>'.MSG.' :</td><td><textarea rows=5 cols=30 name=message>'.$rdestinataire['pseudo'].'  '.A_ECRIT.' : <<<'.$idemm['message'].'>>></textarea></td></tr>';
		$body.='<tr><td>&nbsp;</td><td>
		<input type="hidden" value="'.$idemm['id_expediteur'].'" name="idaenvoyer">
		<input type="hidden" value="'.$idemm['id_receveur'].'" name="idarecu">
		<input type="hidden" value="send" name="action">
		<input type="submit" value="'.ENVOYER.'"</td></tr>';

		$body .= '</form>';
		$body .= '</table>
		
		';
}	
}



	$body .= $theme_close_boite ;
}
		if (isset($_GET['msg_envoye'])) {
				$body .=$theme_open_boite_titre ;
				$body .= 'Messages envoy&eacute;s';
				$body .=$theme_close_boite_titre ;
				$body .='<table width="100%" cellspacing="0" border="0"><tr>
				<td width="120"><a href="index.php?page=memberlist&mp"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/ecrire.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/ecrire.png" alt="" width="48" height="48" \>').'<br />Ecrire un message</div></a></td>
				<td width="120"><a href="index.php?page=messagerie"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/inbox.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/inbox.png" alt="" width="48" height="48" \>').'<br />Boite de r&eacute;ception</div></a></td>
				<td width="120"><a href="index.php?page=messagerie&msg_envoye"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/envoye.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/envoye.png" alt="" width="48" height="48" \>').'<br />Messages envoy&eacute;s</div></a></td>
				<td width="120"><a href="index.php?page=messagerie&supprime"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/trash.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/trash.png" alt="" width="48" height="48" \>').'<br />Corbeille</div></a></td>
				<td width="120"><a href="index.php?page=memberlist"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/liste.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/liste.png" alt="" width="48" height="48" \>').'<br />Liste des membres</div></a></td>

				</tr></table>
				<table width="100%" border="0" cellspacing="0">';
				$body .='<tr>
							<td width="50" id="titre_tableau"></td>
							<td id="titre_tableau">Auteur</td>
							<td id="titre_tableau">Sujet</td>
							<td id="titre_tableau">Actions</td>';
				$body .='</tr>';

				$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."options");
				$data = $db->sql_fetchrow($select);
							

									$limit_par_feuille = $data['nbr_msg_privee_max_dossier']; 
									if (isset($_GET['feuille']) AND !empty($_GET['feuille']))
									{
											$feuille = intval($_GET['feuille']);
									}
									else
									{
											$feuille = 1;
									}
									$from = ($feuille - 1) * $limit_par_feuille;
									


				$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."mp WHERE archiv='0' and id_expediteur='".$utilisateur->idUtilisateur."' ORDER BY times DESC LIMIT ".$from.", ".$limit_par_feuille."");// Requête SQL
				while ($donnees = $db->sql_fetchrow($reponse) )
				{
					$new = ($donnees['lu'] == 1) ? (!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/unread.png" alt="" width="24" height="24" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/unread.png" alt="" width="24" height="24" \>') : (!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/read.png" alt="" width="24" height="24" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/read.png" alt="" width="24" height="24" \>') ;
					$requetee = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$donnees['id_expediteur']."'");
					$ideme = $db->sql_fetchrow($requetee);
					// Affichage message
					$body .='<tr>';
					$body .='<td valign="center" id="tableau" width="50">'.$new.'</td>';
					$body .='<td valign="center" id="tableau">'.$ideme['pseudo'].'</td>';
					$body .='<td valign="center" id="tableau"><strong><a href="'.$index->targetfile.'=messagerie&msg='.$donnees['id'].'">'.(!empty($donnees['sujet']) ? $donnees['sujet'] : 'Pas de sujet').'</a></td>
					<td valign="center" id="tableau">  <a href="'.$index->targetfile.'=messagerie&action=del&id='.$donnees['id'].'">'.SUPPRIMER_NEWS.'</a></td>';
					$body .="</strong>";
					$body .='</td>';
					$body .='</tr>';
				}
				// Fin message
				$body .='</table>';

				$requete = mysql_query("SELECT COUNT(id) AS nb_entrees FROM ".$db->prefix_tables."mp WHERE archiv='0' and id_expediteur='".$utilisateur->idUtilisateur."'");
						$donnees = mysql_fetch_assoc($requete);

							$nb_feuille = ceil($donnees['nb_entrees'] / $limit_par_feuille);
							$body .= '<br />Pages :&nbsp;';
							for ($i=1 ; $i<=$nb_feuille ; $i++)
							{
									if ($i == $feuille)
									{
											$body .= '&nbsp;['.$i.']&nbsp;';
									}
									else
									{
											$body .= '<a href="'.$index->targetfile.'=messagerie&amp;feuille='.$i.'">'.$i.'</a>';
									}
							}

				$body .= $theme_close_boite ;
		} elseif (isset($_GET['supprime'])) {
				$body .=$theme_open_boite_titre ;
				$body .= 'Corbeille';
				$body .=$theme_close_boite_titre ;
				$body .='<table width="100%" cellspacing="0" border="0"><tr>
				<td width="120"><a href="index.php?page=memberlist&mp"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/ecrire.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/ecrire.png" alt="" width="48" height="48" \>').'<br />Ecrire un message</div></a></td>
				<td width="120"><a href="index.php?page=messagerie"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/inbox.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/inbox.png" alt="" width="48" height="48" \>').'<br />Boite de r&eacute;ception</div></a></td>
				<td width="120"><a href="index.php?page=messagerie&msg_envoye"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/envoye.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/envoye.png" alt="" width="48" height="48" \>').'<br />Messages envoy&eacute;s</div></a></td>
				<td width="120"><a href="index.php?page=messagerie&supprime"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/trash.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/trash.png" alt="" width="48" height="48" \>').'<br />Corbeille</div></a></td>
				<td width="120"><a href="index.php?page=memberlist"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/liste.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/liste.png" alt="" width="48" height="48" \>').'<br />Liste des membres</div></a></td>

				</tr></table>
				<table width="100%" border="0" cellspacing="0">';
				$body .='<tr>
							<td width="50" id="titre_tableau"></td>
							<td id="titre_tableau">Auteur</td>
							<td id="titre_tableau">Sujet</td>
							<td id="titre_tableau">Actions</td>';
				$body .='</tr>';

				$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."options");
				$data = $db->sql_fetchrow($select);
							

									$limit_par_feuille = $data['nbr_msg_privee_max_dossier']; 
									if (isset($_GET['feuille']) AND !empty($_GET['feuille']))
									{
											$feuille = intval($_GET['feuille']);
									}
									else
									{
											$feuille = 1;
									}
									$from = ($feuille - 1) * $limit_par_feuille;
									


				$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."mp WHERE archiv='1' and id_receveur='".$utilisateur->idUtilisateur."' ORDER BY times DESC LIMIT ".$from.", ".$limit_par_feuille."");// Requête SQL
				while ($donnees = $db->sql_fetchrow($reponse) )
				{
					$new = ($donnees['lu'] == 1) ? (!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/unread.png" alt="" width="24" height="24" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/unread.png" alt="" width="24" height="24" \>') : (!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/read.png" alt="" width="24" height="24" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/read.png" alt="" width="24" height="24" \>') ;
					$requetee = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$donnees['id_expediteur']."'");
					$ideme = $db->sql_fetchrow($requetee);
					// Affichage message
					$body .='<tr>';
					$body .='<td valign="center" id="tableau" width="50">'.$new.'</td>';
					$body .='<td valign="center" id="tableau">'.$ideme['pseudo'].'</td>';
					$body .='<td valign="center" id="tableau"><strong><a href="'.$index->targetfile.'=messagerie&msg='.$donnees['id'].'">'.(!empty($donnees['sujet']) ? $donnees['sujet'] : 'Pas de sujet').'</a></td>
					<td valign="center" id="tableau">  </td>';
					$body .="</strong>";
					$body .='</td>';
					$body .='</tr>';
				}
				// Fin message
				$body .='</table>';

				$requete = mysql_query("SELECT COUNT(id) AS nb_entrees FROM ".$db->prefix_tables."mp WHERE archiv='1' and id_receveur='".$utilisateur->idUtilisateur."'");
						$donnees = mysql_fetch_assoc($requete);

							$nb_feuille = ceil($donnees['nb_entrees'] / $limit_par_feuille);
							$body .= '<br />Pages :&nbsp;';
							for ($i=1 ; $i<=$nb_feuille ; $i++)
							{
									if ($i == $feuille)
									{
											$body .= '&nbsp;['.$i.']&nbsp;';
									}
									else
									{
											$body .= '<a href="'.$index->targetfile.'=messagerie&amp;feuille='.$i.'">'.$i.'</a>';
									}
							}

				$body .= $theme_close_boite ;
		} else {
				$body .=$theme_open_boite_titre ;
				$body .=INBOX;
				$body .=$theme_close_boite_titre ;
				$body .='<table width="100%" cellspacing="0" border="0"><tr>
				<td width="120"><a href="index.php?page=memberlist&mp"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/ecrire.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/ecrire.png" alt="" width="48" height="48" \>').'<br />Ecrire un message</div></a></td>
				<td width="120"><a href="index.php?page=messagerie"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/inbox.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/inbox.png" alt="" width="48" height="48" \>').'<br />Boite de r&eacute;ception</div></a></td>
				<td width="120"><a href="index.php?page=messagerie&msg_envoye"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/envoye.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/envoye.png" alt="" width="48" height="48" \>').'<br />Messages envoy&eacute;s</div></a></td>
				<td width="120"><a href="index.php?page=messagerie&supprime"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/trash.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/trash.png" alt="" width="48" height="48" \>').'<br />Corbeille</div></a></td>
				<td width="120"><a href="index.php?page=memberlist"><div align="center" id="link_nav">'.(!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/liste.png" alt="" width="48" height="48" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/liste.png" alt="" width="48" height="48" \>').'<br />Liste des membres</div></a></td>

				</tr></table>
				<table width="100%" border="0" cellspacing="0">';
				$body .='<tr>
							<td width="50" id="titre_tableau"></td>
							<td id="titre_tableau">Auteur</td>
							<td id="titre_tableau">Sujet</td>
							<td id="titre_tableau">Actions</td>';
				$body .='</tr>';

				$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."options");
				$data = $db->sql_fetchrow($select);
							

									$limit_par_feuille = $data['nbr_msg_privee_max_dossier']; 
									if (isset($_GET['feuille']) AND !empty($_GET['feuille']))
									{
											$feuille = intval($_GET['feuille']);
									}
									else
									{
											$feuille = 1;
									}
									$from = ($feuille - 1) * $limit_par_feuille;
									


				$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."mp WHERE archiv='0' and id_receveur='".$utilisateur->idUtilisateur."' ORDER BY times DESC LIMIT ".$from.", ".$limit_par_feuille."");// Requête SQL
				while ($donnees = $db->sql_fetchrow($reponse) )
				{
					$new = ($donnees['lu'] == 1) ? (!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/unread.png" alt="" width="24" height="24" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/unread.png" alt="" width="24" height="24" \>') : (!empty($utilisateur->themeUtilisateur) ? '<img border=0 src="themes/'.$utilisateur->themeUtilisateur.'/images/messagerie/read.png" alt="" width="24" height="24" \>' : '<img border=0 src="themes/'.recuperer('theme').'/images/messagerie/read.png" alt="" width="24" height="24" \>') ;
					$lu = ($donnees['lu'] == 1) ? '<a href="'.$index->targetfile.'=messagerie&action=lu&id='.$donnees['id'].'">'.LU.'</a> ;' : '' ;
					$requetee = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$donnees['id_expediteur']."'");
					$ideme = $db->sql_fetchrow($requetee);
					// Affichage message
					$body .='<tr>';
					$body .='<td valign="center" id="tableau" width="50">'.$new.'</td>';
					$body .='<td valign="center" id="tableau">'.$ideme['pseudo'].'</td>';
					$body .='<td valign="center" id="tableau"><strong><a href="'.$index->targetfile.'=messagerie&msg='.$donnees['id'].'">'.(!empty($donnees['sujet']) ? $donnees['sujet'] : 'Pas de sujet').'</a></td>
					<td valign="center" id="tableau">'.$lu.'  <a href="'.$index->targetfile.'=messagerie&action=del&id='.$donnees['id'].'">'.SUPPRIMER_NEWS.'</a></td>';
					$body .="</strong>";
					$body .='</td>';
					$body .='</tr>';
				}
				// Fin message
				$body .='</table>';

				$requete = mysql_query("SELECT COUNT(id) AS nb_entrees FROM ".$db->prefix_tables."mp WHERE archiv='0' and id_receveur='".$utilisateur->idUtilisateur."'");
						$donnees = mysql_fetch_assoc($requete);

							$nb_feuille = ceil($donnees['nb_entrees'] / $limit_par_feuille);
							$body .= '<br />Pages :&nbsp;';
							for ($i=1 ; $i<=$nb_feuille ; $i++)
							{
									if ($i == $feuille)
									{
											$body .= '&nbsp;['.$i.']&nbsp;';
									}
									else
									{
											$body .= '<a href="'.$index->targetfile.'=messagerie&amp;feuille='.$i.'">'.$i.'</a>';
									}
							}

				$body .= $theme_close_boite ;
		}

}
}
?>