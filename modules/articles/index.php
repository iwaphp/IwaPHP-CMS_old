<?php
# IwaPHP CMS - Système de gestion de contenu 
	

if (isset($_GET['id'])) {
$retour = mysql_query('SELECT * FROM '.$db->prefix_tables.'articles WHERE id='.$_GET['id'].'');
while ($donnees = mysql_fetch_array($retour))
{


$body .= $theme_open_boite_titre ;
$body .= $donnees['titre'] ;
$body .= $theme_close_boite_titre ;
$body .= nl2br(stripslashes($donnees['contenu'])) ;
$body .= $theme_close_boite ;

}
} else {
header('location:index.php');
}

?>