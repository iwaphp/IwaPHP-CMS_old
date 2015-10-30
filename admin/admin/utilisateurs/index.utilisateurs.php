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

 
	if (!isset($_GET['action'])) {  

		$contenu .='<fieldset><legend>Administration des utilisateurs</legend><table width="100%"  border="0" cellspacing="2">';
		$contenu .='<tr>';
		$contenu .='<td width="48" id="titre_tableau"><strong>Avatar : </strong></td>';
		$contenu .='<td id="titre_tableau"><strong>Identifiant : </strong></td>';
		$contenu .='<td id="titre_tableau"><STRONG>Niveau : </STRONG></td>';
		$contenu .='<td id="titre_tableau"><STRONG>Nom complet :</STRONG></td>';
		$contenu .='<td id="titre_tableau"><STRONG>Adresse E-mail :</STRONG></td>';
		$contenu .='<td id="titre_tableau">Actions :</td>';
		$contenu .='</tr>';
			
			$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre");
			while ($donnees = $db->sql_fetchrow($reponse) )
			{  
				$contenu .='<tr>';
				$contenu .= (empty($donnees['avatar']) ? '<td width="48" id="tableau"><img src="images/noavatar.png" border="0" alt="" width="48" height="48"/></td>' : '<td width="48" id="tableau"><img src="'.$donnees['avatar'].'" alt="" border="0" width="48" height="48" /></td>');
				$contenu .='<td id="tableau"><a href="index.php?admin&op=utilisateurs&action=modifier&id='.$donnees['pseudo'].'">'.$donnees['pseudo'].'</a> ( <a href="'.$index->targetfile.'=memberlist&profil='.$donnees['id'].'">Voir le profil</a> )</td>';
				$contenu .='<td id="tableau">'.$donnees['grade'].'</td>';
				$contenu .='<td id="tableau">'.$donnees['prenom'].'&nbsp'.$donnees['nom'].'</td>';
				$contenu .='<td id="tableau">'.$donnees['mail'].'</td>';
				$contenu .='<td id="tableau"><a href="index.php?admin&op=utilisateurs&action=delete&id='.$donnees['pseudo'].'">- '.ML_ERASE.'</a><br>';
				$contenu .='<a href="index.php?admin&op=utilisateurs&action=modifier&id='.$donnees['pseudo'].'">- '.ML_MODIF.'</a><br>';
				
				if ($donnees['banni'] == true) {
						$contenu .='<a href="index.php?admin&op=utilisateurs&action=debannir&id='.$donnees['pseudo'].'">- '.ML_DEBANNIR.'</a><br>';
				} else {
						$contenu .='<a href="index.php?admin&op=utilisateurs&action=bannir&id='.$donnees['pseudo'].'">- '.ML_BANNIR.'</a><br>';
				}

				if ($donnees['averto'] == true) {
						$contenu .='<a href="index.php?admin&op=utilisateurs&action=deaverto&id='.$donnees['pseudo'].'">- '.ML_DEAVERTO.'</a>';
				} else {
						$contenu .='<a href="index.php?admin&op=utilisateurs&action=averto&id='.$donnees['pseudo'].'">- '.ML_AVERTO.'</a>';
				}
				$contenu .='<br>';
				if ($donnees['confirm'] != '') {
						$contenu .='<br><a href="index.php?admin&op=utilisateurs&action=activer&id='.$donnees['pseudo'].'">- '.ML_ACTIVE.'</a>';
				}
				$contenu .='</td>';
				$contenu .='</tr>';
			}
		$contenu .='</table></fieldset><br><fieldset><legend>Actions</legend><table width="100%"  border="0" cellspacing="2" id="tableau"><tr>
		<td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
		<td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="index.php?admin">'.CANCEL.'</a></td>
		</tr></table></fieldset>';

	} else {

if (isset($_GET['action'])) {  
	if ($_GET['action'] == "delete") { 
		if ($_GET['id'] == $_GET['id']) { 
			if (isset($_GET['confirm'])) {  
				if ($_GET['confirm'] == "yes") { 
					$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE pseudo='".$_GET['id']."'");
					$donnees = $db->sql_fetchrow($reponse);
					$db->sql_query('DELETE FROM '.$db->prefix_tables.'membre WHERE pseudo = "'.$donnees['pseudo'].'" ');

					$contenu .= OPEFFEC.'<br><a href="index.php?admin&op=utilisateurs">'.RETOUR.'</a>' ;


				} 
			} else {

				$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE pseudo='".$_GET['id']."'");
				$donnees = $db->sql_fetchrow($reponse);
				$contenu .='<table width="100%"  border="0" cellspacing="0">';
				$contenu .='<tr>';
				$contenu .='<td><div align="center">'.AU_EFFMCONFIRM.' : <strong>'.$donnees['pseudo'].'</strong> ?<strong><br>';
				$contenu .='</strong>';
				$contenu .='<table width="10%" border="0" align="center" cellspacing="0">';
				$contenu .='<tr>';
				$contenu .='<td><a href="index.php?admin&op=utilisateurs&action=delete&id='.$donnees['pseudo'].'&confirm=yes">'.YES.'</td>';
				$contenu .='<td><div align="right"><a href="javascript:history.go(-1);">'.NO.'</a></div></td>';
				$contenu .='</tr>';
				$contenu .='</table>';
				$contenu .='</div></td>';
				$contenu .='</tr>';
				$contenu .='</table>';

			}

		} 
	}
	if ($_GET['action'] == "bannir") { 
		$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE pseudo='".$_GET['id']."'");
		$donnees = $db->sql_fetchrow($reponse);
		$sql = 'UPDATE `'.$db->prefix_tables.'membre` SET `banni` = "true" WHERE `pseudo` = "'.$donnees['pseudo'].'" '; 
		$db->sql_query($sql);

		$contenu .= OPEFFEC.'<br><a href="index.php?admin&op=utilisateurs">'.RETOUR.'</a>' ;

	}
	if ($_GET['action'] == "debannir") { 
		$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE pseudo='".$_GET['id']."'");
		$donnees = $db->sql_fetchrow($reponse);
		$sql = 'UPDATE `'.$db->prefix_tables.'membre` SET `banni` = "" WHERE `pseudo` = "'.$donnees['pseudo'].'" '; 
		$db->sql_query($sql);
		
		$contenu .= OPEFFEC.'<br><a href="index.php?admin&op=utilisateurs">'.RETOUR.'</a>' ;
	}
	if ($_GET['action'] == "averto") { 
		$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE pseudo='".$_GET['id']."'");
		$donnees = $db->sql_fetchrow($reponse);
		$sql = 'UPDATE `'.$db->prefix_tables.'membre` SET `averto` = "true" WHERE `pseudo` = "'.$donnees['pseudo'].'" '; 
		$db->sql_query($sql);
		$contenu .= OPEFFEC.'<br><a href="index.php?admin&op=utilisateurs">'.RETOUR.'</a>' ;
	}
	if ($_GET['action'] == "deaverto") { 
		$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE pseudo='".$_GET['id']."'");
		$donnees = $db->sql_fetchrow($reponse);
		$sql = 'UPDATE `'.$db->prefix_tables.'membre` SET `averto` = "" WHERE `pseudo` = "'.$donnees['pseudo'].'" '; 
		$db->sql_query($sql);
		$contenu .= OPEFFEC.'<br><a href="index.php?admin&op=utilisateurs">'.RETOUR.'</a>' ;
	}
	if ($_GET['action'] == "activer") { 
		$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE pseudo='".$_GET['id']."'");
		$donnees = $db->sql_fetchrow($reponse);
		$sql = 'UPDATE `'.$db->prefix_tables.'membre` SET `confirm` = "" WHERE `pseudo` = "'.$donnees['pseudo'].'" '; 
		$db->sql_query($sql);
		$contenu .= OPEFFEC.'<br><a href="index.php?admin&op=utilisateurs">'.RETOUR.'</a>' ;

	}

	if ($_GET['action'] == "modifier") { 
	//modif membre
		if (isset($_GET['sub'])) {  
			if ($_GET['id'] == $_GET['id']) {
				if ($_GET['sub'] == "maj") { 
 

					$contenu .= submit_form ;
					if (isset($_POST['pseudo'])) 
					{
						$pseudo = htmlentities($_POST['pseudo']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET pseudo='" . $pseudo . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['mail'])) 
					{
						$mail = htmlentities($_POST['mail']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET mail='" . $mail . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['prenom']))
					{
						$prenom = htmlentities($_POST['prenom']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET prenom='" . $prenom . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['pays']))
					{
						$pays = htmlentities($_POST['pays']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET pays='" . $pays . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['ddn_jour']) AND isset($_POST['ddn_mois']) AND isset($_POST['ddn_annee']))		{
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET ddn_jour='" . $_POST['ddn_jour'] . "' WHERE pseudo='".$_GET['id']."'");
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET ddn_mois='" . $_POST['ddn_mois'] . "' WHERE pseudo='".$_GET['id']."'");
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET ddn_annee='" . $_POST['ddn_annee'] . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['born']))
					{
						$born = htmlentities($_POST['born']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET born='" . $born . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['website']))
					{
						$website = htmlentities($_POST['website']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET website='" . $website . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['nom'])) 
					{
						$nom = htmlentities($_POST['nom']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET nom='" . $nom . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['aim']))
					{
						$aim = htmlentities($_POST['aim']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET aim='" . $aim . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['msn']))
					{
						$msn = htmlentities($_POST['msn']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET msn='" . $msn . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['icq']))
					{
						$icq = htmlentities($_POST['icq']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET icq='" . $icq . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['signature'])) 
					{
						$signature = $_POST['signature'];
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET signature='" . $signature . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['grade'])) 
					{
						$grade = htmlentities($_POST['grade']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET grade='" . $grade . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['ymsn']))
					{
						$ymsn = htmlentities($_POST['ymsn']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET ymsn='" . $ymsn . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['urlavatar']))
					{
						$urlavatar = htmlentities($_POST['urlavatar']);
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET avatar='" . $urlavatar . "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['theme_m']))	{
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET theme_selected='" .$_POST['theme_m']. "' WHERE pseudo='".$_GET['id']."'");
					}
					if (isset($_POST['sexe']))	{
						$db->sql_query("UPDATE ".$db->prefix_tables."membre SET sexe='" .$_POST['sexe']. "' WHERE pseudo='".$_GET['id']."'");
					}
										
				}
			} 
		} else {



			$reponse = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE pseudo='".$_GET['id']."'");
			$donnees = $db->sql_fetchrow($reponse);

			$contenu .= '<form name="form1" method="post" action="index.php?admin&op=utilisateurs&action=modifier&id='.$donnees['pseudo'].'&sub=maj" id="formulaire">';

			$contenu .= '<fieldset><legend>Modification du membre</legend><TABLE width="100%" border=0>';
			$contenu .= '<TBODY>';
			$contenu .= '<TR>';
			$contenu .= '<TD><TABLE width="100%" align=center border=0>';
			$contenu .= '<TBODY>';
			$contenu .= '<TR><td><h2>Modifier l\'avatar</h2>
			
					<table border="0" align="center" cellspacing="0">
					<tr>
					<td width="35%">


					<FIELDSET>
					<LEGEND>Avatar actuel : </LEGEND>
					'.(!empty($donnees['avatar']) ? '<img src="'.$donnees['avatar'].'" border="0" width="128" height="128" alt="">' : '<img src="images/noavatar.png" border="0" alt="">').'
					</FIELDSET>
					<br><FIELDSET>
					<LEGEND>Modifier avatar : </LEGEND>
						
					<ul id="maintab" class="shadetabs">
					<li class="selected"><a href="#default" rel="ajaxcontentarea">'.AVA_EXT.'</a></li>
					<li><a href="modules/espace_membre/upavatar.php" rel="ajaxcontentarea">'.AVA_UP.'</a></li>
					</ul>

					<div id="ajaxcontentarea" class="contentstyle">
					<p>'.PHRASE_INFO_AVA.'<br>Laissez ce champ vide pour supprimer l\'avatar<br><input type="text" name="urlavatar" value="'.$donnees['avatar'].'" /></p>
					</div>

					<script type="text/javascript">
					startajaxtabs("maintab")
					</script>

					</FIELDSET>
					</td>
					</tr>

					</table><br />';
			
			$contenu .= '</TD>';
			$contenu .= '<TD></TD>';
			$contenu .= '<TD></TD>';
			$contenu .= '</TR>';
			$contenu .= '</TBODY>';
			$contenu .= '</TABLE></TD>';
			$contenu .= '</TR>';
			$contenu .= '<TR>';
			$contenu .= '<TD><TABLE width="100%" border=0>';
			$contenu .= '<TBODY>';
			$contenu .= '<TR><td><h2>Informations Membre</h2><STRONG>'.NUT.' : </STRONG> <input name="pseudo" type="text" value="'.$donnees['pseudo'].'">';
			$contenu .= '<BR><BR>';
			$contenu .= '<STRONG>'.ML_EMAIL.' :</STRONG>&nbsp;';
			$contenu .= '<input type="text" name="mail" value="'.$donnees['mail'].'">';
			$contenu .= '<BR><BR>';
			$contenu .= '<STRONG>Niveau : </STRONG>&nbsp;';
			$contenu .= '<select name="grade">';
			$grade_u = $donnees['grade'];
			$reqc = $db->sql_query("SELECT * FROM ".$db->prefix_tables."niveaux");                                
				while ($resc = $db->sql_fetchrow ($reqc))  { 
				 if ($resc['numero'] == $donnees['grade']) 
						{
						  
						$contenu .= '<option selected="selected" value='.$resc['numero'].'>'.$resc['numero'].'</option>';	
						
						} else {
						
						$contenu .= '<option value='.$resc['numero'].'>'.$resc['numero'].'</option>';
						
						}
				  }
			$contenu .= '<br></select>';
			$contenu .= '<BR><BR><STRONG>'.ML_NOMCOMPLET.' :&nbsp;</STRONG>';
			$contenu .= '<input type="text" name="nom" value="'.$donnees['nom'].'">&nbsp;<input type="text" name="prenom" value="'.$donnees['prenom'].'">';
			$contenu .= '<BR><BR>';
			$contenu .= '<STRONG>'.ML_COUNTRY.' :&nbsp;</STRONG>';
			$contenu .= '<input type="text" name="pays" value="'.$donnees['pays'].'">';
			$contenu .= '<BR><BR>';
			$contenu .= '<STRONG>Sexe :&nbsp;</STRONG>';
			$contenu .= '<select name="sexe">
			  '.($utilisateur->sexeUtilisateur == 'homme' ? '<option value="homme" selected>Masculin</option>' : '<option value="homme">Masculin</option>').'
			  '.($utilisateur->sexeUtilisateur == 'femme' ? '<option value="femme" selected>F&eacute;minin</option>' : '<option value="femme">F&eacute;minin</option>').'
			</select>';
			$contenu .= '<BR><BR>';
			$contenu .= '<STRONG>'.ML_BORN.' :&nbsp;</STRONG>';
			$contenu .= '<select name="ddn_jour">
				'.($donnees['ddn_jour'] == '1' ? '<option value="1" selected>1</option>' : '<option value="1">1</option>').'
				'.($donnees['ddn_jour'] == '2' ? '<option value="2" selected>2</option>' : '<option value="2">2</option>').'
				'.($donnees['ddn_jour'] == '3' ? '<option value="3" selected>3</option>' : '<option value="3">3</option>').'
				'.($donnees['ddn_jour'] == '4' ? '<option value="4" selected>4</option>' : '<option value="4">4</option>').'
				'.($donnees['ddn_jour'] == '5' ? '<option value="5" selected>5</option>' : '<option value="5">5</option>').'
				'.($donnees['ddn_jour'] == '6' ? '<option value="6" selected>6</option>' : '<option value="6">6</option>').'
				'.($donnees['ddn_jour'] == '7' ? '<option value="7" selected>7</option>' : '<option value="7">7</option>').'
				'.($donnees['ddn_jour'] == '8' ? '<option value="8" selected>8</option>' : '<option value="8">8</option>').'
				'.($donnees['ddn_jour'] == '9' ? '<option value="9" selected>9</option>' : '<option value="9">9</option>').'
				'.($donnees['ddn_jour'] == '10' ? '<option value="10" selected>10</option>' : '<option value="10">10</option>').'
				'.($donnees['ddn_jour'] == '11' ? '<option value="11" selected>11</option>' : '<option value="11">11</option>').'
				'.($donnees['ddn_jour'] == '12' ? '<option value="12" selected>12</option>' : '<option value="12">12</option>').'
				'.($donnees['ddn_jour'] == '13' ? '<option value="13" selected>13</option>' : '<option value="13">13</option>').'
				'.($donnees['ddn_jour'] == '14' ? '<option value="14" selected>14</option>' : '<option value="14">14</option>').'
				'.($donnees['ddn_jour'] == '15' ? '<option value="15" selected>15</option>' : '<option value="15">15</option>').'
				'.($donnees['ddn_jour'] == '16' ? '<option value="16" selected>16</option>' : '<option value="16">16</option>').'
				'.($donnees['ddn_jour'] == '17' ? '<option value="17" selected>17</option>' : '<option value="17">17</option>').'
				'.($donnees['ddn_jour'] == '18' ? '<option value="18" selected>18</option>' : '<option value="18">18</option>').'
				'.($donnees['ddn_jour'] == '19' ? '<option value="19" selected>19</option>' : '<option value="19">19</option>').'
				'.($donnees['ddn_jour'] == '20' ? '<option value="20" selected>20</option>' : '<option value="20">20</option>').'
				'.($donnees['ddn_jour'] == '21' ? '<option value="21" selected>21</option>' : '<option value="21">21</option>').'
				'.($donnees['ddn_jour'] == '22' ? '<option value="22" selected>22</option>' : '<option value="22">22</option>').'
				'.($donnees['ddn_jour'] == '23' ? '<option value="23" selected>23</option>' : '<option value="23">23</option>').'
				'.($donnees['ddn_jour'] == '24' ? '<option value="24" selected>24</option>' : '<option value="24">24</option>').'
				'.($donnees['ddn_jour'] == '25' ? '<option value="25" selected>25</option>' : '<option value="25">25</option>').'
				'.($donnees['ddn_jour'] == '26' ? '<option value="26" selected>26</option>' : '<option value="26">26</option>').'
				'.($donnees['ddn_jour'] == '27' ? '<option value="27" selected>27</option>' : '<option value="27">27</option>').'
				'.($donnees['ddn_jour'] == '28' ? '<option value="28" selected>28</option>' : '<option value="28">28</option>').'
				'.($donnees['ddn_jour'] == '29' ? '<option value="29" selected>29</option>' : '<option value="29">29</option>').'
				'.($donnees['ddn_jour'] == '30' ? '<option value="30" selected>30</option>' : '<option value="30">30</option>').'
				'.($donnees['ddn_jour'] == '31' ? '<option value="31" selected>31</option>' : '<option value="31">31</option>').'
			</select>
			/
			<select name="ddn_mois">
				'.($donnees['ddn_mois'] == 'janvier' ? '<option value="janvier" selected>Janvier</option>' : '<option value="janvier">Janvier</option>').'
				'.($donnees['ddn_mois'] == 'fevrier' ? '<option value="fevrier" selected>F&eacute;vrier</option>' : '<option value="fevrier">F&eacute;vrier</option>').'
				'.($donnees['ddn_mois'] == 'mars' ? '<option value="mars" selected>Mars</option>' : '<option value="mars">Mars</option>').'
				'.($donnees['ddn_mois'] == 'avril' ? '<option value="avril" selected>Avril</option>' : '<option value="avril">Avril</option>').'
				'.($donnees['ddn_mois'] == 'mai' ? '<option value="mai" selected>Mai</option>' : '<option value="mai">Mai</option>').'
				'.($donnees['ddn_mois'] == 'juin' ? '<option value="juin" selected>Juin</option>' : '<option value="juin">Juin</option>').'
				'.($donnees['ddn_mois'] == 'juillet' ? '<option value="juillet" selected>Juillet</option>' : '<option value="juillet">Juillet</option>').'
				'.($donnees['ddn_mois'] == 'aout' ? '<option value="aout" selected>Ao&ucirc;t</option>' : '<option value="aout">Ao&ucirc;t</option>').'
				'.($donnees['ddn_mois'] == 'septembre' ? '<option value="septembre" selected>Septembre</option>' : '<option value="septembre">Septembre</option>').'
				'.($donnees['ddn_mois'] == 'octobre' ? '<option value="octobre" selected>Octobre</option>' : '<option value="octobre">Octobre</option>').'
				'.($donnees['ddn_mois'] == 'novembre' ? '<option value="novembre" selected>Novembre</option>' : '<option value="novembre">Novembre</option>').'
				'.($donnees['ddn_mois'] == 'decembre' ? '<option value="decembre" selected>D&eacute;cembre</option>' : '<option value="decembre">D&eacute;cembre</option>').'
			</select>
			/
			<select name="ddn_annee">
				'.($donnees['ddn_annee'] == '1950' ? '<option value="1950" selected>1950</option>' : '<option value="1950">1950</option>').'
				'.($donnees['ddn_annee'] == '1951' ? '<option value="1951" selected>1951</option>' : '<option value="1951">1951</option>').'
				'.($donnees['ddn_annee'] == '1952' ? '<option value="1952" selected>1952</option>' : '<option value="1952">1952</option>').'
				'.($donnees['ddn_annee'] == '1953' ? '<option value="1953" selected>1953</option>' : '<option value="1953">1953</option>').'
				'.($donnees['ddn_annee'] == '1954' ? '<option value="1954" selected>1954</option>' : '<option value="1954">1954</option>').'
				'.($donnees['ddn_annee'] == '1955' ? '<option value="1955" selected>1955</option>' : '<option value="1955">1955</option>').'
				'.($donnees['ddn_annee'] == '1956' ? '<option value="1956" selected>1956</option>' : '<option value="1956">1956</option>').'
				'.($donnees['ddn_annee'] == '1957' ? '<option value="1957" selected>1957</option>' : '<option value="1957">1957</option>').'
				'.($donnees['ddn_annee'] == '1958' ? '<option value="1958" selected>1958</option>' : '<option value="1958">1958</option>').'
				'.($donnees['ddn_annee'] == '1959' ? '<option value="1959" selected>1959</option>' : '<option value="1959">1959</option>').'
				'.($donnees['ddn_annee'] == '1960' ? '<option value="1960" selected>1960</option>' : '<option value="1960">1960</option>').'
				'.($donnees['ddn_annee'] == '1961' ? '<option value="1961" selected>1961</option>' : '<option value="1961">1961</option>').'
				'.($donnees['ddn_annee'] == '1962' ? '<option value="1962" selected>1962</option>' : '<option value="1962">1962</option>').'
				'.($donnees['ddn_annee'] == '1963' ? '<option value="1963" selected>1963</option>' : '<option value="1963">1963</option>').'
				'.($donnees['ddn_annee'] == '1964' ? '<option value="1964" selected>1964</option>' : '<option value="1964">1964</option>').'
				'.($donnees['ddn_annee'] == '1965' ? '<option value="1965" selected>1965</option>' : '<option value="1965">1965</option>').'
				'.($donnees['ddn_annee'] == '1966' ? '<option value="1966" selected>1966</option>' : '<option value="1966">1966</option>').'
				'.($donnees['ddn_annee'] == '1967' ? '<option value="1967" selected>1967</option>' : '<option value="1967">1967</option>').'
				'.($donnees['ddn_annee'] == '1968' ? '<option value="1968" selected>1968</option>' : '<option value="1968">1968</option>').'
				'.($donnees['ddn_annee'] == '1969' ? '<option value="1969" selected>1969</option>' : '<option value="1969">1969</option>').'
				'.($donnees['ddn_annee'] == '1970' ? '<option value="1970" selected>1970</option>' : '<option value="1970">1970</option>').'
				'.($donnees['ddn_annee'] == '1971' ? '<option value="1971" selected>1971</option>' : '<option value="1971">1971</option>').'
				'.($donnees['ddn_annee'] == '1972' ? '<option value="1972" selected>1972</option>' : '<option value="1972">1972</option>').'
				'.($donnees['ddn_annee'] == '1973' ? '<option value="1973" selected>1973</option>' : '<option value="1973">1973</option>').'
				'.($donnees['ddn_annee'] == '1974' ? '<option value="1974" selected>1974</option>' : '<option value="1974">1974</option>').'
				'.($donnees['ddn_annee'] == '1975' ? '<option value="1975" selected>1975</option>' : '<option value="1975">1975</option>').'
				'.($donnees['ddn_annee'] == '1976' ? '<option value="1976" selected>1976</option>' : '<option value="1976">1976</option>').'
				'.($donnees['ddn_annee'] == '1977' ? '<option value="1977" selected>1977</option>' : '<option value="1977">1977</option>').'
				'.($donnees['ddn_annee'] == '1978' ? '<option value="1978" selected>1978</option>' : '<option value="1978">1978</option>').'
				'.($donnees['ddn_annee'] == '1979' ? '<option value="1979" selected>1979</option>' : '<option value="1979">1979</option>').'
				'.($donnees['ddn_annee'] == '1980' ? '<option value="1980" selected>1980</option>' : '<option value="1980">1980</option>').'
				'.($donnees['ddn_annee'] == '1981' ? '<option value="1981" selected>1981</option>' : '<option value="1981">1981</option>').'
				'.($donnees['ddn_annee'] == '1982' ? '<option value="1982" selected>1982</option>' : '<option value="1982">1982</option>').'
				'.($donnees['ddn_annee'] == '1983' ? '<option value="1983" selected>1983</option>' : '<option value="1983">1983</option>').'
				'.($donnees['ddn_annee'] == '1984' ? '<option value="1984" selected>1984</option>' : '<option value="1984">1984</option>').'
				'.($donnees['ddn_annee'] == '1985' ? '<option value="1985" selected>1985</option>' : '<option value="1985">1985</option>').'
				'.($donnees['ddn_annee'] == '1986' ? '<option value="1986" selected>1986</option>' : '<option value="1986">1986</option>').'
				'.($donnees['ddn_annee'] == '1987' ? '<option value="1987" selected>1987</option>' : '<option value="1987">1987</option>').'
				'.($donnees['ddn_annee'] == '1988' ? '<option value="1988" selected>1988</option>' : '<option value="1988">1988</option>').'
				'.($donnees['ddn_annee'] == '1989' ? '<option value="1989" selected>1989</option>' : '<option value="1989">1989</option>').'
				'.($donnees['ddn_annee'] == '1990' ? '<option value="1990" selected>1990</option>' : '<option value="1990">1990</option>').'
				'.($donnees['ddn_annee'] == '1991' ? '<option value="1991" selected>1991</option>' : '<option value="1991">1991</option>').'
				'.($donnees['ddn_annee'] == '1992' ? '<option value="1992" selected>1992</option>' : '<option value="1992">1992</option>').'
				'.($donnees['ddn_annee'] == '1993' ? '<option value="1993" selected>1993</option>' : '<option value="1993">1993</option>').'
				'.($donnees['ddn_annee'] == '1994' ? '<option value="1994" selected>1994</option>' : '<option value="1994">1994</option>').'
				'.($donnees['ddn_annee'] == '1995' ? '<option value="1995" selected>1995</option>' : '<option value="1995">1995</option>').'
				'.($donnees['ddn_annee'] == '1996' ? '<option value="1996" selected>1996</option>' : '<option value="1996">1996</option>').'
				'.($donnees['ddn_annee'] == '1997' ? '<option value="1997" selected>1997</option>' : '<option value="1997">1997</option>').'
				'.($donnees['ddn_annee'] == '1998' ? '<option value="1998" selected>1998</option>' : '<option value="1998">1998</option>').'
				'.($donnees['ddn_annee'] == '1999' ? '<option value="1999" selected>1999</option>' : '<option value="1999">1999</option>').'
				'.($donnees['ddn_annee'] == '2000' ? '<option value="2000" selected>2000</option>' : '<option value="2000">2000</option>').'
			</select>';
			$contenu .= '<BR><BR>';
			$contenu .= '<STRONG>'.ML_WEBSITE.' :&nbsp;</STRONG>';
			$contenu .= '<input type="text" name="website" value="'.$donnees['website'].'">';
			$contenu .= '<BR>';
			$contenu .= '<BR>';
			$contenu .= '<STRONG>Fichier d\'apparence :<br>';


			$contenu .= '<select name="theme_m">';

				$reponse7 = opendir($index->rootpath.'/themes') ;
				while ($file7 = readdir($reponse7)) 
				{
					if($file7 != '..' && $file7 !='.' && $file7 !='' && $file7 !='' && $file7 !='' && $file7 !='' && $file7 !='index.html' && $file7 !='index.htm')
					{
					$dir_theme_utilisateur = $file7;

					if ($dir_theme_utilisateur == $donnees['theme_selected']) 
							{
							 
							$contenu .= '<option selected="selected" value='.$dir_theme_utilisateur.'>'.$dir_theme_utilisateur.'</option>'; 
							 
							} else { 
							
							$contenu .= '<option value='.$dir_theme_utilisateur.'>'.$dir_theme_utilisateur.'</option>'; 
							
							}

					} 


			}
			$contenu .= '<br></TD>';
			$contenu .= '</TR>';
			$contenu .= '</TBODY>';
			$contenu .= '</TABLE></TD>';
			$contenu .= '</TR>';
			$contenu .= '<TR>';
			$contenu .= '<TD><br /><FIELDSET>
				<LEGEND>Modifier signature : </LEGEND>';
			

				$contenu .= "<script src=\"systeme/javascripts/tiny_mce/tiny_mce.js\" type=\"text/javascript\"></script>
				<script type=\"text/xml\">
				<!--
				<oa:widgets>
				  <oa:widget wid=\"2204022\" binding=\"#postContent\" />
				</oa:widgets>
				-->
				</script>";
				$contenu .= "<script type=\"text/javascript\">
				// BeginOAWidget_Instance_2204022: #postContent

					tinyMCE.init({
						// General options
						mode : \"exact\",
						elements : \"postContent\",
						theme : \"advanced\",
						skin : \"default\",
						plugins : \"pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave\",

						// Theme options
						theme_advanced_buttons1 : \"save,newdocument,print,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,\",
						theme_advanced_buttons2 : \"\",
						theme_advanced_buttons3 : \"\",
						theme_advanced_buttons4 : \"\",
						theme_advanced_toolbar_location : \"top\",
						theme_advanced_toolbar_align : \"left\",
						theme_advanced_statusbar_location : \"bottom\",
						theme_advanced_resizing : true,

						// Example content CSS (should be your site CSS)
						content_css : \"/css/editor_styles.css\",

						// Drop lists for link/image/media/template dialogs, You shouldn't need to touch this
						template_external_list_url : \"/lists/template_list.js\",
						external_link_list_url : \"/lists/link_list.js\",
						external_image_list_url : \"/lists/image_list.js\",
						media_external_list_url : \"/lists/media_list.js\",

						// Style formats: You must add here all the inline styles and css classes exposed to the end user in the styles menus
						style_formats : [
							{title : 'Bold text', inline : 'b'},
							{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
							{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
							{title : 'Example 1', inline : 'span', classes : 'example1'},
							{title : 'Example 2', inline : 'span', classes : 'example2'},
							{title : 'Table styles'},
							{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
						]
					});
						
				// EndOAWidget_Instance_2204022
				</script>";
				# Tiny_mce End Body Script
				$contenu .= '<!-- Textarea gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
				<textarea id="postContent" name="signature" rows="15" style="width:80%">'.$donnees['signature'].'</textarea>
				</FIELDSET>';
			
			$contenu .= '</TD>';
			$contenu .= '</TR>';
			$contenu .= '</TBODY>';
			$contenu .= '</TABLE></fieldset><br>';
			$contenu .= '<fieldset><legend>Actions</legend><table width="100%"  border="0" cellspacing="2" id="tableau">
			  <tr>
				<td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/appliquer.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/appliquer.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
				<td><a onMouseOver="poplink(\''.APPLIQUER.'\');" onmouseout="killlink()" href="javascript:document.getElementById(\'formulaire\').submit()">'.APPLIQUER.'</a></td>
			  </tr>
			  
			  <tr>
				<td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
				<td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="index.php?admin&op=utilisateurs">'.CANCEL.'</a></td>
			  </tr></table></fieldset></form>';

		}
//fin modif membre
	}
} }  

$body .= $contenu;
} }
?>