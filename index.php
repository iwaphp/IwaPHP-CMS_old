<?php
# IwaPHP CMS - SYSTEME DE GESTION DE CONTENU

# fonctions pr�liminaires
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);
include 'systeme/class.main.php';

# d�finit la racine
$index = new preliminary();
$index->defineroot('index.php', 'page', dirname(__FILE__));
$index->session_start('modules/espace_membre/cache/');

# temps debut
$start = $index->microtime_float();

# v�rifie si le fichier de configuration est pr�sent sinon l'installation est lanc�e
if (!file_exists($index->rootpath.'/config/config'.$index->phpEx)) {

	header('Location:install/install.php');

} else { 

	# fichier de configuration et de r�cup�ration
	require $index->rootpath.'/config/config'.$index->phpEx;
	$db->prefix_tables = 'iwa_';
	require $index->rootpath.'/recovery'.$index->phpEx;

	if (isset($_SESSION['pseudo'])) {

		# recherche d'un bannissement �ventuel
		($utilisateur->banUtilisateur == true ? $html = BANNI : require $index->rootpath.'/header'.$index->phpEx);  
		echo ($utilisateur->avertiUtilisateur == true ? AVERTO.$html : $html); 
		
	} else {                                              

		# affichage du site
	require $index->rootpath.'/header'.$index->phpEx;  

	echo $html;

	}

$db->sql_close();

}
?>
