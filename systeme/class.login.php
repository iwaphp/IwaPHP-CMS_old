<?php
# IwaPHP CMS - Système de gestion de contenu 

	
function progress ($action) {
		global $body, $theme_open_login_boite, $theme_close_login_boite;
		$body .= '<div id="conteneur">
		<div align="center"><img src="images/loading.gif" alt="" border="0" /><br />';
		
		$body .= WAIT.'<br>'.$action.'</div></div>';
		
}

class login 
{

var $reponse;
var $redirection;	


function connexion ($login, $password)
{
global $db, $recovery, $body, $theme_open_login_boite, $theme_close_login_boite;
	
	if (!empty($login) && !empty($password)) {
	
		$data = $db->sql_query("SELECT * FROM ".$db->prefix_tables."membre WHERE pseudo='".$login."'");
		$result = $db->sql_fetchrow($data);
		
			if(md5($password) != $result['pass'])  {
			
				$this->reponse = INCORRECT;
				$this->redirection = 'javascript:history.go(-1);';  
				
			} elseif(!empty($result['confirm'])) {
			
				$this->reponse = PASACTIF;
				$this->redirection = 'javascript:history.go(-1);'; 
				
			} else {
			
				$_SESSION['pseudo'] = $login ; 
				$_SESSION['id'] = $result['id'];
				$_SESSION['level'] = $result['grade'];
					
					if (isset($_POST['choixlog'])) {
					
						if ($_POST['choixlog'] == "pseudopass") {
						
						setcookie('pseudo', ''.$_SESSION['pseudo'].'', time() + 365*24*3600); 
						setcookie('pass', ''.$_POST['password'].'', time() + 365*24*3600); 
						
						} elseif ($_POST['choixlog'] == "pseudo") {
						
						setcookie('pseudo', ''.$_SESSION['pseudo'].'', time() + 365*24*3600);
						
						} elseif ($_POST['choixlog'] == "aucun") { NULL; }  
					}
					
					$this->redirection = 'javascript:history.go(-1);'; 
					$this->reponse = progress(ALLOK);  
			}
		
		} else { 
		
		$this->redirection = 'javascript:history.go(-1);'; 
		$this->reponse = MANQUECHAMPS;
		
		}
}

function deconnexion($id_membre)
{
	global $db;
	$db->sql_query('DELETE FROM '.$db->prefix_tables.'whosonline WHERE online_id = '.$id_membre);
	session_destroy();
	(recuperer('popup_update') == 'oui' ? ($update_droits_utilisateur->boolean == 'oui' ? mysql_query("UPDATE ".$db->prefix_tables."update SET valeur='true' WHERE nom='popup_update'") : NULL) : NULL);
	$this->redirection = 'javascript:history.go(-1);'; 
	$this->reponse = progress(MSG_LOGOUT) ;
}

}
?>