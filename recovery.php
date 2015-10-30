<?php
# IwaPHP CMS - Système de gestion de contenu 

	# inclut classe de récupération
require $index->rootpath.'/systeme/class.recovery'.$index->phpEx;

if (isset($_SESSION['pseudo'])) {

# si une session est crée on récupère les informations
$utilisateur = new session();

$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE `pseudo`='".$_SESSION['pseudo']."'"); 
$result = $db->sql_fetchrow($data);

$utilisateur->idUtilisateur=$result['id'];
$utilisateur->nomUtilisateur=$result['pseudo']; 
$utilisateur->gradeUtilisateur=$result['grade'];
$utilisateur->emailUtilisateur=$result['mail'];
$utilisateur->themeUtilisateur=$result['theme_selected'];
$utilisateur->banUtilisateur=$result['banni'];
$utilisateur->avertiUtilisateur=$result['averto'];
$utilisateur->passUtilisateur=$result['pass'];
$utilisateur->ipUtilisateur=$_SERVER['REMOTE_ADDR'];
$utilisateur->aimUtilisateur=$result['aim'];
$utilisateur->msnUtilisateur=$result['msn'];
$utilisateur->ymsnUtilisateur=$result['ymsn'];
$utilisateur->icqUtilisateur=$result['icq'];
$utilisateur->lastnameUtilisateur=$result['nom'];
$utilisateur->prenomUtilisateur=$result['prenom'];
$utilisateur->paysUtilisateur=$result['pays'];
$utilisateur->bornUtilisateur=$result['born'];
$utilisateur->websiteUtilisateur=$result['website'];
$utilisateur->avatarUtilisateur=$result['avatar'];
$utilisateur->signatureUtilisateur=$result['signature'];
$utilisateur->ddn_jour=$result['ddn_jour'];
$utilisateur->ddn_mois=$result['ddn_mois'];
$utilisateur->ddn_annee=$result['ddn_annee'];
$utilisateur->sexeUtilisateur=$result['sexe'];

} 

# récupération des informations générales
$recovery = new Config ();

# Fonctions qui permet de récupérer les infos que l'on veut dans la table options de la bdd
function recuperer($nomVariable)
{
	global $recovery, $db;
	
	$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."options");
	$result = $db->sql_fetchrow($data);
	
	return $recovery->recoveryConfig ($nomVariable, $result[$nomVariable]);	
}

$data2 = $db->sql_query("SELECT * FROM ".$db->prefix_tables."update WHERE nom='popup_update'");
$result2 = $db->sql_fetchrow($data2);	
	
$recovery->recoveryConfig ('afficher_popup_update', $result2['valeur']);

$date = $recovery->Date()." - ".date("H\:i") ;
	
# inclut le fichier de langage par défaut
require $index->rootpath.'/systeme/langues/'.recuperer('lang_general').'/index'.$index->phpEx;

# inclut les fonctions additionnelles
require $index->rootpath.'/systeme/class.func'.$index->phpEx;
require $index->rootpath.'/systeme/class.elements'.$index->phpEx;

#appels temporaires
$elements = new DynamicMenu ();
$elements->themeInitial = recuperer('theme');


#Création des variables
$ip = ip2long($_SERVER['REMOTE_ADDR']);
if (!isset($_SESSION['pseudo'])) $id=0;
else $id = $utilisateur->idUtilisateur;

# Supprime les infos pour qui est en ligne dans la bdd pour celle qui on dépassé le délai
$time_max = time() - (60 * 5);
$db->sql_query('DELETE FROM '.$db->prefix_tables.'whosonline WHERE online_time < '.$time_max);
(isset($_SESSION['pseudo']) ? $db->sql_query('DELETE FROM '.$db->prefix_tables.'whosonline WHERE online_ip = '.$ip.' AND online_id = 0') : null);

# Inscrit dans la bdd les infos pour qui est en ligne
$select_count_id = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."whosonline WHERE online_id=".$id."");
$count_id = $db->sql_fetchrow($select_count_id);

if($count_id['nbre_entrees'] == 0)
{
	(!isset($_SESSION['pseudo']) ? $db->sql_query('INSERT INTO '.$db->prefix_tables.'whosonline VALUES('.$id.', '.time().','.$ip.', 0)') : $db->sql_query('INSERT INTO '.$db->prefix_tables.'whosonline VALUES('.$id.', '.time().','.$ip.', 1)'));
} else {
	$select_count_ip = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."whosonline WHERE online_ip = ".$ip."");
	$count_ip = $db->sql_fetchrow($select_count_ip);
	($count_ip['nbre_entrees'] == 0 ? 
	(!isset($_SESSION['pseudo']) ? $db->sql_query('INSERT INTO '.$db->prefix_tables.'whosonline VALUES('.$id.', '.time().', '.$ip.', 0)') : $db->sql_query('INSERT INTO '.$db->prefix_tables.'whosonline VALUES('.$id.', '.time().', '.$ip.', 1'))
	:
	(!isset($_SESSION['pseudo']) ? $db->sql_query('UPDATE '.$db->prefix_tables.'whosonline` SET online_id = '.$id.' , online_time = '.time().' WHERE online_ip = '.$ip.' ') : $db->sql_query('UPDATE '.$db->prefix_tables.'whosonline` SET online_id = '.$id.' , online_membre = 1 , online_time = '.time().' WHERE online_ip = '.$ip.' '))
	);
}

# Le dernier membre inscrit

$requete4 = $db->sql_query('
SELECT pseudo, id 
FROM '.$db->prefix_tables.'membre 
ORDER BY id DESC LIMIT 0, 1');

$data4 = mysql_fetch_assoc($requete4);

# Le nombre de membres inscrits

$data = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."membre");
$result = $db->sql_fetchrow($data);

# Différencie le visiteur du membre

$select_count_visiteur = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."whosonline WHERE online_id= 0");
$count_visiteur = $db->sql_fetchrow($select_count_visiteur);

$nombre_de_visiteurs = ($count_visiteur['nbre_entrees'] == 0 ? 0 : $count_visiteur['nbre_entrees']);

# Différencie le membre du visiteur

$select_count_membres = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."whosonline WHERE online_membre= 1");
$count_membres = $db->sql_fetchrow($select_count_membres);

$nombre_de_membres = ($count_membres['nbre_entrees'] == 0 ? 0 : $count_membres['nbre_entrees']);

# Total

$visiteurs_total = $nombre_de_visiteurs + $nombre_de_membres;

# Phrase stats

$statistiques = '<b>'.$result['nbre_entrees'].'</b> membres.<br>
Le dernier membre est <a href="'.$index->targetfile.'=memberlist&profil='.$data4['id'].'">'.$data4['pseudo'].'</a>.
<br><br>
<b>'.$visiteurs_total.'</b> connect&eacute; dont <b>'.$nombre_de_visiteurs.'</b> visiteur(s) et <b>'.$nombre_de_membres.'</b> membres.<br>
';
$statistiques_admin = null;

$online = $db->sql_query("SELECT * FROM ".$db->prefix_tables."whosonline WHERE online_time > ".$time_max." AND online_membre = 1");

while ($membres = $db->sql_fetchrow($online))
{
$select_membres_online = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id=".$membres['online_id']."");
$membres_online = $db->sql_fetchrow($select_membres_online);


	$statistiques .= (empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/stats/connecte.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/stats/connecte.png\" alt=\"\" \>\n").'<a href="'.$index->targetfile.'=memberlist&profil='.$membres_online['id'].'">
	'.$membres_online['pseudo'].'</a><br>';
	
	$statistiques_admin .= (empty($utilisateur->themeUtilisateur) ? "<img src=\"themes/".recuperer('theme')."/images/stats/connecte.png\" alt=\"\" \>\n" : "<img src=\"themes/".$utilisateur->themeUtilisateur."/images/stats/connecte.png\" alt=\"\" \>\n").'<a href="'.$index->targetfile.'=memberlist&profil='.$membres_online['id'].'">
	'.$membres_online['pseudo'].'</a> - REMOTE ADDR : '.$membres['online_ip'].' <br>';
}

# inclut les fonctions additionnelles
require $index->rootpath.'/systeme/func.footer'.$index->phpEx;
?>
