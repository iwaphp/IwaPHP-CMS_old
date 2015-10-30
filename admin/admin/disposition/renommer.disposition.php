<?php
# IwaPHP CMS - Système de gestion de contenu 


		if (isset($_POST['titre_menu_perso'])) {
		
		$titre_menu_perso	= htmlentities($_POST['titre_menu_perso']);
		
			$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu WHERE id='".$_GET['id']."'");  
			$data = $db->sql_fetchrow($select);	
			
			$select2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu_contenu WHERE titre='".$data['titre']."'");  
			while ($data2 = $db->sql_fetchrow($select2)) {	
		
			$db->sql_query("UPDATE ".$db->prefix_tables."menu_contenu SET  titre='".$titre_menu_perso."' WHERE id='".$data2['id']."'");	
			
			}
			
		$db->sql_query("UPDATE ".$db->prefix_tables."menu SET  titre='".$titre_menu_perso."' WHERE id='".$_GET['id']."'");
		
		header('location:index.php?admin&op=disposition');
		
		} else {
		
			
			$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu WHERE id='".$_GET['id']."'");  
			$data = $db->sql_fetchrow($select);	
			
		
			$body .= '<fieldset><legend>Disposition des menus</legend>';
			
			
			
			$body.='<form name="form1" method="post" action="index.php?admin&op=disposition&renommer&id='.$_GET['id'].'"><table width="100%"  border="0" cellspacing="0">
			<tr>
			<td>Modifier le titre de votre menu personnalis&eacute; : 
      
			<input type="text" name="titre_menu_perso" value="'.$data['titre'].'"><br />
			<br />
			</td>
			</tr>
			<tr>
			<td><input type="submit" name="Submit" value="Modifier"></td>
			</tr>
			</table> <br /><table width="100%"  border="0" cellspacing="0">
  <tr>
    
    <td><table width="100%"  border="0" cellspacing="2" id="tableau">
				<tr>
		<td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
		<td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="index.php?admin&op=disposition">'.CANCEL.'</a></td>
		</tr>
		</table></td>
  </tr>
</table>
			</form>';
			
			$body .= '</fieldset>' ;
		}
		
		?>