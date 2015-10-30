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
		if (preg_match("/\butilisateurs\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >
		
$contenu = null;

if (isset($_GET['ajouter'])) { 
		
		
		
		if (isset($_POST['nom']) && isset($_POST['niveaux']) && isset($_POST['description'])) 
		{
				$nom = $_POST['nom'];
				$description = $_POST['description'];
				$db->sql_query("INSERT INTO ".$db->prefix_tables."groupes (`id`, `nom`, `description`, `niveaux`, `couleur`) VALUES (NULL, '".$nom."', '".$description."', '".$_POST['niveaux']."', '')");
		
				$body .= submit_form;
		} else {
				$body .= $operation->OpenFormPost ('groupes&ajouter', 'groupes', 'Ajouter groupe');
				$body .='<table width="100%" border="0" cellspacing="1" cellpadding="0">
						  <tr>
							<td id="tableau">Nom du groupe:</td>
							<td id="tableau"><label for="textfield"></label>
							<input type="text" name="nom" id="textfield" /></td>
						  </tr>
						  <tr>
							<td id="tableau">Niveau attribu&eacute; :</td>
							<td id="tableau"><label for="textfield2"></label>
							<input type="text" name="niveaux" id="textfield2" /> Ex : 1 ou 2 ....</td>
						  </tr>
						  <tr>
							<td id="tableau">Description :</td>
							<td id="tableau"><label for="textarea"></label>
							<textarea name="description" id="textarea" cols="45" rows="5"></textarea></td>
						  </tr>';
				$body .= $operation->CloseFormPost ();
		}
		
} elseif (isset($_GET['modifier'])) { 
		
		
					if (isset($_POST['nom']) && isset($_POST['niveaux']) && isset($_POST['description'])) 
					{
						$nom = $_POST['nom'];
						$db->sql_query("UPDATE ".$db->prefix_tables."groupes SET nom='" . $nom . "' WHERE id='".$_GET['modifier']."'");
					
						$db->sql_query("UPDATE ".$db->prefix_tables."groupes SET niveaux='" . $_POST['niveaux'] . "' WHERE id='".$_GET['modifier']."'");
					
						$description = $_POST['description'];
						$db->sql_query("UPDATE ".$db->prefix_tables."groupes SET description='" . $description . "' WHERE id='".$_GET['modifier']."'");
						$body .= submit_form;
					} else {
								$body .= $operation->OpenFormPost ('groupes&modifier='.$_GET['modifier'].'', 'groupes', 'Ajouter groupe');	
							$retour = $db->sql_query('SELECT * FROM '.$db->prefix_tables.'groupes WHERE id="'.$_GET['modifier'].'"');
							$donnees = $db->sql_fetchrow($retour);
								$body .='<table width="100%" border="0" cellspacing="1" cellpadding="0">
						  <tr>
							<td id="tableau">Nom du groupe:</td>
							<td id="tableau"><label for="textfield"></label>
							<input type="text" name="nom" value="'.$donnees['nom'].'" /></td>
						  </tr>
						  <tr>
							<td id="tableau">Niveau attribu&eacute; :</td>
							<td id="tableau"><label for="textfield2"></label>
							<input type="text" name="niveaux" value="'.$donnees['niveaux'].'" /> Ex : 1 ou 2 ....</td>
						  </tr>
						  <tr>
							<td id="tableau">Description :</td>
							<td id="tableau"><label for="textarea"></label>
							<textarea name="description" id="textarea" cols="45" rows="5">'.$donnees['description'].'</textarea></td>
						  </tr>
												  
												';
								$body .= $operation->CloseFormPost ();
					}
} elseif (isset($_GET['supprimer'])) {  
 
					$db->sql_query("DELETE FROM ".$db->prefix_tables."groupes WHERE id='".$_GET['supprimer']."'");
					$body .= submit_form;
					
} else {
	

	$body .= '<fieldset><legend>Liste des groupes</legend><table width="100%" border="0" cellspacing="2" cellpadding="0">
	  <tr>
		<td id="titre_tableau"><strong>Nom du groupe</strong></td>
		<td id="titre_tableau"><strong>Description</strong></td>
		<td id="titre_tableau"><strong>Niveaux</strong></td>
		<td id="titre_tableau"><strong>Actions</strong></td>
	  </tr>';
	  
	   $retour = $db->sql_query('SELECT * FROM '.$db->prefix_tables.'groupes ORDER BY id DESC');
			while ($donnees = $db->sql_fetchrow($retour)) 
			{
				$body .= '<tr>
				<td><span style="color:'.$donnees['couleur'].'">'.stripslashes($donnees['nom']).'</span></td>';

				if 	(!empty($donnees['description'])) {
					$body .= '<td>'.stripslashes($donnees['description']).'</td>';
				} else {
					$body .= '<td><em>Aucune description</em></td>';
				}
				$body .= '<td>'.$donnees['niveaux'].'</td>';
				$body .= '<td><div align="center">[ <a href="index.php?admin&op=groupes&modifier=' . $donnees['id'] . '">'.MODIF_NEWS.'</a> | <a href="index.php?admin&op=groupes&supprimer=' . $donnees['id'] . '">'.SUPPRIMER_NEWS.'</a> ]</div></td>
				</tr>';
				
			}
	  
	$body .= '</table></fieldset><br><fieldset><legend>Actions</legend>
	
	
	
	

	
	
	
	
	
	<table width="100%"  border="0" cellspacing="2" id="tableau">

	<tr><td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
	  <td><a onMouseOver="poplink(\'Ajouter un rang/groupe\');" onmouseout="killlink()" href="index.php?admin&op=groupes&ajouter">Ajouter un groupe</a></td>
	  </tr>
	<tr>
		<td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
		<td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="index.php?admin">'.CANCEL.'</a></td>
	  </tr>
	  </table></fieldset>';
 }
 }
 }
?>