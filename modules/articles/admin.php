<?php
# IwaPHP CMS - Système de gestion de contenu 


if (!isset($_SESSION['pseudo'])) { $body .=erreur; } else {
	
	if (isset($_GET['install'])) {
	
	if (isset($_GET['create'])) {
		include 'modules/articles/install.php';
	}
	$body .= $theme_open_boite;
	$body .='<h2>Installation du module</h2>Lancer la proc&eacute;dure d\'installation du module. Voulez-vous continuer ?<br /><br />
	<a href="index.php?admin&onglet=modules&mod=articles&uninstall&create">Accepter</a> - <a href="javascript:history.go(-1);">Annuler</a>';
	$body .= $theme_close_boite;
} elseif (isset($_GET['uninstall'])) {

	if (isset($_GET['drop'])) {
		include 'modules/articles/uninstall.php';
	}
	$body .= $theme_open_boite;
	$body .='<h2>D&eacute;sinstallation</h2>Pass&eacute; ce processus les donn&eacute;es pr&eacute;sente dans la base de donn&eacute;es MySQL seront d&eacute;finitivement supprim&eacute;.<br /><br />
	Cette action est irr&eacuteversible. Voulez-vous continuer ?<br /><br />
	<a href="index.php?admin&onglet=modules&mod=articles&uninstall&drop">Accepter</a> - <a href="javascript:history.go(-1);">Annuler</a>';
	$body .= $theme_close_boite;

} elseif (isset($_GET['action'])) { 

	if ($_GET['action'] == "ajouter") {
		
		if (isset($_GET['modifier_article']))
		{
		$retour = mysql_query('SELECT * FROM '.$db->prefix_tables.'articles WHERE id=' . $_GET['modifier_article']);
		$donnees = mysql_fetch_array($retour);
		$titre = $donnees['titre'];
		$contenu = $donnees['contenu'];
		$id_article = $donnees['id']; 
		}
		else 
		{
		$titre = '';
		$contenu = '';
		$id_article = 0; 
		}
		

$body .= '<h2>Administration des articles</h2><hr>' ;

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
	
		$body .='<form action="index.php?admin&onglet=modules&mod=articles" method="post"><p>Titre de votre article : <input type="text" size="30" name="titre" value="'.$titre.'" /></p>
		<p>Contenu de votre article :<br />
		<textarea  id="postContent" name="contenu" cols="150" rows="50">'.$contenu.'</textarea>
		<br />
		<input type="hidden" name="id_article" value="'.$id_article.'" /><br><input type="submit" name="Submit" value="Envoyer">
		</form>
		<br>
 - <a href="index.php?admin&onglet=modules&mod=articles">Retourner à l\'administration des articles</a>
  <br>
		';
$body .= $theme_close_boite ;
		
	}
	} else {

$body .= '<h2>Administration des articles</h2><hr>' ;



		if (isset($_POST['titre']) AND isset($_POST['contenu']))
		{
		$titre = addslashes($_POST['titre']);
		$contenu = addslashes($_POST['contenu']);

			if ($_POST['id_article'] == 0)
			{
			mysql_query("INSERT INTO ".$db->prefix_tables."articles VALUES('', '" . $titre . "', '" . $contenu . "')");
			} else {
			mysql_query("UPDATE ".$db->prefix_tables."articles SET titre='" . $titre . "', contenu='" . $contenu . "' WHERE id=" . $_POST['id_article']);
			}
		}

		if (isset($_GET['supprimer_article'])) 
		{		
		mysql_query('DELETE FROM '.$db->prefix_tables.'articles WHERE id=' . $_GET['supprimer_article']);
		}

		$body .='<table width="100%" border="0" id="tableau" cellspacing="2">
  <tr>
    <td id=titre_tableau width="33%"><strong>Titre</strong></td>
    <td id=titre_tableau width="33%"><strong>Adresse</strong></td>
    <td id=titre_tableau><strong>Actions</strong></td>
  </tr>';
		
$retour = mysql_query('SELECT * FROM '.$db->prefix_tables.'articles ORDER BY id DESC');
while ($donnees = mysql_fetch_array($retour)) 
{
$body .='<tr>
    <td id=tableau width="33%">'.$donnees['titre'].'</td>
    <td id=tableau width="33%">'.$index->targetfile.'=articles&id='.$donnees['id'].' [ <a href="'.$index->targetfile.'=articles&id='.$donnees['id'].'">Voir</a> ]</td>
    <td id=tableau>[ <a href="index.php?admin&onglet=modules&mod=articles&supprimer_article=' . $donnees['id'] . '">Supprimer</a> | <a href="index.php?admin&onglet=modules&mod=articles&action=ajouter&amp;modifier_article=' . $donnees['id'] . '">Modifier</a> ] </td>
  </tr>';

}
$body .= '</table><br />'; 
$elements->OpenDynamicMenuSimple ();

$elements->ButtonDynamicMenu ('add.png', 'Ajouter un article', '', $index->rootfile.'?admin&onglet=modules&mod=articles&action=ajouter', 1);
$elements->NbspDynamicMenu ();

$elements->ButtonDynamicMenu ('retour.png', 'Index des modules', '', $index->rootfile.'?admin&onglet=modules', 1);
$elements->NbspDynamicMenu ();

$elements->CloseDynamicMenuSimple ();
	
$body .= $theme_close_boite ;
	} 

} 
?>