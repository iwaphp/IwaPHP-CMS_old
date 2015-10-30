<?php
# IwaPHP CMS - Système de gestion de contenu 
	
if (!isset($_SESSION['pseudo'])) { $body .= erreur ; } else {
$body .= $theme_open_boite_titre;
$body .= 'Mes informations';
$body .= $theme_close_boite_titre;
		
		  
	if (isset($_GET['apply'])) {
	
							
		if (isset($_POST['signature'])) {
			$signature = $_POST['signature'];
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET signature='" . $signature . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
		}
		
		if (isset($_POST['pseudo'])) {
			$pseudo = htmlentities($_POST['pseudo']);
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET pseudo='" . $pseudo . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
		}

		if (isset($_POST['mail'])) 	{
			$mail = htmlentities($_POST['mail']);
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET mail='" . $mail . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
		}

		if (isset($_POST['prenom']))	{
			$prenom = htmlentities($_POST['prenom']);
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET prenom='" . $prenom . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
		}

		if (isset($_POST['pays']))	{
			$pays = htmlentities($_POST['pays']);
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET pays='" . $pays . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
		}

		if (isset($_POST['ddn_jour']) AND isset($_POST['ddn_mois']) AND isset($_POST['ddn_annee']))		{
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET ddn_jour='" . $_POST['ddn_jour'] . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET ddn_mois='" . $_POST['ddn_mois'] . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET ddn_annee='" . $_POST['ddn_annee'] . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
		}

		if (isset($_POST['sexe']))	{
			$sexe = $_POST['sexe'];
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET sexe='" . $sexe . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
		}
								
		if (isset($_POST['website']))	{
			$website = htmlentities($_POST['website']);
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET website='" . $website . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
		}

		if (isset($_POST['mdp'])) 	{
			if (!empty($_POST['mdp']))	{
				$mdp = htmlentities($_POST['mdp']);
				$pass_crypte = md5($mdp);
				$db->sql_query("UPDATE ".$db->prefix_tables."membre SET pass='" . $pass_crypte . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
			} 
		}
								
		if (isset($_POST['nom'])) {
			$nom = htmlentities($_POST['nom']);
			$db->sql_query("UPDATE ".$db->prefix_tables."membre SET nom='" . $nom . "' WHERE pseudo='".$utilisateur->nomUtilisateur."'");
		}

	$body .='<div align="center">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/icones/appliquer.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/appliquer.png\" alt=\"\" width=\"16\" height=\"16\" border=\"0\" \>\n").'<br /><br />Modifications apport&eacute;es<br /><br>
	- <a href="'.$index->targetfile.'=espace_membre&dossier=mon_compte">Modifier mes informations</a><br>
	<br>
	- <a href="'.$index->targetfile.'=espace_membre">Vers l\'espace membre</a>
	<br />'.(!empty($MessageForm) ? $MessageForm : NULL) .'</div>';
	$body .=$theme_close_boite;

							
} else {
	
  
  
# TABLEAUX FORMES
  

			
			$body .='
  <div id="tabs-1"><form action="'.$index->targetfile.'=espace_membre&dossier=mon_compte&apply" method="post" id="formulaire">';
			$body .='<table border="0" cellspacing="0">';


			$body .='<td width="35%">';
 

				if (recuperer('changer_pseudo') == 'non') {

					$DISABLED1 = 'disabled="true"' ;

				} else { 
						
					$DISABLED1 = '' ;

				}


				if (recuperer('changer_email') == 'non') {

					$DISABLED2 = 'disabled="true"' ;

				} else { 
					
					$DISABLED2 = '' ; 
				
				}


			$body .='<fieldset><legend>Vos identifiants de connexion</legend><table width="100%" border="0" id="tableau">';
			$body .='<tr>';
			$body .='<td>'.NUT.' : </td>';
			$body .='<td><input name="pseudo" type="text" '.$DISABLED1.' id="pseudo" value="'.$utilisateur->nomUtilisateur.'">';
			$body .='*</td>';
			$body .='</tr> <tr>';
			$body .='<td>'.MDP.' : </td>';
			$body .='<td><input name="mdp" type="password" id="mdp" value="">';
			$body .='*   '.ENTER_NEW_PASS_IFOK.'</td>';
			$body .='</tr>';
			$body .='<tr>';
			$body .='<td>'.TAPE_EMAILL.' : </td>';
			$body .='<td><input name="mail" type="text" '.$DISABLED2.' id="mail" value="'.$utilisateur->emailUtilisateur.'">';
			$body .='*      </td>';
			$body .='</tr>';
			$body .='</table></fieldset><br><fieldset><legend>Informations personnelles</legend><table width="100%" border="0" id="tableau">';
			$body .='<tr>';
			$body .='<td>'.TAPENAME.' : </td>';
			$body .='<td><input name="nom" type="text" id="nom" value="'.$utilisateur->lastnameUtilisateur.'">';
			$body .='</td>';
			$body .='</tr>';
			$body .='<tr>';
			$body .='<td>'.TAPESURNAME.' : </td>';
			$body .='<td><input name="prenom" type="text" id="prenom" value="'.$utilisateur->prenomUtilisateur.'">';
			$body .='</td>';
			$body .='</tr>';	
			$body .='<tr>';
			$body .='<td>'.TAPEINTER.' : </td>';
			$body .='<td><input name="pays" type="text" id="pays" value="'.$utilisateur->paysUtilisateur.'">';
			$body .='</td>';
			$body .='</tr>';
			$body .='<tr>';
			$body .='<td>Date de naissance : </td>';
			$body .='<td><select name="ddn_jour">
				'.($utilisateur->ddn_jour == '1' ? '<option value="1" selected>1</option>' : '<option value="1">1</option>').'
				'.($utilisateur->ddn_jour == '2' ? '<option value="2" selected>2</option>' : '<option value="2">2</option>').'
				'.($utilisateur->ddn_jour == '3' ? '<option value="3" selected>3</option>' : '<option value="3">3</option>').'
				'.($utilisateur->ddn_jour == '4' ? '<option value="4" selected>4</option>' : '<option value="4">4</option>').'
				'.($utilisateur->ddn_jour == '5' ? '<option value="5" selected>5</option>' : '<option value="5">5</option>').'
				'.($utilisateur->ddn_jour == '6' ? '<option value="6" selected>6</option>' : '<option value="6">6</option>').'
				'.($utilisateur->ddn_jour == '7' ? '<option value="7" selected>7</option>' : '<option value="7">7</option>').'
				'.($utilisateur->ddn_jour == '8' ? '<option value="8" selected>8</option>' : '<option value="8">8</option>').'
				'.($utilisateur->ddn_jour == '9' ? '<option value="9" selected>9</option>' : '<option value="9">9</option>').'
				'.($utilisateur->ddn_jour == '10' ? '<option value="10" selected>10</option>' : '<option value="10">10</option>').'
				'.($utilisateur->ddn_jour == '11' ? '<option value="11" selected>11</option>' : '<option value="11">11</option>').'
				'.($utilisateur->ddn_jour == '12' ? '<option value="12" selected>12</option>' : '<option value="12">12</option>').'
				'.($utilisateur->ddn_jour == '13' ? '<option value="13" selected>13</option>' : '<option value="13">13</option>').'
				'.($utilisateur->ddn_jour == '14' ? '<option value="14" selected>14</option>' : '<option value="14">14</option>').'
				'.($utilisateur->ddn_jour == '15' ? '<option value="15" selected>15</option>' : '<option value="15">15</option>').'
				'.($utilisateur->ddn_jour == '16' ? '<option value="16" selected>16</option>' : '<option value="16">16</option>').'
				'.($utilisateur->ddn_jour == '17' ? '<option value="17" selected>17</option>' : '<option value="17">17</option>').'
				'.($utilisateur->ddn_jour == '18' ? '<option value="18" selected>18</option>' : '<option value="18">18</option>').'
				'.($utilisateur->ddn_jour == '19' ? '<option value="19" selected>19</option>' : '<option value="19">19</option>').'
				'.($utilisateur->ddn_jour == '20' ? '<option value="20" selected>20</option>' : '<option value="20">20</option>').'
				'.($utilisateur->ddn_jour == '21' ? '<option value="21" selected>21</option>' : '<option value="21">21</option>').'
				'.($utilisateur->ddn_jour == '22' ? '<option value="22" selected>22</option>' : '<option value="22">22</option>').'
				'.($utilisateur->ddn_jour == '23' ? '<option value="23" selected>23</option>' : '<option value="23">23</option>').'
				'.($utilisateur->ddn_jour == '24' ? '<option value="24" selected>24</option>' : '<option value="24">24</option>').'
				'.($utilisateur->ddn_jour == '25' ? '<option value="25" selected>25</option>' : '<option value="25">25</option>').'
				'.($utilisateur->ddn_jour == '26' ? '<option value="26" selected>26</option>' : '<option value="26">26</option>').'
				'.($utilisateur->ddn_jour == '27' ? '<option value="27" selected>27</option>' : '<option value="27">27</option>').'
				'.($utilisateur->ddn_jour == '28' ? '<option value="28" selected>28</option>' : '<option value="28">28</option>').'
				'.($utilisateur->ddn_jour == '29' ? '<option value="29" selected>29</option>' : '<option value="29">29</option>').'
				'.($utilisateur->ddn_jour == '30' ? '<option value="30" selected>30</option>' : '<option value="30">30</option>').'
				'.($utilisateur->ddn_jour == '31' ? '<option value="31" selected>31</option>' : '<option value="31">31</option>').'
			</select>
			/
			<select name="ddn_mois">
				'.($utilisateur->ddn_mois == 'janvier' ? '<option value="janvier" selected>Janvier</option>' : '<option value="janvier">Janvier</option>').'
				'.($utilisateur->ddn_mois == 'fevrier' ? '<option value="fevrier" selected>F&eacute;vrier</option>' : '<option value="fevrier">F&eacute;vrier</option>').'
				'.($utilisateur->ddn_mois == 'mars' ? '<option value="mars" selected>Mars</option>' : '<option value="mars">Mars</option>').'
				'.($utilisateur->ddn_mois == 'avril' ? '<option value="avril" selected>Avril</option>' : '<option value="avril">Avril</option>').'
				'.($utilisateur->ddn_mois == 'mai' ? '<option value="mai" selected>Mai</option>' : '<option value="mai">Mai</option>').'
				'.($utilisateur->ddn_mois == 'juin' ? '<option value="juin" selected>Juin</option>' : '<option value="juin">Juin</option>').'
				'.($utilisateur->ddn_mois == 'juillet' ? '<option value="juillet" selected>Juillet</option>' : '<option value="juillet">Juillet</option>').'
				'.($utilisateur->ddn_mois == 'aout' ? '<option value="aout" selected>Ao&ucirc;t</option>' : '<option value="aout">Ao&ucirc;t</option>').'
				'.($utilisateur->ddn_mois == 'septembre' ? '<option value="septembre" selected>Septembre</option>' : '<option value="septembre">Septembre</option>').'
				'.($utilisateur->ddn_mois == 'octobre' ? '<option value="octobre" selected>Octobre</option>' : '<option value="octobre">Octobre</option>').'
				'.($utilisateur->ddn_mois == 'novembre' ? '<option value="novembre" selected>Novembre</option>' : '<option value="novembre">Novembre</option>').'
				'.($utilisateur->ddn_mois == 'decembre' ? '<option value="decembre" selected>D&eacute;cembre</option>' : '<option value="decembre">D&eacute;cembre</option>').'
			</select>
			/
			<select name="ddn_annee">
				'.($utilisateur->ddn_annee == '1950' ? '<option value="1950" selected>1950</option>' : '<option value="1950">1950</option>').'
				'.($utilisateur->ddn_annee == '1951' ? '<option value="1951" selected>1951</option>' : '<option value="1951">1951</option>').'
				'.($utilisateur->ddn_annee == '1952' ? '<option value="1952" selected>1952</option>' : '<option value="1952">1952</option>').'
				'.($utilisateur->ddn_annee == '1953' ? '<option value="1953" selected>1953</option>' : '<option value="1953">1953</option>').'
				'.($utilisateur->ddn_annee == '1954' ? '<option value="1954" selected>1954</option>' : '<option value="1954">1954</option>').'
				'.($utilisateur->ddn_annee == '1955' ? '<option value="1955" selected>1955</option>' : '<option value="1955">1955</option>').'
				'.($utilisateur->ddn_annee == '1956' ? '<option value="1956" selected>1956</option>' : '<option value="1956">1956</option>').'
				'.($utilisateur->ddn_annee == '1957' ? '<option value="1957" selected>1957</option>' : '<option value="1957">1957</option>').'
				'.($utilisateur->ddn_annee == '1958' ? '<option value="1958" selected>1958</option>' : '<option value="1958">1958</option>').'
				'.($utilisateur->ddn_annee == '1959' ? '<option value="1959" selected>1959</option>' : '<option value="1959">1959</option>').'
				'.($utilisateur->ddn_annee == '1960' ? '<option value="1960" selected>1960</option>' : '<option value="1960">1960</option>').'
				'.($utilisateur->ddn_annee == '1961' ? '<option value="1961" selected>1961</option>' : '<option value="1961">1961</option>').'
				'.($utilisateur->ddn_annee == '1962' ? '<option value="1962" selected>1962</option>' : '<option value="1962">1962</option>').'
				'.($utilisateur->ddn_annee == '1963' ? '<option value="1963" selected>1963</option>' : '<option value="1963">1963</option>').'
				'.($utilisateur->ddn_annee == '1964' ? '<option value="1964" selected>1964</option>' : '<option value="1964">1964</option>').'
				'.($utilisateur->ddn_annee == '1965' ? '<option value="1965" selected>1965</option>' : '<option value="1965">1965</option>').'
				'.($utilisateur->ddn_annee == '1966' ? '<option value="1966" selected>1966</option>' : '<option value="1966">1966</option>').'
				'.($utilisateur->ddn_annee == '1967' ? '<option value="1967" selected>1967</option>' : '<option value="1967">1967</option>').'
				'.($utilisateur->ddn_annee == '1968' ? '<option value="1968" selected>1968</option>' : '<option value="1968">1968</option>').'
				'.($utilisateur->ddn_annee == '1969' ? '<option value="1969" selected>1969</option>' : '<option value="1969">1969</option>').'
				'.($utilisateur->ddn_annee == '1970' ? '<option value="1970" selected>1970</option>' : '<option value="1970">1970</option>').'
				'.($utilisateur->ddn_annee == '1971' ? '<option value="1971" selected>1971</option>' : '<option value="1971">1971</option>').'
				'.($utilisateur->ddn_annee == '1972' ? '<option value="1972" selected>1972</option>' : '<option value="1972">1972</option>').'
				'.($utilisateur->ddn_annee == '1973' ? '<option value="1973" selected>1973</option>' : '<option value="1973">1973</option>').'
				'.($utilisateur->ddn_annee == '1974' ? '<option value="1974" selected>1974</option>' : '<option value="1974">1974</option>').'
				'.($utilisateur->ddn_annee == '1975' ? '<option value="1975" selected>1975</option>' : '<option value="1975">1975</option>').'
				'.($utilisateur->ddn_annee == '1976' ? '<option value="1976" selected>1976</option>' : '<option value="1976">1976</option>').'
				'.($utilisateur->ddn_annee == '1977' ? '<option value="1977" selected>1977</option>' : '<option value="1977">1977</option>').'
				'.($utilisateur->ddn_annee == '1978' ? '<option value="1978" selected>1978</option>' : '<option value="1978">1978</option>').'
				'.($utilisateur->ddn_annee == '1979' ? '<option value="1979" selected>1979</option>' : '<option value="1979">1979</option>').'
				'.($utilisateur->ddn_annee == '1980' ? '<option value="1980" selected>1980</option>' : '<option value="1980">1980</option>').'
				'.($utilisateur->ddn_annee == '1981' ? '<option value="1981" selected>1981</option>' : '<option value="1981">1981</option>').'
				'.($utilisateur->ddn_annee == '1982' ? '<option value="1982" selected>1982</option>' : '<option value="1982">1982</option>').'
				'.($utilisateur->ddn_annee == '1983' ? '<option value="1983" selected>1983</option>' : '<option value="1983">1983</option>').'
				'.($utilisateur->ddn_annee == '1984' ? '<option value="1984" selected>1984</option>' : '<option value="1984">1984</option>').'
				'.($utilisateur->ddn_annee == '1985' ? '<option value="1985" selected>1985</option>' : '<option value="1985">1985</option>').'
				'.($utilisateur->ddn_annee == '1986' ? '<option value="1986" selected>1986</option>' : '<option value="1986">1986</option>').'
				'.($utilisateur->ddn_annee == '1987' ? '<option value="1987" selected>1987</option>' : '<option value="1987">1987</option>').'
				'.($utilisateur->ddn_annee == '1988' ? '<option value="1988" selected>1988</option>' : '<option value="1988">1988</option>').'
				'.($utilisateur->ddn_annee == '1989' ? '<option value="1989" selected>1989</option>' : '<option value="1989">1989</option>').'
				'.($utilisateur->ddn_annee == '1990' ? '<option value="1990" selected>1990</option>' : '<option value="1990">1990</option>').'
				'.($utilisateur->ddn_annee == '1991' ? '<option value="1991" selected>1991</option>' : '<option value="1991">1991</option>').'
				'.($utilisateur->ddn_annee == '1992' ? '<option value="1992" selected>1992</option>' : '<option value="1992">1992</option>').'
				'.($utilisateur->ddn_annee == '1993' ? '<option value="1993" selected>1993</option>' : '<option value="1993">1993</option>').'
				'.($utilisateur->ddn_annee == '1994' ? '<option value="1994" selected>1994</option>' : '<option value="1994">1994</option>').'
				'.($utilisateur->ddn_annee == '1995' ? '<option value="1995" selected>1995</option>' : '<option value="1995">1995</option>').'
				'.($utilisateur->ddn_annee == '1996' ? '<option value="1996" selected>1996</option>' : '<option value="1996">1996</option>').'
				'.($utilisateur->ddn_annee == '1997' ? '<option value="1997" selected>1997</option>' : '<option value="1997">1997</option>').'
				'.($utilisateur->ddn_annee == '1998' ? '<option value="1998" selected>1998</option>' : '<option value="1998">1998</option>').'
				'.($utilisateur->ddn_annee == '1999' ? '<option value="1999" selected>1999</option>' : '<option value="1999">1999</option>').'
				'.($utilisateur->ddn_annee == '2000' ? '<option value="2000" selected>2000</option>' : '<option value="2000">2000</option>').'
			</select>';
			$body .='</td>';
			$body .='</tr>';
			$body .='<tr>';
			$body .='<td>Sexe : </td>';
			$body .='<td><select name="sexe">
			  '.($utilisateur->sexeUtilisateur == 'homme' ? '<option value="homme" selected>Masculin</option>' : '<option value="homme">Masculin</option>').'
			  '.($utilisateur->sexeUtilisateur == 'femme' ? '<option value="femme" selected>F&eacute;minin</option>' : '<option value="femme">F&eacute;minin</option>').'
			</select>';
			$body .='</td>';
			$body .='</tr>';
			$body .='</tr>';
			$body .='<tr>';
			$body .='<td>'.TAPEURLWEBSITE.' : </td>';
			$body .='<td><input name="website" type="text" id="website" value="'.$utilisateur->websiteUtilisateur.'">';
			$body .='</td>';
			$body .='</tr>';			
			$body .='</table></fieldset>';

			
			$body .='</table>';
			
			$body .='';
		
			
 # Fin tabs-1 : informations personnelles
 
 $body .='
  </div>';
 
   $body .='<br /><div id="tabs-3">';
$body .='<table width="100%"  border="0" align="center" cellspacing="0">';
$body .='<tr>';
$body .='<td width="35%">';

$body .='<FIELDSET>';
$body .='<LEGEND>'.VSIGN_DEFAULT.' : </LEGEND>';
if (!empty($utilisateur->signatureUtilisateur)) {

$body .= $utilisateur->signatureUtilisateur;
} else {
$body .= EMPTY_SIGN;
}
$body .='</FIELDSET><br>';
$body .='<FIELDSET>';
$body .='<LEGEND>'.MODIF_SIGNATURE.' : </LEGEND>';
//signature


$body .='<!-- Textarea gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
<textarea id="postContent" name="signature" rows="15" style="width:80%">'.$utilisateur->signatureUtilisateur.'</textarea>';
$body .="</FIELDSET>";

//
$body .='</td>';
$body .='</tr>';
$body .='</table>';

$body .='</form>';  
  $body .='
</div>';
$elements->OpenDynamicMenuSimple();
$elements->ButtonDynamicMenu ('appliquer.png', APPLIQUER, null, 'javascript:document.getElementById(\'formulaire\').submit()', 1);
$elements->NbspDynamicMenu ();
$elements->ButtonDynamicMenu ('retour.png', CANCEL, null, 'espace_membre', 0);
$elements->CloseDynamicMenuSimple();
$body .= $theme_close_boite;
}


}
?>