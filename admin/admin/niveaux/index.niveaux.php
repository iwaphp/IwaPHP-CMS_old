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
	if (isset($_GET['modifier'])) {
			
			if (isset($_POST['niveau'])) {
				# tri des valeurs dans une variable
				$var_droits = null;
				$var_droits .= (isset($_POST['utilisateurs']) ? (!empty($_POST['utilisateurs']) ? ', '.$_POST['utilisateurs'] : null) : null);
				$var_droits .= (isset($_POST['apparence']) ? (!empty($_POST['apparence']) ? ', '.$_POST['apparence'] : null) : null);
				$var_droits .= (isset($_POST['configuration']) ? (!empty($_POST['configuration']) ? ', '.$_POST['configuration'] : null) : null);
				$var_droits .= (isset($_POST['communication']) ? (!empty($_POST['communication']) ? ', '.$_POST['communication'] : null) : null);
				$var_droits .= (isset($_POST['config_server']) ? (!empty($_POST['config_server']) ? ', '.$_POST['config_server'] : null) : null);
				$var_droits .= (isset($_POST['modules']) ? (!empty($_POST['modules']) ? ', '.$_POST['modules'] : null) : null);
				
				$db->sql_query("UPDATE ".$db->prefix_tables."niveaux SET numero='" .$_POST['niveau']. "' WHERE id='".$_GET['modifier']."'");
				$db->sql_query("UPDATE ".$db->prefix_tables."niveaux SET valeur='" .substr($var_droits,1). "' WHERE id='".$_GET['modifier']."'");
				
				$body .= submit_form;
			 } else {
				$body .= $operation->OpenFormPost ('niveaux&modifier='.$_GET['modifier'].'', 'permissions', 'Modifier niveau utilisateur');
				$retour = $db->sql_query('SELECT * FROM '.$db->prefix_tables.'niveaux WHERE id="'.$_GET['modifier'].'"');
				$donnees = $db->sql_fetchrow($retour);
					$body .='<table width="100%" border="0" cellspacing="1" cellpadding="0">
			  <tr>
				<td id="tableau">Niveau :</td>
				<td id="tableau"><label for="textfield"></label>
				<input type="text" name="niveau" id="textfield" value="'.$donnees['numero'].'" /></td>
			  </tr>
			  <tr>';
			    $body .='<td id="tableau">Droits :</td><td id="tableau">';			 
	$db_level = $db->sql_query("SELECT * FROM ".$db->prefix_tables."niveaux WHERE numero='".$donnees['numero']."'");
	$result_level = $db->sql_fetchrow($db_level);
	
		# Recherche si une de ces partie est existante 
		if (preg_match("/\butilisateurs\b/i", $result_level['valeur'])) 
		{
		
			$body .='<input type="checkbox" name="utilisateurs" value="utilisateurs" checked/>
				  <label for="utilisateurs"></label>
				  Utilisateurs<br />';
		
		} else {
		
			$body .='<input type="checkbox" name="utilisateurs" value="utilisateurs" />
				  <label for="utilisateurs"></label>
				  Utilisateurs<br />';
				  
		}
		
		# Recherche si une de ces partie est existante 
		if (preg_match("/\bapparence\b/i", $result_level['valeur'])) 
		{
		
			$body .='<input type="checkbox" name="apparence" value="apparence" checked/>
				  <label for="apparence"></label>
				  Apparence<br />';
		
		} else {
		
			$body .='<input type="checkbox" name="apparence" value="apparence" />
				  <label for="apparence"></label>
				  Apparence<br />';
				  
		}
		
		# Recherche si une de ces partie est existante 
		if (preg_match("/\bconfiguration\b/i", $result_level['valeur'])) 
		{
		
			$body .='<input type="checkbox" name="configuration" value="configuration" checked/>
				  <label for="configuration"></label>
				  Configuration<br />';
		
		} else {
		
			$body .='<input type="checkbox" name="configuration" value="configuration" />
				  <label for="configuration"></label>
				  Configuration<br />';
				  
		}	
				
		
		# Recherche si une de ces partie est existante 
		if (preg_match("/\bcommunication\b/i", $result_level['valeur'])) 
		{
		
			$body .='<input type="checkbox" name="communication" value="communication" checked/>
				  <label for="communication"></label>
				  Communication<br />';
		
		} else {
		
			$body .='<input type="checkbox" name="communication" value="communication" />
				  <label for="communication"></label>
				  Communication<br />';
				  
		}	
		
		# Recherche si une de ces partie est existante 
		if (preg_match("/\bconfig_server\b/i", $result_level['valeur'])) 
		{
		
			$body .='<input type="checkbox" name="config_server" value="config_server" checked/>
				  <label for="config_server"></label>
				  Configuration du serveur<br />';
		
		} else {
		
			$body .='<input type="checkbox" name="config_server" value="config_server" />
				  <label for="config_server"></label>
				  Configuration du serveur<br />';
				  
		}	
		
		# Recherche si une de ces partie est existante 
		if (preg_match("/\bmodules\b/i", $result_level['valeur'])) 
		{
		
			$body .='<input type="checkbox" name="modules" value="modules" checked/>
				  <label for="modules"></label>
				  Modules';
		
		} else {
		
			$body .='<input type="checkbox" name="modules" value="modules" />
				  <label for="modules"></label>
				  Modules';
				  
		}	
		$body .='
				  
				  
				  
				  </td>
			  </tr>
			';
					$body .= $operation->CloseFormPost ();
	
			}

	}
	elseif (isset($_GET['ajouter'])) {
						
			if (isset($_POST['niveau'])) {
						# tri des valeurs dans une variable
							$var_droits = null;
							$var_droits .= (isset($_POST['utilisateurs']) ? (!empty($_POST['utilisateurs']) ? ', '.$_POST['utilisateurs'] : null) : null);
							$var_droits .= (isset($_POST['apparence']) ? (!empty($_POST['apparence']) ? ', '.$_POST['apparence'] : null) : null);
							$var_droits .= (isset($_POST['configuration']) ? (!empty($_POST['configuration']) ? ', '.$_POST['configuration'] : null) : null);
							$var_droits .= (isset($_POST['communication']) ? (!empty($_POST['communication']) ? ', '.$_POST['communication'] : null) : null);
							$var_droits .= (isset($_POST['config_server']) ? (!empty($_POST['config_server']) ? ', '.$_POST['config_server'] : null) : null);
							$var_droits .= (isset($_POST['modules']) ? (!empty($_POST['modules']) ? ', '.$_POST['modules'] : null) : null);
				
				$db->sql_query("INSERT INTO ".$db->prefix_tables."niveaux (`id`, `numero`, `valeur`) VALUES (NULL, '".$_POST['niveau']."', '" .substr($var_droits,1). "')");
				
				$body .= submit_form;
			} else {
						$body .= $operation->OpenFormPost ('niveaux&ajouter', 'permissions', 'Ajouter niveau utilisateur');
						$body .='<table width="100%" border="0" cellspacing="1" cellpadding="0">
				  <tr>
					<td id="tableau">Niveau :</td>
					<td id="tableau"><label for="textfield"></label>
					<input type="text" name="niveau" id="textfield" /></td>
				  </tr>
				  ';
				  
	
					$body .='<td id="tableau">Droits :</td>
					<td id="tableau"><input type="checkbox" name="utilisateurs" value="utilisateurs" />
					  <label for="utilisateurs"></label>
					  Utilisateurs<br />
					  <input type="checkbox" name="apparence" value="apparence" />
					  <label for="apparence"></label>
					  Apparence<br />
					  <input type="checkbox" name="configuration" value="configuration" />
					  <label for="configuration"></label>
					  Configuration<br />
					  <input type="checkbox" name="communication" value="communication" />
					  <label for="communication"></label>
					  Communication<br />
					  <input type="checkbox" name="config_server" value="config_server" />
					  <label for="config_server"></label>
					  Configuration du serveur<br />
					  <input type="checkbox" name="modules" value="modules" />
					  <label for="modules"></label>
					  Modules</td>
				  </tr>
				';
						$body .= $operation->CloseFormPost ();
			}
	}
	elseif (isset($_GET['supprimer'])) {
			$db->sql_query("DELETE FROM ".$db->prefix_tables."niveaux WHERE id='".$_GET['supprimer']."'");
			$body .= submit_form;
	} else {



		$body .= $operation->OpenFormPost ('niveaux', 'permissions', 'Niveaux utilisateurs');
		$body .='<table width="100%"  border="0" cellspacing="2" cellpadding="0">
		<tr>
		<td id="titre_tableau"><strong>Niveau</strong></td>
		<td id="titre_tableau"><strong>Droits</strong></td>
		<td id="titre_tableau"><strong>Actions</strong></td>
		</tr>';
		
		$retour = $db->sql_query('SELECT * FROM '.$db->prefix_tables.'niveaux ORDER BY id DESC');
		while ($donnees = $db->sql_fetchrow($retour)) 
		{
			$body .='<tr>
			<td id="tableau">'.stripslashes($donnees['numero']).'</td>
			
			
			<td id="tableau">'.stripslashes($donnees['valeur']).'</td>';
			

			
	
			$body .='<td id="tableau"><div align="center">[ <a href="index.php?admin&op=niveaux&modifier=' . $donnees['id'] . '">'.MODIF_NEWS.'</a> | <a href="index.php?admin&op=niveaux&supprimer=' . $donnees['id'] . '">'.SUPPRIMER_NEWS.'</a> ]</div></td>
			</tr>';
			
		} 
		$body .= '</table></fieldset><br><fieldset><legend>Actions</legend><table width="100%"  border="0" cellspacing="2" id="tableau">
		<tr><td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/add.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
		<td><a onMouseOver="poplink(\'Ajouter un niveau\');" onmouseout="killlink()" href="index.php?admin&op=niveaux&ajouter">Ajouter</a></td>
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