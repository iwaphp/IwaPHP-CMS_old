<?php
# IwaPHP CMS - Système de gestion de contenu 


if (!isset($_SESSION['pseudo'])) { $body .= $theme_open_boite . ERROR_SESSION . $theme_close_boite ; } else {

	if (isset($_GET['admin'])) {
	
		include $index->rootpath .'/modules/livredor/admin.php';

	} else {


		if (isset($_GET['action'])) {

			 # Determine le niveau de l'utilisateur en cours
				$db_user = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$utilisateur->idUtilisateur."'");
				$result_user = $db->sql_fetchrow($db_user);

				# Compare le niveau d'utilisateur
				$db_level = $db->sql_query("SELECT * FROM ".$db->prefix_tables."niveaux WHERE numero='".$result_user['grade']."'");
				$result_level = $db->sql_fetchrow($db_level);
				
			# Recherche si une de ces partie est existante pour le niveau de l'utilisateur trouvé
			if (preg_match("/\bmodules\b/i", $result_level['valeur'])) {

				if ($_GET['action'] == "supprimer") { 

					if (isset($_GET['id'])) { 
	 

						$db->sql_query("DELETE FROM `".$db->prefix_tables."livredor` WHERE `id` = ".$_GET['id']." ");

						$body .= $theme_open_boite . MODIF_PRIS_EN_COMPTE ;

						$body .= '<br><a href="'.$index->targetfile.'=livredor">'.RETOUR.'</a>' . $theme_close_boite ;
						
					
					}
					

				}
			}
			
			
		
		} else {




			if (isset($_POST['postContent']))
			{
 
				if (!empty($_POST['postContent'])) {   
				
				$message = addslashes($_POST['postContent']); 

					$db->sql_query("INSERT INTO ".$db->prefix_tables."livredor VALUES('', '" . $utilisateur->nomUtilisateur . "', '" . $message . "')");

				} else {

				$body .= $theme_open_boite_titre ;

				$body .= LIVREDOR ;

				$body .= $theme_close_boite_titre ;

				$body .= 'Votre message doit contenir au minimum un mot !';

				$body .= $theme_close_boite ;

				}
			$body .= $theme_open_boite_titre ;

			$body .= LIVREDOR ;

			$body .= $theme_close_boite_titre ;

			$body .= 'Votre message a bien été envoyé !';
			$body .= "<SCRIPT LANGUAGE='JavaScript'>\n";
			$body .= "<!--\n";
			$body .= "function redirect() \n";
			$body .= "{\n";
			$body .= "window.location='".$index->targetfile."=livredor' \n";
			$body .= "}\n";
			$body .= "setTimeout('redirect()',1000); \n";
			$body .= "-->\n";
			$body .= "</SCRIPT>\n";

			$body .= $theme_close_boite ;

			} else {
			
			$body .= $theme_open_boite_titre ;
$body .= LIVREDOR ;
$body .= $theme_close_boite_titre ;
$body .= '<form method="post" action="'.$index->targetfile.'=livredor" name="news">'.NUT.' : <b>'.$utilisateur->nomUtilisateur.'</b><br>'.MESSAGE.' :<br />';


$body .= '<textarea id="postContent" name="postContent" rows="15" style="width:80%"></textarea>';
$body .= '<input type="submit" value="'.LD_SUBMIT.'" /></form>';
$body .= $theme_close_boite ;

$select = $db->sql_query("SELECT * FROM ".$db->prefix_tables."livredor_op WHERE nom='nbr_message_afficher'");
$data = $db->sql_fetchrow($select);
			

					$limit_par_feuille = $data['valeur']; 
					if (isset($_GET['feuille']) AND !empty($_GET['feuille']))
					{
							$feuille = intval($_GET['feuille']);
					}
					else
					{
							$feuille = 1;
					}
					$from = ($feuille - 1) * $limit_par_feuille;
					
$reponse = $db->sql_query('SELECT * FROM '.$db->prefix_tables.'livredor ORDER BY id DESC LIMIT '.$from.', '.$limit_par_feuille.'');
			
			while ($donnees = $db->sql_fetchrow($reponse))
			{
            
			$body .= $theme_open_boite;
			$body .= '<strong><a href="'.$index->targetfile.'=memberlist&profil=' . $donnees['pseudo'] . '">' . $donnees['pseudo'] . '</a></strong> '.LD_AWRIT.' :<hr>';
			$body .= nl2br($donnees['message']);
			$body .= $theme_close_boite;
	  
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
		if (preg_match("/\bmodules\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >
					
					
 
					$body .= $theme_open_boite .'<p><a href="'.$index->targetfile.'=livredor&action=supprimer&id=' . $donnees['id'] . '">'.SUPPRIMER_NEWS.'</a></p>'.$theme_close_boite;
 
					
}
			
			}
			
		$requete = mysql_query('SELECT COUNT(id) AS nb_entrees FROM '.$db->prefix_tables.'livredor');
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
							$body .= '<a href="'.$index->targetfile.'=livredor&amp;feuille='.$i.'">'.$i.'</a>';
					}
			}
			
			}
			
			
			

		} 
	
	} 
	
}
?>