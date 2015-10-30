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
		if (preg_match("/\bconfiguration\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >
$contenu = null;


if (isset($_POST['module_demarrage']) AND isset($_POST['theme']) AND isset($_POST['lang']) AND isset($_POST['active_user'])  AND isset($_POST['active_memberlist'])  AND isset($_POST['changer_pseudo'])  AND isset($_POST['changer_email']) AND isset($_POST['active_regles'])) {

	$db->sql_query("UPDATE ".$db->prefix_tables."options SET module_demarrage='".$_POST['module_demarrage']."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET theme='".$_POST['theme']."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET lang_general='".$_POST['lang']."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET active_user='".$_POST['active_user']."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET active_memberlist='".$_POST['active_memberlist']."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET changer_pseudo='".$_POST['changer_pseudo']."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET changer_email='".$_POST['changer_email']."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET regles_active='".$_POST['active_regles']."' WHERE id='1'");
		
	$body .= submit_form;
	} else {
$body .= '<h2>Fonctionnalit&eacute;s du portail</h2>
<form name="options" method="post" action="index.php?admin&op=fonctions"><FIELDSET><LEGEND>Variables</LEGEND>';
$body .= C_MODDEM.' : <br><select name="module_demarrage">';

$reponse3 = opendir($index->rootpath.'/modules') ;
while ($file3 = readdir($reponse3)) 
{
if($file3 != '..' && $file3 !='.' && $file3 !='' && $file3 !='' && $file3 !='' && $file3 !='' && $file3 !='admin' && $file3 !='menus' && $file3 !='update' && $file3 !='index.html' && $file3 !='index.htm')
{
$dir_modules = $file3;

	if ($dir_modules == recuperer('module_demarrage')) 
    {
     
	$body .= '<option selected="selected" value='.$dir_modules.'>'.$dir_modules.'</option>';       
			 
    } else { 
	
	$body .= '<option value='.$dir_modules.'>'.$dir_modules.'</option>';
	
	}
} 


  }
$body .= '<br></select>
    <br>
    <br>
    '.C_SKINDEF.' : <br><select name="theme">';

$reponse = opendir($index->rootpath.'/themes') ;
while ($file = readdir($reponse)) 
{
if($file != '..' && $file !='.' && $file !='' && $file !='' && $file !='' && $file !='' && $file !='index.html' && $file !='index.htm')
{
$dir_theme = $file;
	
	if ($dir_theme == recuperer('theme')) 
    {
    
	$body .= '<option selected="selected" value='.$dir_theme.'>'.$dir_theme.'</option>';
      
    } else {  
	
$body .='<option value='.$dir_theme.'>'.$dir_theme.'</option>';
	
	}
} 

}
$body .= '<br></select>
    <br>
    <br>
    Langue par d&eacute;fault: <br><select name="lang">';

$reponse2 = opendir($index->rootpath.'/systeme/langues') ;
while ($file2 = readdir($reponse2)) 
{
if($file2 != '..' && $file2 !='.' && $file2 !='' && $file2 !='' && $file2 !='' && $file2 !='' && $file2 !='index.html' && $file2 !='index.htm')
{
$dir_lang = $file2;

	if ($dir_lang == recuperer('lang_general')) 
    {
	
	$body .= '<option selected="selected" value='.$dir_lang.'>'.$dir_lang.'</option>';
        			
    } else { 
	
	$body .='<option value='.$dir_lang.'>'.$dir_lang.'</option>';
	
	}
} 


}

   
$body .= '<br></select>
    <br>
  <br></FIELDSET>
';
$body .= '<br /><FIELDSET><LEGEND>Paramètres utilisateurs</LEGEND>
    Autoriser l\'enregistrement de nouveau utilisateurs sur le site : <br>
    <select name="active_user">';
if (recuperer('active_user') == 'oui') 
        {
		
		$body .= '<option selected="selected" value=oui>Oui</option>'; 
        $body .= '<option value=non>Non</option>';    
        } else {  
		$body .= '<option selected="selected" value=non>Non</option>';
		$body .= '<option value=oui>Oui</option>'; 
		}
   
$body .= '<br></select>
    <br>
    <br>
Afficher la liste des membres :<br>
  <select name="active_memberlist">';
if (recuperer('active_memberlist') == 'oui') 
        {
		
		$body .='<option selected="selected" value=oui>Oui</option>'; 
       $body .='<option value=non>Non</option>';    
        } else {  
		$body .='<option selected="selected" value=non>Non</option>';
		$body .='<option value=oui>Oui</option>'; 
		}
   
$body .= '<br></select>
  <br><br>
Afficher les règles du site lors de l\'enregistrement de nouveau utilisateurs :<br>
  <select name="active_regles">';
if (recuperer('regles_active') == 'oui') 
        {
		
		$body .= '<option selected="selected" value=oui>Oui</option>'; 
        $body .= '<option value=non>Non</option>';    
        } else {  
		$body .= '<option selected="selected" value=non>Non</option>';
		$body .= '<option value=oui>Oui</option>'; 
		}
   
$body .= '<br></select>
  <br>
  <br>
 '.OP_CHANGER_PSEUDO.' : <br><select name="changer_pseudo">';
if (recuperer('changer_pseudo') == 'oui') 
        {
		
		$body .= '<option selected="selected" value=oui>Oui</option>'; 
        $body .='<option value=non>Non</option>';    
        } else {  
		$body .='<option selected="selected" value=non>Non</option>';
		$body .='<option value=oui>Oui</option>'; 
		}
   
$body .='<br></select>
<br />
<br />
    '.OP_CHANGER_EMAIL.' : <br><select name="changer_email">';
if (recuperer('changer_email') == 'oui') 
        {
		
		$body .= '<option selected="selected" value=oui>Oui</option>'; 
      $body .='<option value=non>Non</option>';    
        } else {  
		$body .='<option selected="selected" value=non>Non</option>';
		$body .='<option value=oui>Oui</option>'; 
		}
   
$body .= '<br></select>
<br />
<br />';
$body .='<br></select>
</FIELDSET>';
$body .= '<br><fieldset><legend>Actions</legend><input type="submit" name="Submit" value="Envoyer">
</form><table width="100%" border="0" cellspacing="2" id="tableau">
	<tr>
    <td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
    <td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="index.php?admin">'.CANCEL.'</a></td>
  </tr>
	</table></fieldset>
	';
 
}
}}
?>
