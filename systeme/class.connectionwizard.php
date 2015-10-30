<?php
# IwaPHP CMS - Système de gestion de contenu 

	
class ConnectionWizard {

	var $FormInputTextPseudo = '<input type="text" name="pseudo">' ;
	var $FormInputTextPassword = '<input type="password" name="password">' ;
	var $AvatarImageUser = 'images/noavatar.png';
	
	function ConnectionWizardForm ($Avatar, $Pseudo, $Password, $falseOption)
	{
		global $db, $body, $index;
				
		$body .= '<table border="0" align="center" cellpadding="2" cellspacing="2">
		<tr>
        <td><img src="'.$Avatar.'" width="58" height="58"></td>
        <td>
		<table width="100%"  border="0" cellspacing="1" cellpadding="1">
		<tr>
		<td>Nom d\'utilisateur : </td>
		<td><strong>'.$Pseudo.'</strong></td>
		</tr>
		<tr>
		<td>Mot de passe : </td>
		<td>'.$Password.'</td>
		</tr>
		</table>
		
          
        </td>
        <td>
		'.($falseOption == 0 ? '
		'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="'.$index->targetfile.'=espace_membre&connexion"><b>Je ne suis pas '.ucfirst($Pseudo).'</b></a>
		<br>'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="'.$index->targetfile.'=espace_membre&connexion">Connexion avec un autre compte</a><br>
		'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/puce.gif\" alt=\"\" width=\"15\" height=\"15\" \>\n").' <a href="'.$index->targetfile.'=espace_membre&forget">Effacer</a><br>
		' : null).'
		</td>
		</tr>
		</table><div align="center"><input name="Submit" value="'.SUBMIT_CONNECT.'" type="submit"

		onClick="verifForm(this.form);this.form.submit();this.disabled=true;this.value=\''.ONCLICK_SUBMIT_CONNECT.'\'"></div>';
	
	}
	
	function NewConnection ($falseOption)
	{
		$this->ConnectionWizardForm ($this->AvatarImageUser, $this->FormInputTextPseudo, $this->FormInputTextPassword, $falseOption);
	}
	
	function ConnectionDefined ()
	{
		global $db;
		
		if (isset($_COOKIE['pseudo']) AND isset($_COOKIE['pass'])) {
			$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE `pseudo`='".$_COOKIE['pseudo']."'"); 
			$result = $db->sql_fetchrow($data);
					
			$this->ConnectionWizardForm ((!empty($result['avatar']) ? $result['avatar'] : 'images/noavatar.png'), '<input type="hidden" name="pseudo" value="'.$_COOKIE['pseudo'].'">'.$_COOKIE['pseudo'], '<input type="hidden" name="password" value="'.$_COOKIE['pass'].'">&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;', 0); 
			
		} elseif (isset($_COOKIE['pseudo'])) {
			$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE `pseudo`='".$_COOKIE['pseudo']."'"); 
			$result = $db->sql_fetchrow($data);
					
			$this->ConnectionWizardForm ((!empty($result['avatar']) ? $result['avatar'] : 'images/noavatar.png'), '<input type="hidden" name="pseudo" value="'.$_COOKIE['pseudo'].'">'.$_COOKIE['pseudo'], '<input type="password" name="password">', 0); 
		} else {
			
			$this->ConnectionWizardForm ($this->AvatarImageUser, $this->FormInputTextPseudo, $this->FormInputTextPassword, 1);
			
		}
		
	}
	
}
?>