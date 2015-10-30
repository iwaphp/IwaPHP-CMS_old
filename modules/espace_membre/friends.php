<?php
# IwaPHP CMS - Système de gestion de contenu 

	
if (!isset($_SESSION['pseudo'])) { $body .= erreur ; } else {


	if(isset($_GET['ajouter']) && isset($_GET['id'])) {
		
		$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$_GET['ajouter']."'");
		$result = $db->sql_fetchrow($data);
		$db->sql_query("INSERT INTO ".$db->prefix_tables."friends 
		(`id_`, `pseudo`, `id_ami`, `pseudo_ami`, `ami_depuis`, `accept`, `id`, `bloquer`) 
		VALUES ('".$utilisateur->idUtilisateur."', '".$utilisateur->nomUtilisateur."', '".$_GET['ajouter']."', '".$result['pseudo']."', '', '0', NULL, '0')");
		$body .= $theme_open_boite;
		$body .= submit_form;
		$body .= $theme_close_boite;
		
	} elseif(isset($_GET['annuler']) && isset($_GET['id'])) {
	
		$db->sql_query("DELETE FROM ".$db->prefix_tables."friends WHERE id_ami='".$_GET['annuler']."' AND id_='".$_GET['id']."'");
		$body .= $theme_open_boite;
		$body .= submit_form;
		$body .= $theme_close_boite;
		
	} elseif(isset($_GET['retirer']) && isset($_GET['id'])) {
	
		$db->sql_query("DELETE FROM ".$db->prefix_tables."friends WHERE id_ami='".$_GET['retirer']."' AND id_='".$_GET['id']."'");
		$db->sql_query("DELETE FROM ".$db->prefix_tables."friends WHERE id_='".$_GET['retirer']."' AND id_ami='".$_GET['id']."'");
		$body .= $theme_open_boite;
		$body .= submit_form;
		$body .= $theme_close_boite;
		
	} elseif(isset($_GET['refuser']) && isset($_GET['id'])) {
	
		$db->sql_query("DELETE FROM ".$db->prefix_tables."friends WHERE id_='".$_GET['refuser']."' AND id_ami='".$_GET['id']."'");
		$body .= $theme_open_boite;
		$body .= submit_form;
		$body .= $theme_close_boite;
		
	
	} elseif(isset($_GET['accepter']) && isset($_GET['id'])) {
	
		$db->sql_query("UPDATE ".$db->prefix_tables."friends SET accept='1' WHERE id_ami='".$_GET['id']."' AND id_='".$_GET['accepter']."'");
		$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$_GET['accepter']."'");
		$result = $db->sql_fetchrow($data);
		$db->sql_query("INSERT INTO ".$db->prefix_tables."friends 
		(`id_`, `pseudo`, `id_ami`, `pseudo_ami`, `ami_depuis`, `accept`, `id`, `bloquer`) 
		VALUES ('".$utilisateur->idUtilisateur."', '".$utilisateur->nomUtilisateur."', '".$_GET['accepter']."', '".$result['pseudo']."', '', '1', NULL, '0')");
	
		$body .= $theme_open_boite;
		$body .= submit_form;
		$body .= $theme_close_boite;
		
	} elseif(isset($_GET['bloquer']) && isset($_GET['id'])) {
	
		$db->sql_query("UPDATE ".$db->prefix_tables."friends SET bloquer='1' WHERE id_ami='".$_GET['bloquer']."' AND id_='".$_GET['id']."'");
		$body .= $theme_open_boite;
		$body .= submit_form;
		$body .= $theme_close_boite;
		
	} else {

		$body .= $theme_open_boite_titre;
		$body .= 'Liste d\'ami(e)s';
		$body .= $theme_close_boite_titre;
			
			$body .='<fieldset><legend>Invitation(s) en attente de confirmation :</legend>';
			
				$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."friends WHERE id_ami='".$utilisateur->idUtilisateur."' AND pseudo_ami='".$utilisateur->nomUtilisateur."' AND accept='0'");
				while ($result = $db->sql_fetchrow($data)) {
					$body .='<a href="'.$index->targetfile.'=memberlist&profil='.$result['id_'].'">- '.$result['pseudo'].'</a>     [ <a href="index.php?page=espace_membre&dossier=friends&accepter='.$result['id_'].'&id='.$utilisateur->idUtilisateur.'">Accepter</a> ] - [ <a href="index.php?page=espace_membre&dossier=friends&refuser='.$result['id_'].'&id='.$utilisateur->idUtilisateur.'">Refuser</a> ]<br />';
				}
				
			$body .='</fieldset><br />';
			$body .='<fieldset><legend>Demande(s) d\'ajout en attente :</legend><table width="100%" border="0">';
			$body .='<tr>';
			$body .='<td width="48" id="titre_tableau"><strong>Avatar</strong></td>';
			$body .='<td id="titre_tableau"><strong>Identifiant de l\'ami(e)</strong></td>';
			
			$body .='<td id="titre_tableau"><strong>Actions</strong></td>';
			$body .='</tr>';
			
			$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."friends WHERE id_='".$utilisateur->idUtilisateur."' AND pseudo='".$utilisateur->nomUtilisateur."'");
			while ($result = $db->sql_fetchrow($data))
			{
				$data1 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$result['id_ami']."'");
				$result1 = $db->sql_fetchrow($data1);
				
				if ($result['accept'] == 0) {
					$body .='<tr>';
					$body .='<td id="tableau"><img src="'.(!empty($result1['avatar']) ? $result1['avatar'] : 'images/noavatar.png').'" alt="" border="0" width="48" height="48" /></td>';
					$body .='<td id="tableau"><a href="index.php?page=memberlist&profil='.$result['id_ami'].'">'.$result['pseudo_ami'].'</a></td>';
					
					$body .='<td id="tableau"><a href="index.php?page=espace_membre&dossier=friends&annuler='.$result['id_ami'].'&id='.$utilisateur->idUtilisateur.'">- Annuler la demande</a><br />
												
												<br /></td>';
					$body .='</tr>';
				} 
				
				
				
			}
			$body .='</table></fieldset><br />';
			
			$body .='<fieldset><legend>Ami(e)s :</legend><table width="100%" border="0">';
			$body .='<tr>';
			$body .='<td width="48" id="titre_tableau"><strong>Avatar</strong></td>';
			$body .='<td id="titre_tableau"><strong>Identifiant de l\'ami(e)</strong></td>';
			$body .='<td id="titre_tableau"><strong>Date d\'ajout</strong></td>';
			$body .='<td id="titre_tableau"><strong>Actions</strong></td>';
			$body .='</tr>';
			
			$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."friends WHERE id_='".$utilisateur->idUtilisateur."' AND pseudo='".$utilisateur->nomUtilisateur."'");
			while ($result = $db->sql_fetchrow($data))
			{
				
				$data1 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$result['id_ami']."'");
				$result1 = $db->sql_fetchrow($data1);
				
				if ($result['accept'] == 1) {
					$body .='<tr>';
					$body .='<td id="tableau"><img src="'.(!empty($result1['avatar']) ? $result1['avatar'] : 'images/noavatar.png').'" alt="" border="0" width="48" height="48" /></td>';
					$body .='<td id="tableau"><a href="index.php?page=memberlist&profil='.$result['id_ami'].'">'.$result['pseudo_ami'].'</a></td>';
					$body .='<td id="tableau">'.$result['ami_depuis'].'</td>';
					$body .='<td id="tableau"><a href="index.php?page=espace_membre&dossier=friends&retirer='.$result['id_ami'].'&id='.$utilisateur->idUtilisateur.'">- Retirer de la liste</a><br />
												<a href="index.php?page=espace_membre&dossier=friends&bloquer='.$result['id_ami'].'&id='.$utilisateur->idUtilisateur.'">- Bloquer</a>
												<br /></td>';
					$body .='</tr>';
				}
				
				
				
			}

		$body .= '</table></fieldset>';	
		$body .= $theme_close_boite;
	}

}
