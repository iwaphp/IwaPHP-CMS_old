<?php
# IwaPHP CMS - Système de gestion de contenu 

$titre = 'news';
if (!isset($_SESSION['pseudo'])) { $body .=erreur; } else {

 
	if (isset($_GET['install'])) {
	
	if (isset($_GET['create'])) {
	
		include 'modules/news/install.php';
	}
	$body .= $theme_open_boite;
	$body .='<h2>Installation du module</h2>Lancer la proc&eacute;dure d\'installation du module. Voulez-vous continuer ?<br /><br />
	<a href="index.php?admin&onglet=modules&mod=news&uninstall&create">Accepter</a> - <a href="javascript:history.go(-1);">Annuler</a>';
	$body .= $theme_close_boite;
} elseif (isset($_GET['uninstall'])) {

	if (isset($_GET['drop'])) {
		include 'modules/news/uninstall.php';
	}
	$body .= $theme_open_boite;
	$body .='<h2>D&eacute;sinstallation</h2>Pass&eacute; ce processus les donn&eacute;es pr&eacute;sente dans la base de donn&eacute;es MySQL seront d&eacute;finitivement supprim&eacute;.<br /><br />
	Cette action est irr&eacuteversible. Voulez-vous continuer ?<br /><br />
	<a href="index.php?admin&onglet=modules&mod=news&uninstall&drop">Accepter</a> - <a href="javascript:history.go(-1);">Annuler</a>';
	$body .= $theme_close_boite;

} elseif (isset($_GET['rediger_news'])) {
		
		
		if (isset($_GET['modifier_news']) AND !empty($_GET['modifier_news']))
		{
			$modifier_news = intval($_GET['modifier_news']); // cette variable contient l'id de la news à modifier
        
			$requete = mysql_query('SELECT id, titre, contenu, pseudo FROM '.$db->prefix_tables.'news WHERE id='.$modifier_news);
			$donnees = mysql_fetch_assoc($requete);
        
			$titre = $donnees['titre'];
			$contenu = $donnees['contenu'];
			$pseudo = $donnees['pseudo'];
			$id_news = $donnees['id'];
		}
		else
		{
			$titre = '';
			$contenu = '';
			$pseudo = '';
			$id_news = 0;
		}
		$body .= $theme_open_boite;
		$body .= '<h2>Rédiger/Modifier une news</h2><hr />' ;
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
		$body .='<form action="index.php?admin&onglet=modules&mod=news&liste_news" method="post">
        <label>Pseudo : '.$utilisateur->nomUtilisateur.'</label><br />
        <label>Titre : <input type="text" name="titre" value="'.$titre.'" /></label><br />
        <textarea  id="postContent" name="contenu" cols="80" rows="30">'.$contenu.'</textarea><br />

        <input type="hidden" name="id_news" value="'.$id_news.'" />
        <input type="submit" value="Envoyer" />
		</form><a href="index.php?admin&onglet=modules&mod=news">Réduire</a>';   
		$body .= $theme_close_boite;

	} elseif (isset($_GET['liste_news'])) {
		
		
		
		if (isset($_POST['titre'], $_POST['contenu'], $_POST['id_news']) AND !empty($_POST['titre']) AND !empty($_POST['contenu']))
		{
       
	   
        $titre = $_POST['titre'];
        $contenu = addslashes($_POST['contenu']);
        $pseudo = $utilisateur->nomUtilisateur;
        $id_news = intval($_POST['id_news']);
        
        if ($id_news == 0) 
		
        {
                mysql_query('INSERT INTO '.$db->prefix_tables.'news (id, titre, contenu, pseudo, timestamp_proposition, timestamp_validation, valide) VALUES ("", "'.$titre.'", "'.$contenu.'", "'.$pseudo.'", "", "'.time().'", 1)');
        }
        else 
		
        {
                mysql_query('UPDATE '.$db->prefix_tables.'news SET titre="'.$titre.'", contenu="'.$contenu.'" WHERE id='.$id_news);
        }
		}
		
		if (isset($_GET['suppr_news']) AND !empty($_GET['suppr_news']))
		{
        $suppr_news = intval($_GET['suppr_news']); 
        
        mysql_query('DELETE FROM '.$db->prefix_tables.'news WHERE id='.$suppr_news); 
        mysql_query('DELETE FROM '.$db->prefix_tables.'news_commentaires WHERE idnews='.$suppr_news); 
		}
		$body .= $theme_open_boite;
		$body .= '<h2>Liste des news</h2><hr />' ;
			$body .='<table border="0" width="100%"><tr>
<td  id=titre_tableau><b>Supprimer</b></td>
<td id=titre_tableau ><strong>Modifier</strong></td>
<td id=titre_tableau><strong>Titre</strong></td>
<td id=titre_tableau><strong>Date</strong></td>
<td id=titre_tableau><strong>Etat</strong></td>
</tr>';
		
		$requete = $db->sql_query('SELECT * FROM '.$db->prefix_tables.'news ORDER BY timestamp_validation DESC');
		while ($donnees = $db->sql_fetchrow($requete))
		{
		
		$body .='<tr>';
		
$body .='<td id=tableau>'.(!empty($utilisateur->themeUtilisateur) ? "<img border=0 src=\"themes/".$utilisateur->themeUtilisateur."/images/puces/supprimer.png\" alt=\"\" width=\"16\" height=\"16\" \>\n" : "<img border=0 src=\"themes/".recuperer('theme')."/images/puces/supprimer.png\" alt=\"\" width=\"16\" height=\"16\" \>\n").'<a href="index.php?admin&onglet=modules&mod=news&liste_news&suppr_news='.$donnees['id'].'">Supprimer</a></td>';
$body .='<td id=tableau>'.(!empty($utilisateur->themeUtilisateur) ? "<img border=0 src=\"themes/".$utilisateur->themeUtilisateur."/images/puces/edit.png\" alt=\"\" width=\"16\" height=\"16\" \>\n" : "<img border=0 src=\"themes/".recuperer('theme')."/images/puces/edit.png\" alt=\"\" width=\"16\" height=\"16\" \>\n").'<a href="index.php?admin&onglet=modules&mod=news&rediger_news&modifier_news='.$donnees['id'].'">Modifier</a></td>';
$body .='<td id=tableau> '.stripslashes($donnees['titre']).'</td>';
$body .='<td id=tableau> '.date('d/m/Y', $donnees['timestamp_proposition']).'</td>';

        
			if ($donnees['valide'] == 0)
			{
					$body .= '<td><a href="index.php?admin&onglet=modules&mod=news&valider&valide_news='.$donnees['id'].'">Valider</a></td></tr>'; 
			}
			else
			{
					$body .= '<td>Validée</td></tr>';
			}

		}
		$body .='</table><a href="index.php?admin&onglet=modules&mod=news">Réduire</a>';
		$body .= $theme_close_boite;
	} elseif (isset($_GET['options'])) {
	if(isset($_POST['nbr_de_com']) AND isset($_POST['nbr_de_news'])) {
	
	$nbr_message_afficher = $_POST['nbr_de_com'];
	$nbr_de_news = $_POST['nbr_de_news'];
	mysql_query("UPDATE ".$db->prefix_tables."news_op SET valeur='".$nbr_message_afficher."' WHERE nom='nbr_de_com'");   
	mysql_query("UPDATE ".$db->prefix_tables."news_op SET valeur='".$nbr_de_news."' WHERE nom='nbr_de_news'");
$body .= submit_form ;
	} else {
	
	
$body .= $theme_open_boite;
$body .= '<h2>Modifier les options du module de news</h2><hr />' ;


$select = mysql_query("SELECT * FROM ".$db->prefix_tables."news_op WHERE nom='nbr_de_news'");
$data = mysql_fetch_array($select);
$select2 = mysql_query("SELECT * FROM ".$db->prefix_tables."news_op WHERE nom='nbr_de_com'");
$data2 = mysql_fetch_array($select2);

$body .= '<form action="index.php?admin&onglet=modules&mod=news&options" method="post">Afficher les 
  <input name="nbr_de_news" type="text" size="3" maxlength="3" value="'.$data['valeur'].'">
dernieres news <br />Afficher les 
  <input name="nbr_de_com" type="text" size="3" maxlength="3" value="'.$data2['valeur'].'">
derniers commentaires dans les news <br /><br />
  <input type="submit" name="Submit" value="Appliquer les modifications"></form>
 <a href="index.php?admin&onglet=modules&mod=news">Réduire</a>';
 $body .= $theme_close_boite;
	}
	} elseif (isset($_GET['valider'])) {
		if (isset($_GET['valide_news']) AND !empty($_GET['valide_news']))
		{
        $valide_news = intval($_GET['valide_news']); 
        
        mysql_query('UPDATE '.$db->prefix_tables.'news SET valide=1, timestamp_validation='.time().', timestamp_proposition=0 WHERE id='.$valide_news); 
        
        header('location: index.php?admin&onglet=modules&mod=news&liste_news');
		}
		else
		{
        header('location: '.$index->rootfile); 
		}

	}
	
$body .= '<h2>'.ADMIN_NEWS.'</h2><hr />' ;
	$elements->OpenDynamicMenuSimple ();

	$elements->ButtonDynamicMenu ('edit.png', 'R&eacute;diger une news', 'Ajouter une news sur votre site.', $index->rootfile.'?admin&onglet=modules&mod=news&rediger_news', 1);
	$elements->NbspDynamicMenu ();
	
	$elements->ButtonDynamicMenu ('list.png', 'Liste des news', 'Voir la liste des news posté sur votre site pour pouvoir les modifier ou les supprimer.', $index->rootfile.'?admin&onglet=modules&mod=news&liste_news', 1);
	$elements->NbspDynamicMenu ();
	
	$elements->ButtonDynamicMenu ('options.png', 'Options', 'Gérer les options pour ce module.', $index->rootfile.'?admin&onglet=modules&mod=news&options', 1);
	$elements->NbspDynamicMenu ();
	
	$elements->ButtonDynamicMenu ('retour.png', 'Index des modules', '', $index->rootfile.'?admin&onglet=modules', 1);
	$elements->NbspDynamicMenu ();
	
	$elements->CloseDynamicMenuSimple ();


	
	


 }

?>