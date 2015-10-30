<?php
# IwaPHP CMS - Système de gestion de contenu 

class session { 
    var $idUtilisateur;
	var $nomUtilisateur; 
	var $gradeUtilisateur;
	var $emailUtilisateur;
	var $themeUtilisateur;
	var $banUtilisateur;
	var $avertiUtilisateur;
	var $ipUtilisateur;
	var $aimUtilisateur;
	var $msnUtilisateur;
	var $ymsnUtilisateur;
	var $icqUtilisateur;
	var $lastnameUtilisateur;
	var $prenomUtilisateur;
	var $paysUtilisateur;
	var $bornUtilisateur;
	var $websiteUtilisateur;
} 

class Config 
{
	
	function recoveryConfig ($var, $result) 
	{
		$var = $result;		
		return $var;
	}
	
	function Date () 
	{
		$mois = array("janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre");
		$jours = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");

		return
		$jours[date("w")]." ".date("j").(date("j") == 1 ? "er&nbsp;" : " ").$mois[date("n")-1]." ".date("Y");
	}
	
	function NbrMsgMessagerie ()
	{
		global $db, $prefix, $utilisateur, $index;
		$data = $db->sql_query("SELECT COUNT(*) AS nbre_entrees FROM ".$db->prefix_tables."mp WHERE lu='1' and id_receveur='".$utilisateur->idUtilisateur."'");
		$result = $db->sql_fetchrow($data);
		
		
		$this->messagerie = "<A class=\"link_bar_header\" href='".$index->targetfile."=messagerie&dossier=reception'>";
		$this->messagerie .= ($result['nbre_entrees'] == 0 ? 'Messagerie' : '<b>Messagerie ('.$result['nbre_entrees'].')</b>');
		$this->messagerie .= "</A>";
		
		return $this->messagerie;
	}
	
	function SessionStatut ()
	{
	
	global $main, $index, $utilisateur, $db;
	
		# Determine le niveau de l'utilisateur en cours
		$db_user = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE id='".$utilisateur->idUtilisateur."'");
		$result_user = $db->sql_fetchrow($db_user);

		# Compare le niveau d'utilisateur
		$db_level = $db->sql_query("SELECT * FROM ".$db->prefix_tables."niveaux WHERE numero='".$result_user['grade']."'");
		$result_level = $db->sql_fetchrow($db_level);
		
		# Recherche si une de ces partie est existante pour le niveau de l'utilisateur trouvé
		if (preg_match("/\butilisateurs\b/i", $result_level['valeur']) or preg_match("/\bapparence\b/i", $result_level['valeur'])
		or preg_match("/\bconfiguration\b/i", $result_level['valeur']) or preg_match("/\bcommunication\b/i", $result_level['valeur']) 
		or preg_match("/\bconfig_server\b/i", $result_level['valeur']) or preg_match("/\bupdate\b/i", $result_level['valeur'])) {
		
		$link_admin = '<a class="link_bar_header" href="index.php?admin">Administration</a> | ';
		
		} else {
		
		$link_admin = '';
		
		}
	
		
		$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."friends WHERE id_ami='".$utilisateur->idUtilisateur."' AND pseudo_ami='".$utilisateur->nomUtilisateur."' AND accept='0'");
		$result = mysql_num_rows($data);	
		$this->SessionStatut = (!isset($_SESSION['pseudo']) ? "<span class=\"text_bar_header\"><b>".BIENVENUE_INVITE."</b>&nbsp;[&nbsp;</span><A class=\"link_bar_header\" onMouseOver=\"poplink('".INFCONNEXION."');\" onmouseout=\"killlink()\" href='".$index->targetfile."=espace_membre'>".CONNEXION."</a>&nbsp;<span class=\"text_bar_header\">|</span>&nbsp;<A class=\"link_bar_header\" onMouseOver=\"poplink('".INFINSCRIPTION."');\" onmouseout=\"killlink()\" href='".$index->targetfile."=espace_membre&action=inscription'>".INSCRIPTION."</a>&nbsp;<span class=\"text_bar_header\">]</span>" : (recuperer('activer_messagerie_privee') == 'oui' ? $this->NbrMsgMessagerie () : '').' | '.(empty($result) ? '<a class="link_bar_header" href="'.$index->targetfile.'=espace_membre&dossier=friends">Ami(e)s</a>' : '<a class="link_bar_header" href="'.$index->targetfile.'=espace_membre&dossier=friends"><strong>Ami(e)s ('.$result.')</strong></a>').' | <a class="link_bar_header" href="'.$index->targetfile.'=memberlist&profil='.$utilisateur->idUtilisateur.'">Mon Profil</a> | <a class="link_bar_header" href="'.$index->targetfile.'=espace_membre&dossier=mon_compte">Mes informations</a>| <a class="link_bar_header" href="'.$index->targetfile.'=espace_membre&dossier=changeravatar">Changer d\'image perso.</a> | <a class="link_bar_header" href="'.$index->targetfile.'=espace_membre&dossier=mes_options">Configuration</a> | '.$link_admin.'<a class="link_bar_header" href="'.$index->rootfile.'?login&action=deconnexion">Déconnecter <b>'.$_SESSION['pseudo'].'</b></a>');
	
	return $this->SessionStatut;
	
	}
	
}

class droitsUtilisateur
{
	var $boolean;
	
	function __construct ($groupeUtilisateur, $module) {
		
		global $db;
		$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables.$module."_rangs WHERE `groupe`='".$groupeUtilisateur."'");
		$result = $db->sql_fetchrow($data);
			
		$this->boolean = $result['boolean'];
				
	}
}
?>