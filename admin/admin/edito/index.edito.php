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
		if (preg_match("/\bapparence\b/i", $result_level['valeur'])) {

######################################################################################################################################
# --- Affichage du contenu --- >



	if(isset($_POST['edito'])) {
		$edito = addslashes($_POST['edito']);
		$db->sql_query("UPDATE ".$db->prefix_tables."options SET edito='".$edito."' WHERE id='1'");
		$body.=submit_form;
	} else {

$body .= '<fieldset><legend>Modifier le contenu de la page d\'accueil</legend>';


$body .= '<form name="options" method="post" action="index.php?admin&op=edito">';



  
  
# Widget Tiny_mce
$body .= "<script src=\"systeme/javascripts/tiny_mce/tiny_mce.js\" type=\"text/javascript\"></script>
<script type=\"text/xml\">
<!--
<oa:widgets>
  <oa:widget wid=\"2204022\" binding=\"#postContent\" />
</oa:widgets>
-->
</script>";
$body .= "<script type=\"text/javascript\">
// BeginOAWidget_Instance_2204022: #postContent

	tinyMCE.init({
		// General options
		mode : \"exact\",
		elements : \"postContent\",
		theme : \"advanced\",
		skin : \"default\",
		plugins : \"pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave\",

		// Theme options
		theme_advanced_buttons1 : \"newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect\",
        theme_advanced_buttons2 : \"cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor\",
        theme_advanced_buttons3 : \"insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions\",      
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
 $body .= '<textarea id="postContent" rows="30" cols="80" name="edito">'.recuperer('edito').'</textarea>';


$body .= '<input type="submit" name="Submit" value="Envoyer">
<input type="reset" name="Submit" value="R&eacute;initialiser"></form><table width="100%" border="0" cellspacing="2" id="tableau">
	<tr>
    <td width="50">'.(empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".$recovery->theme."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/icones/retour.png\" alt=\"\" width=\"48\" height=\"48\" \>\n").'</td>
    <td><a onMouseOver="poplink(\''.CANCEL.'\');" onmouseout="killlink()" href="'.$index->targetfile.'=espace_membre&dossier=admin&outil=pannel_config">'.CANCEL.'</a></td>
  </tr>
	</table></fieldset>';

	}

} }

?>
