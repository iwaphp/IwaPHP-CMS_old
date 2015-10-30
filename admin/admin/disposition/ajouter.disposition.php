<?php
# IwaPHP CMS - Système de gestion de contenu 


		
		
		
			if ($_GET['ajouter'] == 'menu_personnalise') {
			
				if (isset($_POST['titre_menu_perso']) AND isset($_POST['select_emplacement'])) {
				$titre_menu_perso = addslashes($_POST['titre_menu_perso']);
				$emplacement = $_POST['select_emplacement'];
				
				$select = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."menu WHERE emplacement='".$emplacement."'");  
				$data = $db->sql_fetchrow($select);
				
					
					$entrees_sql = $data['nbre_entrees'];

					$nbre_entrees = $entrees_sql + 1;
														
				
				$sql = "INSERT INTO ".$db->prefix_tables."menu VALUES ('', '".$titre_menu_perso."', '".$emplacement."', '".$nbre_entrees."', 'perso')";
				$db->sql_query($sql);
				
				header('location:index.php?admin&op=disposition');
				}
				
			$body .= '<fieldset><legend>Disposition des menus</legend>' ;
			
			$body.='<form name="form1" method="post" action="index.php?admin&op=disposition&ajouter=menu_personnalise"><table width="100%"  border="0" cellspacing="0">
			<tr>
			<td>Titre de votre menu personnalis&eacute; : 
      
			<input type="text" name="titre_menu_perso"><br />
			 Placer à <select name="select_emplacement">
    <option value="gauche">Gauche</option>
    <option value="droite">Droite</option>
  </select><br /><br />
			</td>
			</tr>
			<tr>
			<td><input type="submit" name="Submit" value="Ajouter le menu"></td>
			</tr>
			</table> <br /><table width="100%" border="0" cellspacing="2" id="tableau">
  <tr>
    <td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
    <td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="index.php?admin&op=disposition&ajouter">'.CANCEL.'</a></td>
  </tr>
</table>
			</form>';
			
			$body .= '</fieldset>' ;
			
			} 
			elseif ($_GET['ajouter'] == 'menu_dynamique') {
			
			if (isset($_POST['menu_dyn_selected']) AND isset($_POST['select_emplacement'])) {
				$menu_dyn_selected = $_POST['menu_dyn_selected'];
				$emplacement = $_POST['select_emplacement'];
				
				$select = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."menu WHERE emplacement='".$emplacement."'");  
				$data = $db->sql_fetchrow($select);
				
					
					$entrees_sql = $data['nbre_entrees'];

					$nbre_entrees = $entrees_sql + 1;
														
				
				$sql = "INSERT INTO ".$db->prefix_tables."menu VALUES ('', '".$menu_dyn_selected."', '".$emplacement."', '".$nbre_entrees."', 'fixe');";
				$db->sql_query($sql);
				
				$ajout_module = "INSERT INTO ".$db->prefix_tables."menu_module VALUES ('', '".$menu_dyn_selected."', '".$menu_dyn_selected."');";
				
				header('location:index.php?admin&op=disposition');
				}
			
			$body .= '<fieldset><legend>Disposition des menus</legend>';
			
			$body.='<form name="form1" method="post" action="index.php?admin&op=disposition&ajouter=menu_dynamique"><table width="100%"  border="0" cellspacing="2">
			<tr>
			<td>Menus dynamique disponibles :<br /> <table width="100%"  border="0" cellspacing="2">';
			
			$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."module WHERE active_menu='1'");  
			while ($data = $db->sql_fetchrow($select)) {
			
				if (file_exists($index->rootpath . '/modules/'.$data['nom'].'/menu.'.$data['nom'].'.php')) {
				
				require $index->rootpath . '/modules/'.$data['nom'].'/menu.'.$data['nom'].'.php';
				
				$body .='
				  <tr>
					<td id=tableau width="20"><input type="radio" name="menu_dyn_selected" value="'.$data['nom'].'" /></td>
					<td id=tableau width="350"><strong>'.$menu_dyn_name.'</strong><br>
					  '.$menu_dyn_description.' </td>
					
				  </tr>';
				
				}
			
			
			
			}
			
			$body .='</table><br />
			 Placer à <select name="select_emplacement">
    <option value="gauche">Gauche</option>
    <option value="droite">Droite</option>
  </select><br /><br />
			</td>
			</tr>
			<tr>
			<td><input type="submit" name="Submit" value="Ajouter le menu"></td>
			</tr>
			</table> <br /><table width="100%" border="0" cellspacing="2" id="tableau">
  <tr>
    <td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
    <td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="index.php?admin&op=disposition&ajouter">'.CANCEL.'</a></td>
  </tr>
</table>
			</form>';
			
			$body .= '</fieldset>' ;
			
			} else {
				$body .= '<fieldset><legend>Disposition des menus</legend>
				<table width="100%"  border="0" cellspacing="2" id="tableau">
  <tr>
    <td width="48">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
    <td><a href="index.php?admin&op=disposition&ajouter=menu_personnalise">Ajouter un menu personnalis&eacute;</a></td>
  </tr>
  <tr>
    <td width="48">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
    <td><a href="index.php?admin&op=disposition&ajouter=menu_dynamique">Ajouter un menu dynamique</a></td>
  </tr>
  <tr>
    <td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
    <td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="index.php?admin&op=disposition">'.CANCEL.'</a></td>
  </tr>
</table>';
			$body .= '</fieldset>';
			}
		?>