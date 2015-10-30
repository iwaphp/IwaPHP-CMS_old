<?php
# IwaPHP CMS - Système de gestion de contenu 

	
$titre = LIVREDOR;


if (isset($_GET['install'])) {
	
	if (isset($_GET['create'])) {
		include 'modules/livredor/install.php';
	}
	$body .= $theme_open_boite;
	$body .='<h2>Installation du module</h2>Lancer la proc&eacute;dure d\'installation du module. Voulez-vous continuer ?<br /><br />
	<a href="index.php?admin&onglet=modules&mod=livredor&uninstall&create">Accepter</a> - <a href="javascript:history.go(-1);">Annuler</a>';
	$body .= $theme_close_boite;
} elseif (isset($_GET['uninstall'])) {

	if (isset($_GET['drop'])) {
		include 'modules/livredor/uninstall.php';
	}
	$body .= $theme_open_boite;
	$body .='<h2>D&eacute;sinstallation</h2>Pass&eacute; ce processus les donn&eacute;es pr&eacute;sente dans la base de donn&eacute;es MySQL seront d&eacute;finitivement supprim&eacute;.<br /><br />
	Cette action est irr&eacuteversible. Voulez-vous continuer ?<br /><br />
	<a href="index.php?admin&onglet=modules&mod=livredor&uninstall&drop">Accepter</a> - <a href="javascript:history.go(-1);">Annuler</a>';
	$body .= $theme_close_boite;

} elseif (isset($_GET['options'])) {
	if(isset($_POST['nbr_de_com'])) {
	
	$nbr_message_afficher = $_POST['nbr_de_com'];
	mysql_query("UPDATE ".$db->prefix_tables."livredor_op SET valeur='".$nbr_message_afficher."' WHERE nom='nbr_message_afficher'");   

$body .= submit_form ;
	} else {
$body .= $theme_open_boite;
	
$body .= '<h2>Modifier les options du livre d\'or</h2><hr />' ;

$select = mysql_query("SELECT * FROM ".$db->prefix_tables."livredor_op WHERE nom='nbr_message_afficher'");
$data = mysql_fetch_array($select);

$body .= '<form action="index.php?admin&onglet=modules&mod=livredor&options" method="post">Afficher les 
  <input name="nbr_de_com" type="text" size="3" maxlength="3" value="'.$data['valeur'].'">
derniers commentaires dans le livre d\'or <br /><br />
  <input type="submit" name="Submit" value="Appliquer les modifications"></form>
 <a href="index.php?admin&onglet=modules&mod=livredor">Réduire</a>';
 
$body .= $theme_close_boite;

	}
}
elseif (isset($_GET['moderer'])) {
$body .= '<h2>Modérer les commentaires du livre d\'or</h2><hr />';
	if (isset($_GET['action'])) {
		if ($_GET['action'] == "supprimer") { 
			if (isset($_GET['id'])) { 
				if ($_GET['id'] == $_GET['id']) { 
mysql_query("DELETE FROM `".$db->prefix_tables."livredor` WHERE `id` = ".$_GET['id']." ");
header('location:index.php?admin&onglet=modules&mod=livredor&moderer');
				} 
			}

		}	
	} else {
	
	$body .= $theme_open_boite;
	$reponse = mysql_query('SELECT * FROM '.$db->prefix_tables.'livredor');
		
		
		$select = mysql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."livredor");  
		$data = mysql_fetch_array ($select);
				
							
		$body .= ($data['nbre_entrees'] == 0 ? 'Aucun message à été posté dans le livre d\'or<br>' : NULL);
		
	while ($donnees = mysql_fetch_array($reponse))
	{
	
    $body .= '<p><table width="100%"  border="0" id="tableau" cellspacing="0" cellpadding="2">
	<tr>
    <td><strong>' . $donnees['pseudo'] . '</a></strong> à écrit :<hr>';
	$body .= nl2br(stripslashes($donnees['message']));
	$body .='</td>
    <td width="20%"><a href="index.php?admin&onglet=modules&mod=livredor&moderer&action=supprimer&id=' . $donnees['id'] . '">Supprimer ce message</a></td>
	</tr>
	</table> 
	</p>';
	}

$body .='<br>
 <a href="index.php?admin&onglet=modules&mod=livredor">Réduire</a>
  <br>';
  $body .= $theme_close_boite;
	}


}
$body .= '<h2>Modérer le livre d\'or</h2><hr />' ;

$elements->OpenDynamicMenuSimple ();

	$elements->ButtonDynamicMenu ('edit.png', 'Mod&eacute;rer les commentaires', 'Supprimer ou modifier un commentaire dans votre livre d\'or si il le faut.', $index->rootfile.'?admin&onglet=modules&mod=livredor&moderer', 1);
	$elements->NbspDynamicMenu ();
	
	$elements->ButtonDynamicMenu ('options.png', 'Options', 'Gérer les options pour ce module.', $index->rootfile.'?admin&onglet=modules&mod=livredor&options', 1);
	$elements->NbspDynamicMenu ();
	
	$elements->ButtonDynamicMenu ('retour.png', 'Index des modules', '', $index->rootfile.'?admin&onglet=modules', 1);
	$elements->NbspDynamicMenu ();
	
	$elements->CloseDynamicMenuSimple ();

?>