<?php
# IwaPHP CMS - Système de gestion de contenu 


$limit_par_feuille = 10; 
if(isset($_GET['feuille']) AND !empty($_GET['feuille']))
{
        $feuille = intval($_GET['feuille']); 
}
else
{
        $feuille = 1; 
}
$from = ($feuille - 1) * $limit_par_feuille; 


$requete_news = mysql_query('SELECT '.$db->prefix_tables.'news.id, '.$db->prefix_tables.'news.titre, '.$db->prefix_tables.'news.contenu, '.$db->prefix_tables.'news.pseudo, '.$db->prefix_tables.'news.timestamp_validation, COUNT('.$db->prefix_tables.'news_commentaires.id) AS nb_commentaires FROM '.$db->prefix_tables.'news LEFT JOIN '.$db->prefix_tables.'news_commentaires ON '.$db->prefix_tables.'news.id='.$db->prefix_tables.'news_commentaires.idnews WHERE '.$db->prefix_tables.'news.valide=1 GROUP BY '.$db->prefix_tables.'news.id ORDER BY '.$db->prefix_tables.'news.timestamp_validation DESC LIMIT '.$from.', '.$limit_par_feuille);

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
	$body .= '&nbsp;<a href="'.$index->targetfile.'=news&commentaires&id_news='.$donnees_news['id'].'">Il y a '.$donnees_news['nb_commentaires'].' commentaires</a>';
	$body .= $theme_close_boite ;
	   
}


$requete = mysql_query('SELECT COUNT(*) AS nb_news_validees FROM '.$db->prefix_tables.'news WHERE valide=1'); 
$donnees = mysql_fetch_assoc($requete);

$nb_feuille = ceil($donnees['nb_news_validees'] / $limit_par_feuille); 

for($i=1 ; $i<=$nb_feuille ; $i++)
{
        if ($i == $feuille)
        {
                $body .= '['.$i.']'; 
        }
        else
        {
                $body .= '<a href="'.$index->targetfile.'=news&archives&feuille='.$i.'">'.$i.'</a>';
        }
}

 
?>

