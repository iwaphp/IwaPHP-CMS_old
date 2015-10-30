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
		if (preg_match("/\bapparence\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >


	
	
		if (isset($_GET['modifier'])) {
			
			include ('admin/admin/disposition/modifier.disposition.php');
		
		}
		
		elseif (isset($_GET['supprimer'])) {
		
			$sql = "DELETE FROM ".$db->prefix_tables."menu WHERE id = ".$_GET['id']."";
			$db->sql_query($sql);
			$body .= submit_form ;
			
		}
		
		elseif (isset($_GET['renommer'])) {
		
			include ('admin/admin/disposition/renommer.disposition.php');
			
		}
		
		elseif (isset($_GET['monter'])) {
		
			$nbre_entrees = $_GET['position'] - 1;
									
			$sql = "UPDATE ".$db->prefix_tables."menu SET emplacement='".$_GET['emplacement']."', position='".$nbre_entrees."' WHERE id='".$_GET['id']."'";
			$db->sql_query($sql);
				
			header('location:index.php?admin&op=disposition');
			
		}
		
		elseif (isset($_GET['descendre'])) {
		
				$nbre_entrees = $_GET['position'] + 1;
									
				$sql = "UPDATE ".$db->prefix_tables."menu SET emplacement='".$_GET['emplacement']."', position='".$nbre_entrees."' WHERE id='".$_GET['id']."'";

				$db->sql_query($sql);
				
				header('location:index.php?admin&op=disposition');
		}
		elseif (isset($_GET['passer_a_droite'])) {
											
				$sql = "UPDATE ".$db->prefix_tables."menu SET emplacement='droite' WHERE id='".$_GET['id']."'";

				$db->sql_query($sql);
				
				header('location:index.php?admin&op=disposition');
		}
		elseif (isset($_GET['passer_a_gauche'])) {
				$sql = "UPDATE ".$db->prefix_tables."menu SET emplacement='gauche' WHERE id='".$_GET['id']."'";

				$db->sql_query($sql);
				
				header('location:index.php?admin&op=disposition');
		}
		elseif (isset($_GET['ajouter'])) {
		
			include ('admin/admin/disposition/ajouter.disposition.php');
			
		} else {
		
						$body .= '<fieldset><legend>Disposition des menus</legend>';
						
						$body .='<table width="100%"  border="0" cellspacing="0">
				  <tr>
					<td><table width="100%"  border="0" cellspacing="0">
				  <tr>
					<td width="100%" valign="top"></td>
					<td></td>
				  </tr>
				</table>
				<br /><strong>Emplacement gauche:</strong><br>
					  <table width="100%"  border="0" cellspacing="2">
						<tr>
						  <td id=titre_tableau width="25%"><strong>Titre du menu </strong></td>
						  <td id=titre_tableau width="25%"><strong>Type</strong></td>
						  <td id=titre_tableau width="25%"><strong>Emplacement/Position</strong></td>
						  <td id=titre_tableau width="25%"><strong>Actions</strong></td>
						</tr>';
						
						$req2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu WHERE emplacement='gauche' ORDER BY position");  
						while ($res2 = $db->sql_fetchrow($req2)) {
					  $body .='<tr>
						  <td id="tableau" width="25%">'.ucfirst($res2['titre']).'</td>';
						
						if ($res2['type'] == 'perso') { $body.='<td id="tableau" width="25%">Menu personnalis&eacute;</td>'; } else { $body.='<td id="tableau" width="25%">Menu dynamique</td>'; }
						  
						  $body.='<td id="tableau" width="25%">'.ucfirst($res2['emplacement']).'/'.$res2['position'].' [ <a href="index.php?admin&op=disposition&monter&id='.$res2['id'].'&emplacement='.$res2['emplacement'].'&position='.$res2['position'].'">-</a> ] [ <a href="index.php?admin&op=disposition&descendre&id='.$res2['id'].'&emplacement='.$res2['emplacement'].'&position='.$res2['position'].'">+</a> ]</td>';
						  
						  $body.='<td id="tableau" width="25%" align="center">';
					if ($res2['type'] == 'perso') { $body .='[ <a href="index.php?admin&op=disposition&modifier=liens&id='.$res2['id'].'">Modifier les liens</a> ]<br>'; } else { $body .=null; }
						$body .='[ <a href="index.php?admin&op=disposition&supprimer&id='.$res2['id'].'">Supprimer</a> ]';
						$body .= ($res2['type'] == 'perso' ? '<br>[ <a href="index.php?admin&op=disposition&renommer&id='.$res2['id'].'">Renommer</a> ]' : '') ; 
						$body .='<br>[ <a href="index.php?admin&op=disposition&passer_a_droite&id='.$res2['id'].'">Passer le menu à droite</a> ] 
					</td>';
						  
						  $body.='</tr>';
						}
						
					  $body .='</table>
					  <strong><br>
				Emplacement droite :</strong><br><table width="100%" border="0" cellspacing="2">
						<tr>
						  <td id=titre_tableau width="25%"><strong>Titre du menu </strong></td>
						  <td id=titre_tableau width="25%"><strong>Type</strong></td>
						  <td id=titre_tableau width="25%"><strong>Emplacement/Position</strong></td>
						  <td id=titre_tableau width="25%"><strong>Actions</strong></td>
						</tr>';
						
						$req3 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu WHERE emplacement='droite' ORDER BY position");  
						while ($res3 = $db->sql_fetchrow($req3)) {
					  $body .='<tr>
						  <td id="tableau" width="25%">'.ucfirst($res3['titre']).'</td>';
						
						if ($res3['type'] == 'perso') { $body.='<td id="tableau" width="25%">Menu personnalis&eacute;</td>'; } else { $body.='<td id="tableau" width="25%">Menu dynamique</td>'; }
						  
						  $body.='<td id="tableau" width="25%">'.ucfirst($res3['emplacement']).'/'.$res3['position'].' [ <a href="index.php?admin&op=disposition&monter&id='.$res3['id'].'&emplacement='.$res3['emplacement'].'&position='.$res3['position'].'">-</a> ] [ <a href="index.php?admin&op=disposition&descendre&id='.$res3['id'].'&emplacement='.$res3['emplacement'].'&position='.$res3['position'].'">+</a> ]</td>';
						  
						  $body.='<td id="tableau" width="25%" align="center">';
					if ($res3['type'] == 'perso') { $body .='[ <a href="index.php?admin&op=disposition&modifier=liens&id='.$res3['id'].'">Modifier les liens</a> ]<br>'; } else { $body .=null; }
						$body .='[ <a href="index.php?admin&op=disposition&supprimer&id='.$res3['id'].'">Supprimer</a> ]';
						$body .= ($res3['type'] == 'perso' ? '<br>[ <a href="index.php?admin&op=disposition&renommer&id='.$res3['id'].'">Renommer</a> ]' : '') ; 
						$body .='<br>[ <a href="index.php?admin&op=disposition&passer_a_gauche&id='.$res3['id'].'">Passer le menu à gauche</a> ] 
					</td>';
						  
						  $body.='</tr>';
						}
						
					  $body .='</table></td></tr></table><br><table width="100%"  border="0" cellspacing="2" id="tableau"><tr><td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
						<td><a onMouseOver="poplink(\'Ajouter\');" onmouseout="killlink()" href="index.php?admin&op=disposition&ajouter">Ajouter</a></td>
						</tr><tr>
					<td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
					<td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="index.php?admin">'.CANCEL.'</a></td>
				  </tr></table>';
						
					$body .= '</fieldset>';
		
		}
	
	
	
}
}

?>
