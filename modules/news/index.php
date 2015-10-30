<?php
# IwaPHP CMS - Système de gestion de contenu 


if (isset($_GET['proposer'])) {

include 'modules/news/proposer.php' ;

} elseif (isset($_GET['commentaires'])) {


$id_news = intval($_GET['id_news']); 

$requete = mysql_query('SELECT id, titre, contenu, pseudo, timestamp_validation FROM '.$db->prefix_tables.'news WHERE id='.$id_news);
$donneesnews = mysql_fetch_array($requete);


$limit_par_feuille = 5; 
if (isset($_GET['feuille']) AND !empty($_GET['feuille']))
{
        $feuille = intval($_GET['feuille']);
}
else
{
        $feuille = 1;
}
$from = ($feuille - 1) * $limit_par_feuille;

$requete_news = mysql_query('SELECT id, titre, contenu, pseudo, timestamp_validation FROM '.$db->prefix_tables.'news WHERE id='.$id_news);

while ($donnees_news = mysql_fetch_array($requete_news))
{
        
	$body .= $theme_open_boite_titre ;
	$body .= $donnees_news['titre'];
	$body .= $theme_close_boite_titre ;
	$body .= nl2br(stripslashes($donnees_news['contenu']));
	$body .= $theme_close_boite ;
	$body .= $theme_open_boite ;
	$body .= ''.AJOUTERPAR_NEWS.'';
	$body .= '&nbsp;';
	$body .= '<a href="'.$index->targetfile.'=memberlist&profil='.$donnees_news['pseudo'].'">'.$donnees_news['pseudo'].'</a>';
	$body .= '&nbsp;&nbsp;';
	$body .= '' .LE_NEWS. '';
	$body .= '&nbsp;';
	$body .= date('d/m/Y', $donnees_news['timestamp_validation']) .'&nbsp;à&nbsp;'. date('H\hi', $donnees_news['timestamp_validation'])  ;
	$body .= '- [ <a href="'.$index->targetfile.'=news&ajout_commentaire&id_news='.$donnees_news['id'].'">Ajouter un commentaire</a> ]';
	$body .= $theme_close_boite .'<br /><b>Commentaires :</b>';
	   
}

$requete2 = mysql_query('SELECT id, pseudo, message, timestamp FROM '.$db->prefix_tables.'news_commentaires WHERE idnews='.$id_news.' ORDER BY id DESC LIMIT '.$from.', '.$limit_par_feuille);
while($donnees = mysql_fetch_array($requete2))
{



    $body .= $theme_open_boite;
	$body .= nl2br(stripslashes($donnees['message']));
	$body .= $theme_close_boite ;
	$body .= $theme_open_boite ;
	$body .= ''.AJOUTERPAR_NEWS.'';
	$body .= '&nbsp;';
	$body .= '<a href="'.$index->targetfile.'=memberlist&profil='.$donnees['pseudo'].'">'.$donnees['pseudo'].'</a>';
	$body .= '&nbsp;';
	$body .= '' .LE_NEWS. '';
	$body .= '&nbsp;';
	$body .= date('d/m/Y', $donnees['timestamp'])   ;
	
	$body .= $theme_close_boite.'<br />' ;
}
$body .='[ <a href="'.$index->targetfile.'=news&ajout_commentaire&id_news='.$_GET['id_news'].'">Ajouter un commentaire</a> ]<br />';

$requete3 = mysql_query('SELECT COUNT(id) AS nb_commentaires FROM '.$db->prefix_tables.'news_commentaires WHERE idnews='.$id_news);
$donnees2 = mysql_fetch_assoc($requete3);

$nb_feuille = ceil($donnees2['nb_commentaires'] / $limit_par_feuille);
$body .= '<br />Pages :&nbsp;';
for ($i=1 ; $i<=$nb_feuille ; $i++)
{
        if ($i == $feuille)
        {
                $body .= '&nbsp;['.$i.']&nbsp;';
        }
        else
        {
                $body .= '<a href="'.$index->targetfile.'=news&commentaires&id_news='.$id_news.'&amp;feuille='.$i.'">'.$i.'</a>';
        }
}



} elseif (isset($_GET['ajout_commentaire'])) {
if (isset($_SESSION['pseudo'])) {
if (isset($_POST['postContent'], $_GET['id_news']) AND !empty($_POST['postContent']) AND !empty($_GET['id_news']))
{
        
        $id_news = intval($_GET['id_news']);
        $pseudo = $utilisateur->nomUtilisateur;
        $message = addslashes($_POST['postContent']);
     
        
        mysql_query("INSERT INTO ".$db->prefix_tables."news_commentaires (pseudo, message, idnews, timestamp) VALUES ('".$pseudo."', '".$message."', '".$id_news."', '".time()."')");
		header('location:index.php?'.$index->rootget.'=news&commentaires&id_news='.$id_news.'');
}
$id_news = intval($_GET['id_news']);
$body .= $theme_open_boite_titre ;
$body .= 'Ajouter un commentaire';
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
		theme_advanced_buttons1 : \"save,newdocument,print,bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect,\",
		theme_advanced_buttons2 : \"\",
		theme_advanced_buttons3 : \"\",
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
$body .='Saisissez votre commentaire <br /><br /><form method="post" action="'.$index->targetfile.'=news&ajout_commentaire&id_news='.$id_news.'" name="news"><!-- Textarea gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
<textarea id="postContent" name="postContent" rows="15" style="width:80%"></textarea><br />
<input type="submit" name="button" id="button" value="Envoyer" /></form>';    
$body .= $theme_close_boite ;
} else {  
$body .= $theme_open_boite ;
$body .= 'Vous devez être connecté au site pour pouvoir ajouter un nouveau commentaire.';
$body .= $theme_close_boite ; }

} elseif (isset($_GET['archives'])) {

include $main->ROOTPATH . 'modules/news/archives.php';

} else {

$requete_news = mysql_query('SELECT '.$db->prefix_tables.'news.id, '.$db->prefix_tables.'news.titre, '.$db->prefix_tables.'news.contenu, '.$db->prefix_tables.'news.pseudo, '.$db->prefix_tables.'news.timestamp_validation, COUNT('.$db->prefix_tables.'news_commentaires.id) AS nb_commentaires FROM '.$db->prefix_tables.'news LEFT JOIN '.$db->prefix_tables.'news_commentaires ON '.$db->prefix_tables.'news.id='.$db->prefix_tables.'news_commentaires.idnews WHERE '.$db->prefix_tables.'news.valide=1 GROUP BY '.$db->prefix_tables.'news.id ORDER BY '.$db->prefix_tables.'news.timestamp_validation DESC LIMIT 0, 5');

while ($donnees_news = mysql_fetch_assoc($requete_news))
{
        
	$body .= $theme_open_boite_titre ;
	$body .= $donnees_news['titre'];
	$body .= $theme_close_boite_titre ;
	$body .= nl2br(stripslashes($donnees_news['contenu']));
	$body .= $theme_close_boite ;
	$body .= $theme_open_boite ;
	$body .= ''.AJOUTERPAR_NEWS.'';
	$body .= '&nbsp;';
	$body .= '<a href="'.$index->targetfile.'=memberlist&profil='.$donnees_news['pseudo'].'">'.$donnees_news['pseudo'].'</a>';
	$body .= '&nbsp;&nbsp;';
	$body .= '' .LE_NEWS. '';
	$body .= '&nbsp;';
	$body .= date('d/m/Y', $donnees_news['timestamp_validation']) .'&nbsp;à&nbsp;'. date('H\hi', $donnees_news['timestamp_validation'])  ;
	$body .= '&nbsp;[ <a href="'.$index->targetfile.'=news&commentaires&id_news='.$donnees_news['id'].'">Il y a '.$donnees_news['nb_commentaires'].' commentaires</a> ] - [ <a href="'.$index->targetfile.'=news&ajout_commentaire&id_news='.$donnees_news['id'].'">Ajouter un commentaire</a> ]';
	$body .= $theme_close_boite ;
	   
}

$body .= '[ <a href="'.$index->targetfile.'=news&proposer">Proposer une news</a> ] - [ <a href="'.$index->targetfile.'=news&archives">Archives</a> ]' ;

 }
?>

