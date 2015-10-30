<?php
# IwaPHP CMS - Système de gestion de contenu 


if (isset($_SESSION['pseudo'])) {



if (isset($_POST['titre'], $_POST['contenu']) AND !empty($_POST['titre']) AND !empty($_POST['contenu'])) 
{
        
        $titre = htmlentities($_POST['titre'], ENT_QUOTES);
        $pseudo = $utilisateur->nomUtilisateur;
        $contenu = addslashes($_POST['contenu']);
        
        
        mysql_query('INSERT INTO '.$db->prefix_tables.'news (id, titre, contenu, pseudo, timestamp_proposition, timestamp_validation, valide) VALUES ("", "'.$titre.'", "'.$contenu.'", "'.$pseudo.'", "'.time().'", "", 0)');

		$body .= $theme_open_boite_titre ;
$body .= 'Proposer une news';
$body .= $theme_close_boite_titre ;
$body .='Votre news à été envoyé avec succès, elle sera vérifié par un administrateur et peut-être validée très prochainement.';
$body .= $theme_close_boite ;
		} else {

$body .= $theme_open_boite_titre ;
$body .= 'Proposer une news';
$body .= $theme_close_boite_titre ;
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
        theme_advanced_buttons2 : \"cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,forecolor,backcolor\",
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
$body .='<form action="'.$index->targetfile.'=news&proposer" method="post">
        <label>Pseudo : '.$utilisateur->nomUtilisateur.'</label><br />
        <label>Titre : <input type="text" name="titre" /></label><br />
        <textarea name="contenu" id="postContent" cols="50" rows="20"></textarea><br />

        <input type="submit" value="Envoyer" />
</form>';
$body .= $theme_close_boite ;
		}
} else { 
$body .= $theme_open_boite_titre ;
$body .= 'Informations';
$body .= $theme_close_boite_titre ;
$body .='Vous devez être connecté au site pour pouvoir proposer une news.';
$body .= $theme_close_boite ;
}
?>

