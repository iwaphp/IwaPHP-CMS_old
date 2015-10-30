<?php
# IwaPHP CMS - Système de gestion de contenu 


class func
{
	
	function redirection ($reponse, $redirection, $time)
	{
	global $body, $theme_open_login_boite, $theme_close_login_boite;
	$body .= $theme_open_login_boite ;
	$body .= $reponse; 
	$body .= "<SCRIPT LANGUAGE='JavaScript'>\n";
	$body .= "<!--\n";
	$body .= "function redirect() \n";
	$body .= "{\n";
	$body .= "window.location='".$redirection."' \n";
	$body .= "}\n";
	$body .= "setTimeout('redirect()',".$time."); \n";
	$body .= "-->\n";
	$body .= "</SCRIPT>\n";
	$body .= $theme_close_login_boite ;
	}
	
	function FormulaireBBcode ($textarea, $formaction, $formname, $booleanform)
	
	{
		global $body;
	
		$body .= '<form method="post" action="'.$formaction.'" name="'.$formname.'" '.($booleanform == 1 ? 'id="formulaire"' : null ).'>
		<fieldset><legend>Mise en forme</legend>
		<input type="button" id="gras" name="gras" value="Gras" onClick="javascript:bbcode(\'[g]\', \'[/g]\');return(false)" />
		<input type="button" id="italic" name="italic" value="Italic" onClick="javascript:bbcode(\'[i]\', \'[/i]\');return(false)" />
		<input type="button" id="souligné" name="souligné" value="Souligné" onClick="javascript:bbcode(\'[s]\', \'[/s]\');return(false)" />
		<input type="button" id="lien" name="lien" value="Lien" onClick="javascript:bbcode(\'[url]\', \'[/url]\');return(false)" />
		<br /><br />
		<img src="systeme/smileys/heureux.gif" title="heureux" alt="heureux" onClick="javascript:smilies(\':D\');return(false)" />
		<img src="systeme/smileys/lol.gif" title="lol" alt="lol" onClick="javascript:smilies(\':lol:\');return(false)" />
		<img src="systeme/smileys/triste.gif" title="triste" alt="triste" onClick="javascript:smilies(\':triste:\');return(false)" />
		<img src="systeme/smileys/cool.gif" title="cool" alt="cool" onClick="javascript:smilies(\':frime:\');return(false)" />
		<img src="systeme/smileys/rire.gif" title="rire" alt="rire" onClick="javascript:smilies(\'XD\');return(false)" />
		<img src="systeme/smileys/confus.gif" title="confus" alt="confus" onClick="javascript:smilies(\':s\');return(false)" />
		<img src="systeme/smileys/choc.gif" title="choc" alt="choc" onClick="javascript:smilies(\':O\');return(false)" />
		<img src="systeme/smileys/question.gif" title="?" alt="?" onClick="javascript:smilies(\':interrogation:\');return(false)" />
		<img src="systeme/smileys/exclamation.gif" title="!" alt="!" onClick="javascript:smilies(\':exclamation:\');return(false)" /></fieldset>
		<br>
		<fieldset><legend>Contenu</legend><textarea cols="80" rows="8" id="message" name="message">
		'.$textarea.'
		</textarea></fieldset>
		<p>
		<input type="submit" name="submit" value="Envoyer" />
		<input type="reset" name = "Effacer" value = "Effacer"/></p>
		</form>';
	}
	
	
}
$func = new func();
?>