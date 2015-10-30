<?php
# IwaPHP CMS - Système de gestion de contenu 

class Header {

	public function auth_inc($dir, $name_file, $recovery, $recovery_user, $type)
	{
	
		global $include;
		
		if($type == 'recovery_if_not_session')
		{
		
			(!isset($_SESSION['pseudo']) ? $include->dir('/'.$dir.'/'.recuperer($recovery).'/'.$name_file) :
			(empty($recovery_user) ? $include->dir('/'.$dir.'/'.recuperer($recovery).'/'.$name_file.'') :
			$include->dir('/'.$dir.'/'.$recovery_user.'/'.$name_file.''))) ;
		
		} elseif($type == 'if_var_session_empty_then_null') {
		
			(!isset($_SESSION['pseudo']) ? $include->dir('/'.$dir.'/'.recuperer($recovery).'/'.$name_file) :
			(empty($recovery_user) ? $include->dir('/'.$dir.'/'.recuperer($recovery).'/'.$name_file.'') :
			NULL)) ;
			
		} 

	}

}

$header->new Header();


?>