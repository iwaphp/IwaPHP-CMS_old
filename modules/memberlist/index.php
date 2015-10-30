<?php
# IwaPHP CMS - Système de gestion de contenu 

	
if (recuperer("active_memberlist") == "non") {
$body .= erreur ;
} else {


if (!isset($_GET['mp'])) {
	if (!isset($_GET['profil'])) {
		$body .= $theme_open_boite_titre;
		$body .= TITREMEMBERLIST ;
		$body .= $theme_close_boite_titre;
			$limit_par_feuille = 20; 
			if (isset($_GET['feuille']) AND !empty($_GET['feuille']))
			{
					$feuille = intval($_GET['feuille']);
			}
			else
			{
					$feuille = 1;
			}
			$from = ($feuille - 1) * $limit_par_feuille;
		// la liste des membres
		$body .='<table width="100%" border="0">';
		$body .='<tr>';
		$body .='<td width="48" id="titre_tableau"><strong>Avatar</strong></td>';
		$body .='<td id="titre_tableau"><strong>Identifiant</strong></td>';
		$body .='<td id="titre_tableau"><strong>Groupe</strong></td>';
		
		$body .='<td id="titre_tableau"><strong>'.ML_WEBSITE.'</strong></td>';
		$body .='</tr>';
		$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre ORDER BY id DESC LIMIT ".$from.", ".$limit_par_feuille."");
		while ($result = $db->sql_fetchrow($data))
		{
			$body .='<tr>';
			$body .='<td width="48" id="tableau"><img src="'.(!empty($result['avatar']) ? $result['avatar'] : 'images/noavatar.png').'" alt="" border="0" width="48" height="48" /></td>';
			$body .='<td id="tableau"><a href="'.$index->targetfile.'=memberlist&profil='.$result['id'].'">'.$result['pseudo'].'</a></td>';
			
			$db_level = $db->sql_query("SELECT * FROM ".$db->prefix_tables."groupes WHERE niveaux='".$result['grade']."'");
			$result_level = $db->sql_fetchrow($db_level);
			
			$body .='<td id="tableau">'.(!empty($result_level['nom']) ? ($result_level['nom']) : 'Utilisateurs').'</td>';
			
			$body .='<td id="tableau"><a href="'.$result['website'].'" target="_blank">'.$result['website'].'</a></td>';
			$body .='</tr>';
		}
		$body .='</table>';
		$requete = mysql_query('SELECT COUNT(id) AS nb_membres FROM '.$db->prefix_tables.'membre');
		$donnees = mysql_fetch_assoc($requete);

			$nb_feuille = ceil($donnees['nb_membres'] / $limit_par_feuille);
			$body .= '<br />Pages :&nbsp;';
			for ($i=1 ; $i<=$nb_feuille ; $i++)
			{
					if ($i == $feuille)
					{
							$body .= '&nbsp;['.$i.']&nbsp;';
					}
					else
					{
							$body .= '<a href="'.$index->targetfile.'=memberlist&amp;feuille='.$i.'">'.$i.'</a>';
					}
			}
		$body .= $theme_close_boite;
	}
	else {
		if ($_GET['profil'] == $_GET['profil']) {
			$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$_GET['profil']."'");
			$result = $db->sql_fetchrow($data);
			
			$body .='<table width="100%" border="0" cellpadding="0" cellspacing="2">
  <tr>
    <td width="160" valign="top">';
	$body .= $theme_open_boite_titre;
	$body .= '<div align="center"><strong>'.$result['pseudo'].'</strong></div>';
	$body .= $theme_close_boite_titre;
	$body .= '<div id="col_profil">';
			$body .='<div align="center"><br>';
      $body .= (!empty($result['avatar']) ? '<img src="'.$result['avatar'].'" width="100" height="100">' : '<img src="images/noavatar.png" border="0" alt="" width="100" height="100">');
	  $body .='<br>
          '.($result['sexe'] == 'homme' ? '<span style="color: #000099;">&#9794; <b>'.ucfirst($result['pseudo']).'</b></span><br>' :
		   '<span style="color: #FF0066;">&#9792; <b>'.ucfirst($result['pseudo']).'</b></span><br>');
		   

		   //Décompte des membres
$time_max = time() - (60 * 5);
$requete_count_membres = mysql_query('SELECT id, pseudo 
FROM '.$db->prefix_tables.'whosonline
LEFT JOIN '.$db->prefix_tables.'membre ON id = online_id
WHERE online_time > '.$time_max);
$count_membres = mysql_num_rows($requete_count_membres);
       
$data_count_membres = mysql_fetch_assoc($requete_count_membres);

$body .= substr(($data_count_membres['id'] == $result['id'] ? '<span style="text-decoration: blink; color: #00FF33;">En ligne</span><br>' : '<span style="color: #FF0000;">Hors ligne</span><br>'), 0, -1);

	
if ($result['ddn_mois'] == 'janvier') { $ddn_mois = 1; }
elseif ($result['ddn_mois'] == 'fevrier') { $ddn_mois = 2; }
elseif ($result['ddn_mois'] == 'mars') { $ddn_mois = 3; }
elseif ($result['ddn_mois'] == 'avril') { $ddn_mois = 4; }
elseif ($result['ddn_mois'] == 'mai') { $ddn_mois = 5; }
elseif ($result['ddn_mois'] == 'juin') { $ddn_mois = 6; }
elseif ($result['ddn_mois'] == 'juillet') { $ddn_mois = 7; }
elseif ($result['ddn_mois'] == 'aout') { $ddn_mois = 8; }
elseif ($result['ddn_mois'] == 'septembre') { $ddn_mois = 9; }
elseif ($result['ddn_mois'] == 'octobre') { $ddn_mois = 10; }
elseif ($result['ddn_mois'] == 'novembre') { $ddn_mois = 11; }
elseif ($result['ddn_mois'] == 'decembre') { $ddn_mois = 12; }
else { $ddn_mois = null; }



		
		
$body .= '<br>';
$body .= '<br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=utilisateurs&action=delete&id='.$result['pseudo'].'">'.ML_ERASE.'</a><br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="index.php?admin&op=utilisateurs&action=modifier&id='.$result['pseudo'].'">'.ML_MODIF.'</a><br>';

$body .= '  
      <br>
      <table width="100%"  border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td>'.($_GET['profil'] == $utilisateur->idUtilisateur ? null : '<a href="'.$index->targetfile.'=memberlist&profil='.$_GET['profil'].'&mp"><table width="100%" id="bouton_profil" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>'.(recuperer('activer_messagerie_privee') == 'oui' ? '<table width="100%"  border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/profil/mail_new.png\"  border=\"0\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/profil/mail_new.png\" border=\"0\" alt=\"\" \>\n").'</td>
    <td>Envoyer un message priv&eacute;</td>
  </tr>
</table>' : '').'</td>
  </tr>
</table></a>').'</td>
  </tr>
 

  <tr>
    <td>'.($_GET['profil'] == $utilisateur->idUtilisateur ? null : '<a href="index.php?page=espace_membre&dossier=friends&bloquer='.$_GET['profil'].'&id='.$utilisateur->idUtilisateur.'"> <table width="100%" id="bouton_profil" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/profil/user_delete.png\" border=\"0\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/profil/user_delete.png\" border=\"0\" alt=\"\" \>\n").'</td>
    <td>Bloquer cette personne</td>
  </tr>
</table></td>
  </tr>
</table></a>').'</td>
  </tr>
 
  
  <tr>
    <td>'.($_GET['profil'] == $utilisateur->idUtilisateur ? null : '<a href="index.php?page=espace_membre&dossier=friends&ajouter='.$_GET['profil'].'&id='.$utilisateur->idUtilisateur.'">
      <table width="100%" id="bouton_profil" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="100%"  border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/profil/add_user.png\" border=\"0\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/profil/add_user.png\" border=\"0\" alt=\"\" \>\n").'</td>
    <td>Ajouter &agrave; mes amis</td>
  </tr>
</table></td>
  </tr>
</table></a>').'</td>
  </tr>
</table>


      
      <br>
      
    </div>';
	$body .= null; 
	$body .= $theme_close_boite;
	$body .= '</td>
    <td valign="top"><table width="100%"  border="0" cellspacing="2" cellpadding="0">
      <tr>
        <td valign="top">
<table width="100%"  border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td>'.$theme_open_boite_titre.'<span class="entete1">A propos de '.$result['pseudo'].'</span>'.$theme_close_boite_titre.'<br>
             
              <hr> 
              <strong>Pr&eacute;nom</strong><br>
              '.$result['nom'].'<br>
             <hr>
              <strong>Date de naissance <br>
              </strong>'.$result['ddn_jour'].' '.$result['ddn_mois'].' '.$result['ddn_annee'].'<br>
              <hr>
              <strong>Lieu de r&eacute;sidence <br>
              </strong>'.$result['pays'].'<br>
			  <hr>
              <strong>Groupe<br>';
					$data1 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."groupes WHERE niveaux='".$result['grade']."'");
					$result1 = $db->sql_fetchrow($data1);
              $body .='</strong>'.$result1['nom'].'<br>
			  <hr>
			  '.(empty($result['website']) ? '<strong>'.ML_WEBSITE.' :&nbsp;</strong>'.PASINFO.'<br>' : '<strong>'.ML_WEBSITE.' :&nbsp;</strong><a href="'.$result['website'].'" target="_blank">'.$result['website'].'</a><br>').'
			<hr>
			<strong>'.ML_SIGN.' : </strong><br><FIELDSET>';
			$body .= $result['signature'];
			$body .='</FIELDSET>
              '.$theme_close_boite.'</td>
          </tr>
        </table><table width="100%"  border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td>'.$theme_open_boite_titre.'Ami(e)s'.$theme_close_boite_titre.'
         <table width="100%" border="0">';
			$body .='<tr>';
			$body .='<td width="48" id="titre_tableau"><strong>Avatar</strong></td>';
			$body .='<td id="titre_tableau"><strong>Identifiant de l\'ami(e)</strong></td>';
			$body .='<td id="titre_tableau"><strong>Date d\'ajout</strong></td>';
			$body .='<td id="titre_tableau"><strong>Actions</strong></td>';
			$body .='</tr>';
			
			$data2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."friends WHERE id_='".$result['id']."' AND pseudo='".$result['pseudo']."'");
			while ($result2 = $db->sql_fetchrow($data2))
			{
				
				$data1 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$result2['id_ami']."'");
				$result1 = $db->sql_fetchrow($data1);
				
				if ($result2['accept'] == 1) {
					$body .='<tr>';
					$body .='<td width="48" id="tableau"><img src="'.(!empty($result1['avatar']) ? $result1['avatar'] : 'images/noavatar.png').'" alt="" border="0" width="48" height="48" /></td>';
					$body .='<td id="tableau"><a href="index.php?page=memberlist&profil='.$result2['id_ami'].'">'.$result2['pseudo_ami'].'</a></td>';
					$body .='<td id="tableau">'.$result2['ami_depuis'].'</td>';
					$body .='<td id="tableau">'.($_GET['profil'] == $utilisateur->idUtilisateur ? '<a href="index.php?page=espace_membre&dossier=friends&retirer='.$result['id_ami'].'&id='.$utilisateur->idUtilisateur.'">- Retirer de la liste</a><br />
												<a href="index.php?page=espace_membre&dossier=friends&bloquer='.$result['id_ami'].'&id='.$utilisateur->idUtilisateur.'">- Bloquer</a>' : '<a href="index.php?page=espace_membre&dossier=friends&ajouter='.$result2['id_ami'].'&id='.$utilisateur->idUtilisateur.'">- Ajouter comme ami(e)</a>').'<br />
												<br /></td>';
					$body .='</tr>';
				} 
				
				
				
			}

		$body .= '</table>
              '.$theme_close_boite.'</td>
          </tr>
        </table></td>
        
      </tr>
    </table></td>
  </tr>
</table>
';
			

		} }
}
else
{

	
		if (isset($_POST['dest']) && isset($_POST['sujet']) && isset($_POST['message']))
		{
			//recuperation de l'id du destinataire
			$requeted = mysql_query("SELECT id FROM ".$db->prefix_tables."membre WHERE `id`='".$_GET['profil']."'");
			$idest = mysql_fetch_array ($requeted);
			//recuperation de l'id du l'emeteur
			$requetee = mysql_query("SELECT id FROM ".$db->prefix_tables."membre WHERE `id`='".$utilisateur->idUtilisateur."'");
			$ideme = mysql_fetch_array ($requeted);
			//stockage bdd
			mysql_query("INSERT INTO ".$db->prefix_tables."mp VALUES (NULL , '".$utilisateur->idUtilisateur."', '".$idest['id']."', '".$_POST['sujet']."', '".nl2br($_POST['message'])."','1','0','".time()."')");
			$body .= $theme_open_boite;
			$body .= 'Message envoy&eacute;';
			$body .= $theme_close_boite;
		}
		$data = mysql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE `id`='".$_GET['profil']."'");
		$result = mysql_fetch_array ($data);
		
		


		$body .= $theme_open_boite_titre;
		$body .= 'R&eacute;diger un message';
		$body .= $theme_close_boite_titre;
		$body .= '<table border="0">';
		$body .= '<form method="post" action="'.$index->targetfile.'=memberlist&profil='.$_GET['profil'].'&mp">';
		$body.='<tr><td>Destinataire :</td><td><input type="text" value="'.$result['pseudo'].'" name="dest"></td></tr>';
		$body.='<tr><td>Sujet du message :</td><td><input type="text" value="" name="sujet"></td></tr>';
		$body.='<tr><td>Message :</td><td><textarea id="postContent" rows=5 cols=30 name="message"></textarea></td></tr>';
		$body.='<tr><td>&nbsp;</td><td><input type="submit" value="Envoyer"</td></tr>';

		$body .= '</form>';
		$body .= '</table>';
		$body .= $theme_close_boite;
	
}
}
?>