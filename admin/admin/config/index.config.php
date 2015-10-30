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

	if (isset($_POST['nom_site']) AND isset($_POST['url_site']) AND isset($_POST['url_logo']) AND isset($_POST['description'])  AND isset($_POST['keywords'])  AND isset($_POST['nom_licence'])  AND isset($_POST['regles_de_site']) AND isset($_POST['copyrights'])) {
	
	$nom_site = htmlentities($_POST['nom_site']);
	$nom_site = addslashes($nom_site);
	$url_site = htmlentities($_POST['url_site']);
	$url_logo = htmlentities($_POST['url_logo']);
	$description = htmlentities($_POST['description']);
	$description = addslashes($description);
	$keywords = htmlentities($_POST['keywords']);
	$nom_licence = htmlentities($_POST['nom_licence']);
	$nom_licence = addslashes($nom_licence);
	$regles_de_site = htmlentities($_POST['regles_de_site']);
	$regles_de_site = addslashes($regles_de_site);
	$copyrights = addslashes($_POST['copyrights']);
	
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET nom_site='".$nom_site."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET url_site='".$url_site."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET url_logo='".$url_logo."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET description='".$description."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET keywords='".$keywords."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET nom_licence='".$nom_licence."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET regles_de_site='".$regles_de_site."' WHERE id='1'");
	$db->sql_query("UPDATE ".$db->prefix_tables."options SET copyrights='".$copyrights."' WHERE id='1'");
		
	$body .= submit_form;
	} else {
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
	$body .= '<form name="form1" method="post" action="index.php?admin&op=config"><fieldset><legend>Configuration portail</legend><table width="100%" id=tableau border="0" cellspacing="2" cellpadding="0">
  <tr>
    <td>Nom du site : </td>
    <td><input type="text" name="nom_site" value="'.recuperer('nom_site').'"></td>
  </tr>
  <tr>
    <td>Adresse du site : </td>
    <td>'.(recuperer('url_site') == '' ? '<input type="text" name="url_site" value="http://'.$_SERVER['HTTP_HOST'].'/">' : '<input type="text" name="url_site" value="'.recuperer('url_site').'">').'</td>
  </tr>
  <tr>
    <td>Adresse du logo : </td>
    <td><input type="text" name="url_logo" value="'.recuperer('url_logo').'"></td>
  </tr>
  <tr>
    <td>Description de votre site : </td>
    <td><textarea name="description" cols="25" rows="4">'.recuperer('description').'</textarea></td>
  </tr>
  <tr>
    <td>Mots cl&eacute;s du site : </td>
    <td><input type="text" name="keywords" value="'.recuperer('keywords').'"></td>
  </tr>
  <tr>
    <td>Nom du fondateur : </td>
    <td><input type="text" name="nom_licence" value="'.recuperer('nom_licence').'"></td>
  </tr>
  <tr>
    <td>R&egrave;gles du site : </td>
    <td>'.(recuperer('regles_active') == 'non' ? '<em>Les règles ne sont pas activés, pour les activer allez dans "Choix des fonctionnalités" et choisissez "Oui" dans "Activer les règles".</em><br><textarea name="regles_de_site" cols="25" rows="12">'.recuperer('regles_de_site').'</textarea>' : '<textarea name="regles_de_site" cols="25" rows="12">'.recuperer('regles_de_site').'</textarea>').'</td>
  </tr>
  <tr>
    <td>Copyrights personnalis&eacute; : </td>
    <td><textarea name="copyrights" cols="25" rows="8">'.recuperer('copyrights').'</textarea></td>
  </tr>
';
	

	$body .= $operation->CloseFormPost();
	
	}

}}

?>
