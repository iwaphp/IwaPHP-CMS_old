<?php
# IwaPHP CMS - Système de gestion de contenu 

if (isset($_SESSION['pseudo'])) { $body .= $theme_open_boite . ERROR_SECONDCOMPTE . $theme_close_boite ; } else {

if (recuperer('active_user') == 'non') {
$body .= $theme_open_boite ;

	$body .= "<body><b>".ATTENTION."</b> ".ATT_EMAIL."<br>";

	$body .= "<strong>".RMQ."</strong> ".LOIS." <br>";

	$body .= '<form method="post" action="'.$index->targetfile.'=espace_membre&action=inscription" onsubmi="return verifForm(this);">';

	$body .= "<FIELDSET>";

	$body .= '<table width="100%" border="0" cellspacing="0">';

	$body .= " <tr>";

	$body .= '<td>';
	$body .= (empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/icones/inscription.png\" alt=\"".FORM_SIGNUP."\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/inscription.png\" alt=\"".FORM_SIGNUP."\" width=\"48\" height=\"48\" \>\n");
	$body .= '</td>';

	$body .= '  <td width="100%"><b>'.FORM_SIGNUP.'</b></td>';

	$body .= " </tr>";

	$body .= "</table>";

	$body .= '<br>L\'inscription de nouveau membres n\'est pas autorisé sur ce site.<br></FIELDSET>';

	$body .= '<input type="submit" name="validation" value="'.SOUMETTRE_SIGNUP.'" onClick="verifForm(this.form);this.form.submit();this.disabled=true;this.value=\''.ONCLICK_SUBMIT_CONNECT.'\'" disabled />&nbsp;<input type="reset" name="Submit" value="'.RESETFORM.'" disabled />';

	$body .= "</form>";

	$body .= $theme_close_boite ;

} else {

	if(isset($_POST['pseudo']) AND isset($_POST['mdp']) AND isset($_POST['verif_mdp']) AND isset($_POST['mail'])) 
	{
		if (preg_match("!^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$!", $_POST['mail'])) {
		$mail = $_POST['mail'];
		$chaine = "abcdefghijklmnopqrstuvwxyz0123456789"; 
		$confirm = str_shuffle($chaine); 
		$pseudo = htmlentities($_POST['pseudo']);
		$mdp = htmlentities($_POST['mdp']);
		$verif_mdp = htmlentities($_POST['verif_mdp']);

		$message1 = '<html><body>'.BONJOUR.' ' . $pseudo . ' '.BIENVENUE_SUR.' ' .$recovery->nom_site. '.</br></br>'.MESSAGE1.MESSAGE1_1.MESSAGE1_2. $pseudo .'.<br>'.MESSAGE1_3. $mdp .'.<br><br>'.MESSAGE1_4.'' . $mail .'.<br><br>'.MESSAGE1_5.MESSAGE1_6.'<br><a href="'.$recovery->url_script. ''.$index->targetfile.'=espace_membre&action=inscription&confirmation&login=' . str_replace(' ','%20',$pseudo) . '&confirm=' . $confirm . '">'.$recovery->url_script.$index->targetfile.'=espace_membre&action=inscription&confirmation&login=' . str_replace(' ','%20',$pseudo) . '&confirm=' . $confirm . '</a><br><br>'.MESSAGE1_7.'<br>'.MESSAGE1_8.'' .$recovery->nom_site. '.<br><a href="' .$recovery->url_site. '">' .$recovery->nom_site. '</a>';
	
		 
				$verif = mysql_query("SELECT COUNT(*) FROM ".$db->prefix_tables."membre WHERE pseudo='".$pseudo."' OR mail='".$mail."'") or die (mysql_error());
				$donnees = mysql_fetch_array($verif)or die (mysql_error());
				if($donnees['COUNT(*)'] >= 1)  { 
				$reponse = ''.EXISTPSEUDO.''; } else {
				if(empty($pseudo) && empty($mdp) && empty($verif_mdp) && empty($mail)) {
				$reponse = ''.MANQUECHAMPS.'';  
				} 
				
				elseif ($mdp != $verif_mdp)  {
				$reponse = ''.PASSNOIDENTIQUE.''; 
				} else {

				$pass_crypte = md5($mdp); 

				mysql_query("INSERT INTO ".$db->prefix_tables."membre(id, pseudo, pass, grade, mail, confirm) VALUES ('','".$pseudo."', '".$pass_crypte."', '".$recovery->grade_visiteurs."', '".$mail."', '".$confirm."')");				

				$reponse = ''.CONTRAGULATIONS . recuperer('nom_site') . RECEVIEWEMAIL.'';
				$enteteee = "MIME-Version: 1.0\r\n";
				$enteteee .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$enteteee .= "From: <".recuperer('email_admin').">\r\n";
				$enteteee .= "Reply-To: ".recuperer('email_admin')."\r\n";
				mail($mail, BIENVENUE_SURR.' '.recuperer('nom_site').' '.$pseudo.'.' , $message1, $enteteee); }
				} 
			 
		} else {
		$reponse = ''.VOTREADRESSEEMAIL.' "' . $mail . '" '.NESTPASCORRECTE.'';  
		} 
		
		$body .= $theme_open_boite ;
		$body .= $reponse; 
		$body .= $theme_close_boite ;		
	
	} elseif (isset($_GET['confirmation'])) {
	
	// Confirmation d'une inscription

	$sql = connect_sql();

	$search = 'SELECT COUNT(*) as nb FROM '.$db->prefix_tables.'membre WHERE pseudo = "'.addslashes($_GET['login']).'" AND confirm = "'.addslashes($_GET['confirm']).'"';

	$req = mysql_query($search) or die(mysql_error()); /*On recupère les infos qui seront dans l'url et on efface la chaine de caractère qui empeche le membre de se connecter*/
	$data = mysql_fetch_array($req);

			if($data['nb'] == 1)
			{

			$login = $_GET['login'];

			mysql_query("UPDATE ".$db->prefix_tables."membre SET `confirm`='' WHERE `pseudo` =".$login."") or die('erreur : '.mysql_error()); 


			$body .=$theme_open_boite;

			$body .= ''.ACTIVEOK.'';

			$body .=$theme_close_boite;

			}

			else /*S'il ne retrouve pas le pseudo il affichera le message suivant*/

			{

			$body .=$theme_open_boite;

			$body .= ''.ACTIVEERROR.'';

			$body .=$theme_close_boite;

			}
	mysql_close($sql);
	
	} else {
	// Formulaire d'inscription

	$body .= $theme_open_boite ;

	$body .= "<body><b>".ATTENTION."</b> ".ATT_EMAIL."<br>";

	$body .= "<strong>".RMQ."</strong> ".LOIS." <br><br>";

	$body .= '<form method="post" action="'.$index->targetfile.'=espace_membre&action=inscription" onsubmi="return verifForm(this);">';

	$body .= "<FIELDSET>";

	$body .= '<table width="100%" border="0" cellspacing="0">';

	$body .= " <tr>";

	$body .= '<td>';
	$body .= (empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/icones/inscription.png\" alt=\"".FORM_SIGNUP."\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/inscription.png\" alt=\"".FORM_SIGNUP."\" width=\"48\" height=\"48\" \>\n");
	$body .= '</td>';

	$body .= '  <td width="100%"><b>'.FORM_SIGNUP.'</b></td>';

	$body .= " </tr>";

	$body .= "</table>";

	$body .= '
	<table width="100%"  border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td id="tableau">'.ENTER_NU.'*:</td>
    <td id="tableau"><input type="text" onMouseOver="poplink(\''.ENTER_NU.'\');" onmouseout="killlink()" name="pseudo" onKeyUp="verifPseudo(this.value)" /></td>
  </tr>
  <tr>
    <td id="tableau">'.ENTER_MDP.'*:</td>
    <td id="tableau"><input name="mdp"  onMouseOver="poplink(\''.ENTER_MDP.'\');" onmouseout="killlink()" type="password" id="mdp" onkeyup="evalPwd(this.value);" /><br /><div id="sm"><ul><li id="weak" class="nrm">'.WEAK.'</li><li id="medium" class="nrm">'.MEDIUM.'</li><li id="strong" class="nrm">'.STRONG.'</li></ul></div></td>
  </tr>
  <tr>
    <td id="tableau">'.CONFIRM_PASS.'*:</td>
    <td id="tableau"><input name="verif_mdp"  onMouseOver="poplink(\''.CONFIRM_PASS.'\');" onmouseout="killlink()" type="password" id="verif_mdp" ><div id="mdpbox"></div></td>
  </tr>
  <tr>
    <td id="tableau">'.TAPE_EMAILL.'*:</td>
    <td id="tableau"><input name="mail"  onMouseOver="poplink(\''.TAPE_EMAILL.'\');" onmouseout="killlink()" type="text" id="mail"></td>
  </tr>
</table>

	
	</FIELDSET>
	<br>
	<FIELDSET><legend>Param&egrave;tres facultatifs</legend>
	<table width="100%" border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td id="tableau">Sexe : </td>
    <td id="tableau"><input type="radio" name="radiobutton" value="radiobutton">
      Masculin<br>
      <input type="radio" name="radiobutton" value="radiobutton">
      F&eacute;minin</td>
  </tr>
  <tr>
    <td id="tableau">Date de naissance : </td>
    <td id="tableau"><select name="ddn_jour">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
      <option value="13">13</option>
      <option value="14">14</option>
      <option value="15">15</option>
      <option value="16">16</option>
      <option value="17">17</option>
      <option value="18">18</option>
      <option value="19">19</option>
      <option value="20">20</option>
      <option value="21">21</option>
      <option value="22">22</option>
      <option value="23">23</option>
      <option value="24">24</option>
      <option value="25">25</option>
      <option value="26">26</option>
      <option value="27">27</option>
      <option value="28">28</option>
      <option value="29">29</option>
      <option value="30">30</option>
      <option value="31">31</option>
    </select>
/
<select name="ddn_mois">
  <option value="janvier">Janvier</option>
  <option value="fevrier">F&eacute;vrier</option>
  <option value="mars">Mars</option>
  <option value="avril">Avril</option>
  <option value="mai">Mai</option>
  <option value="juin">Juin</option>
  <option value="juillet">Juillet</option>
  <option value="aout">Ao&ucirc;t</option>
  <option value="septembre">Septembre</option>
  <option value="octobre">Octobre</option>
  <option value="novembre">Novembre</option>
  <option value="decembre">D&eacute;cembre</option>
</select>
/
<select name="ddn_annee">
  <option value="1950">1950</option>
  <option value="1951">1951</option>
  <option value="1952">1952</option>
  <option value="1953">1953</option>
  <option value="1954">1954</option>
  <option value="1955">1955</option>
  <option value="1956">1956</option>
  <option value="1957">1957</option>
  <option value="1958">1958</option>
  <option value="1959">1959</option>
  <option value="1960">1960</option>
  <option value="1961">1961</option>
  <option value="1962">1962</option>
  <option value="1963">1963</option>
  <option value="1964">1964</option>
  <option value="1965">1965</option>
  <option value="1966">1966</option>
  <option value="1967">1967</option>
  <option value="1968">1968</option>
  <option value="1969">1969</option>
  <option value="1970">1970</option>
  <option value="1971">1971</option>
  <option value="1972">1972</option>
  <option value="1973">1973</option>
  <option value="1974">1974</option>
  <option value="1975">1975</option>
  <option value="1976">1976</option>
  <option value="1977">1977</option>
  <option value="1978">1978</option>
  <option value="1979">1979</option>
  <option value="1980">1980</option>
  <option value="1981">1981</option>
  <option value="1982">1982</option>
  <option value="1983">1983</option>
  <option value="1984">1984</option>
  <option value="1985">1985</option>
  <option value="1986">1986</option>
  <option value="1987">1987</option>
  <option value="1988">1988</option>
  <option value="1989">1989</option>
  <option value="1990">1990</option>
  <option value="1991">1991</option>
  <option value="1992">1992</option>
  <option value="1993">1993</option>
  <option value="1994">1994</option>
  <option value="1995">1995</option>
  <option value="1996">1996</option>
  <option value="1997">1997</option>
  <option value="1998">1998</option>
  <option value="1999">1999</option>
  <option value="2000">2000</option>
</select></td>
  </tr>
</table></FIELDSET>
	';

	if (recuperer('regles_active') == 'oui') {
		if (recuperer('regles_de_site') != '') { 

		$body .= '<br><FIELDSET><legend>'.RMQ_REGLES.'</legend>'; 

		$body .= '<center><textarea name="regles" cols="100" rows="7">'.recuperer('regles_de_site').'</textarea><br>'.NOTE_REGLES.'</center></FIELDSET>' ;

		
		} 
	}
	
	$body .= '<br><FIELDSET><div align="center"><input type="submit" name="validation" value="'.SOUMETTRE_SIGNUP.'" onClick="verifForm(this.form);this.form.submit();this.disabled=true;this.value=\''.ONCLICK_SUBMIT_CONNECT.'\'"  />&nbsp;<input type="reset" name="Submit" value="'.RESETFORM.'">';

	$body .= "</div></FIELDSET></form>";

	$body .= $theme_close_boite ;
	}
	
}
}




?>
