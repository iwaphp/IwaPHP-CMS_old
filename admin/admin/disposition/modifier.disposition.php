<?php
# IwaPHP CMS - Système de gestion de contenu 


if ($_GET['modifier'] == 'menu_dyn') {
			
			if (isset($_POST['menu_dyn_selected']) AND isset($_POST['select_emplacement'])) {
				$menu_dyn_selected = $_POST['menu_dyn_selected'];
				$emplacement = $_POST['select_emplacement'];
				
																
				
				$sql = "UPDATE ".$db->prefix_tables."menu SET  titre='".$menu_dyn_selected."' emplacement='".$emplacement."' WHERE id='".$_GET['id']."')";
				$db->sql_query($sql);
				
				
				header('location:index.php?admin&op=disposition');
				}
			
			$body .= '<fieldset><legend>Disposition des menus</legend>';	
			$body.='<form name="form1" method="post" action="index.php?admin&op=disposition&modifier=menu_dyn"><table width="100%"  border="0" cellspacing="0">
			<tr>
			<td>Choix du menu dynamique :<br /> ';
			
			$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."module WHERE statut='install'");  
			while ($data = $db->sql_fetchrow($select)) {
			
				if (file_exists($index->rootpath . '/modules/'.$data['nom'].'/menu.'.$data['nom'] . $index->phpEx)) {
				
				require $index->rootpath . '/modules/'.$data['nom'].'/menu.'.$data['nom'] . $index->phpEx;
				
				$body .='<table width="100%"  border="1" cellspacing="0">
  <tr>
    <td width="20">';
	$select2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu WHERE id='".$_GET['id']."'");  
	$data2 = $db->sql_fetchrow($select2);
	
	$body .= ($data['nom'] == $data2['titre'] ? '<input type="radio" name="menu_dyn_selected" value="'.$data['nom'].'" checked>' : '<input type="radio" name="menu_dyn_selected" value="'.$data['nom'].'">');
	
	$body .='</td>
    <td width="350"><strong>'.$menu_dyn_name.'</strong><br>
      '.$menu_dyn_description.' </td>
    <td>Aper&ccedil;u : <br>
    <img src="modules/'.$data['nom'].'/menu/'.$data['nom'].'.'.$exImg.'"></td>
  </tr>
</table>';
				
				} else { 
				
				require $index->rootpath . '/modules/'.$data['nom'].'/admin_info' . $index->phpEx;
				
					if ($exists_menu_dyn != 'enabled') {
					
					$body .='';

					} else {
				
					$body .= '<br />Module <b>'.$data['nom'].'</b> incomplet.<br />'; 
					
					}
				
				}
			
			
			
			}
			
			$body .='<br />
			 Placer à <select name="select_emplacement">
    <option value="gauche">Gauche</option>
    <option value="droite">Droite</option>
  </select><br /><br />
			</td>
			</tr>
			<tr>
			<td><input type="submit" name="Submit" value="Ajouter le menu"></td>
			</tr>
			</table> <br /><table width="100%"  border="0" cellspacing="0">
  <tr>
    <td width="48">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
    <td><a href="index.php?admin&op=disposition">Retour</a></td>
  </tr>
</table>
			</form>';
			
			
			$body .= '</fieldset>'; 
			} 					
			elseif ($_GET['modifier'] == 'liens') {
			
				if (isset($_GET['modifier_lien'])) {
				
					if (isset($_POST['nom']) AND isset($_POST['url'])) {
					
					$nom = $_POST['nom'];
					$url = $_POST['url'];
					
					$db->sql_query("UPDATE ".$db->prefix_tables."menu_contenu SET  valeur='".$nom."', url='".$url."' WHERE id='".$_GET['id_lien']."'");
					
					header('location:index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'');
					} else {
				
					
			$body .= '<fieldset><legend>Editer un lien</legend>';
			
			
			
				
				$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu_contenu WHERE id='".$_GET['id_lien']."'");  
				$data = $db->sql_fetchrow($select);
				
				$body .='<form name="form1" method="post" action="index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'&modifier_lien&id_lien='.$_GET['id_lien'].'"><table width="100%"  border="0" cellspacing="0">
  <tr>
    <td>     <table width="100%"  border="0" cellspacing="0">
        <tr>
		<td><strong>Modifier un lien</strong></td>
          <td>Nom :
            <input type="text" name="nom" value="'.$data['valeur'].'"></td>
          <td>Url :
            <input type="text" name="url" value="'.$data['url'].'"></td>
        </tr>
      </table>
      
</td>
    <td><input type="submit" name="Submit" value="Modifier"></td>
  </tr>
</table> </form>';
			$body .= '</fieldset><br />' ;
					}
				}
				
				elseif (isset($_GET['supprimer_lien'])) { 
				$sql = "DELETE FROM ".$db->prefix_tables."menu_contenu WHERE id = ".$_GET['id_lien']."";
				$db->sql_query($sql);
				header('location:index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'');
				
				}
				
				elseif (isset($_GET['monter_lien'])) { 
				
				$nbre_entrees = $_GET['position'] - 1;
									
				$sql = "UPDATE ".$db->prefix_tables."menu_contenu SET position='".$nbre_entrees."' WHERE id='".$_GET['id_lien']."'";
				$db->sql_query($sql);
				
				header('location:index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'');
				}
				
				if (isset($_GET['descendre_lien'])) { 
				$nbre_entrees = $_GET['position'] + 1;
									
				$sql = "UPDATE ".$db->prefix_tables."menu_contenu SET position='".$nbre_entrees."' WHERE id='".$_GET['id_lien']."'";
				$db->sql_query($sql);
				
				header('location:index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'');
				} else {
			
			if (isset($_POST['nom']) AND isset($_POST['url'])) {
					
					$nom = $_POST['nom'];
					$url = $_POST['url'];
					
					$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu WHERE id='".$_GET['id']."'");  
					$data = $db->sql_fetchrow($select);
					
					$select2 = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."menu_contenu WHERE titre='".$data['titre']."'");  
				$data2 = $db->sql_fetchrow($select2);
				
					
					$entrees_sql = $data2['nbre_entrees'];

					$nbre_entrees = $entrees_sql + 1;
														
				
				$sql = "INSERT INTO ".$db->prefix_tables."menu_contenu VALUES ('', '".$data['titre']."', '".$nom."', '".$url."', '".$nbre_entrees."', 'lien')";
				$db->sql_query($sql);
				
					
						
					header('location:index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'');
					} else {
			
			$body .= '<fieldset><legend>Disposition des menus</legend>';
			
			$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu WHERE id='".$_GET['id']."'");  
			$data = $db->sql_fetchrow($select);
			
			
			$body .='<form name="form1" method="post" action="index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'"><table width="100%"  border="0" cellspacing="0">
  <tr>
    <td>     <table width="100%"  border="0" cellspacing="0">
        <tr>
		<td><strong>Ajouter un lien</strong></td>
          <td>Nom :
            <input type="text" name="nom"></td>
          <td>Url :
            <input type="text" name="url"></td>
        </tr>
      </table>
      
</td>
    <td><input type="submit" name="Submit" value="Ajouter"></td>
  </tr>
</table> </form>
<br>

<table width="100%"  border="0" cellspacing="2">
  <tr>
    <td id="titre_tableau"><strong>Nom</strong></td>
    <td id="titre_tableau"><strong>Url</strong></td>
	<td id="titre_tableau"><strong>Position</strong></td>
    <td id="titre_tableau"><strong>Actions</strong></td>
  </tr>';
  
  $select2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."menu_contenu WHERE titre='".$data['titre']."' ORDER BY position");  
			while ($data2 = $db->sql_fetchrow($select2)) {
  $body .='<tr>
    <td id="tableau" width="25%">'.$data2['valeur'].'</td>
    <td id="tableau" width="25%">'.$data2['url'].'</td>
	<td id="tableau" width="25%"><input type="text" name="position" value="'.$data2['position'].'"> [ <a href="index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'&monter_lien&id_lien='.$data2['id'].'&position='.$data2['position'].'">-</a> | <a href="index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'&descendre_lien&id_lien='.$data2['id'].'&position='.$data2['position'].'">+</a> ]</td>
    <td id="tableau" width="25%">[ <a href="index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'&supprimer_lien&id_lien='.$data2['id'].'">Supprimer</a> | <a href="index.php?admin&op=disposition&modifier=liens&id='.$_GET['id'].'&modifier_lien&id_lien='.$data2['id'].'">Modifier</a> ] </td>
  </tr>';
  }
  $body .='</table>';
			$body .= '</fieldset>' ;	
			
		}	} }
		
		
?>