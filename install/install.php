<!DOCTYPE html><html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IwaPHP CMS</title>

    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

  </head>
  <body><?php

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['name_server'])
 && isset($_POST['user_server']) && isset($_POST['pass_server']) && isset($_POST['db_server'])) {

	if(file_exists('../config/config.php')) {

		unlink('../config/config.php');
		$config_file = fopen('../config/config.php', 'r+');

		if($config_file) {

			echo '<div class="container">
			<div class="alert alert-success" role="alert">Ecriture du config.php réussite !</div>
			</div>';

			$config_content = "<?php
							# IwaPHP CMS - Système de gestion de contenu

							$db = new sql_db('" . htmlentities($_POST['name_server']) . "'', '" . htmlentities($_POST['user_server']) . "', '" . htmlentities($_POST['pass_server']) . "', '" . htmlentities($_POST['db_server']) . "', false);
							$db->prefix_tables = 'iwa_';

							?>";

			fseek($config_file, 0);
			fputs($config_content);
			fclose($config_file);
		} else {
			echo '<div class="container">
			<div class="alert alert-danger" role="alert">Interdit d\'écrire sur le fichier, vérifiez les droits chmod !</div>
			</div>';
		}




	} else {

		$config_file = fopen('../config/config.php', 'w+');
		if($config_file) {

			echo '<div class="container">
			<div class="alert alert-success" role="alert">Ecriture du config.php réussite !</div>
			</div>';

			$config_content = "<?php
							# IwaPHP CMS - Système de gestion de contenu

							$db = new sql_db('" . htmlentities($_POST['name_server']) . "'', '" . htmlentities($_POST['user_server']) . "', '" . htmlentities($_POST['pass_server']) . "', '" . htmlentities($_POST['db_server']) . "', false);
							$db->prefix_tables = 'iwa_';

							?>";

			fseek($config_file, 0);
			fputs($config_content);
			fclose($config_file);
		} else {
			echo '<div class="container">
			<div class="alert alert-danger" role="alert">Interdit d\'écrire sur le fichier, vérifiez les droits chmod !</div>
			</div>';
		}

	}
	 


	$db_connect = mysql_connect(htmlentities($_POST['name_server']),htmlentities($_POST['user_server']),htmlentities($_POST['pass_server']));
	if($db_connect) {
		echo '<div class="container">
		<div class="alert alert-success" role="alert">Connexion MySQL réussite !</div>
		</div>';
		$db_select = mysql_select_db(htmlentities($_POST['db_server']));
		if($db_select) {
			echo '<div class="container">
			<div class="alert alert-success" role="alert">Connexion à '.htmlentities($_POST['db_server']).' réussite !</div>
			</div>';

			include dirname(__FILE__).'sql.php';

			$sql_schema_articles = mysql_query($schema_articles);
			$sql_schema_friends = mysql_query($schema_friends);
			$sql_schema_groupes = mysql_query($schema_groupes);
			$sql_schema_groupes_content = mysql_query($schema_groupes_content);
			$sql_schema_livredor = mysql_query($schema_livredor);
			$sql_schema_livredor_options = mysql_query($schema_livredor_options);
			$sql_schema_livredor_options_content = mysql_query($schema_livredor_options_content);
			$sql_schema_membre = mysql_query($schema_membre);
			$sql_schema_membre_content = mysql_query($schema_membre_content);
			$sql_schema_menu = mysql_query($schema_menu);
			$sql_schema_menu_content = mysql_query($schema_menu_content);
			$sql_schema_menu_contenu = mysql_query($schema_menu_contenu);
			$sql_schema_menu_contenu_content = mysql_query($schema_menu_contenu_content);
			$sql_schema_menu_module = mysql_query($schema_menu_module);
			$sql_schema_menu_module_content = mysql_query($schema_menu_module_content);
			$sql_schema_module = mysql_query($schema_module);
			$sql_schema_module_content = mysql_query($schema_module_content);
			$sql_schema_mp = mysql_query($schema_mp);
			$sql_schema_msgmembre = mysql_query($schema_msgmembre);
			$sql_schema_news = mysql_query($schema_news);
			$sql_schema_news_commentaires = mysql_query($schema_news_commentaires);
			$sql_schema_news_op = mysql_query($schema_news_op);
			$sql_schema_news_op_content = mysql_query($schema_news_op_content);
			$sql_schema_niveaux = mysql_query($schema_niveaux);
			$sql_schema_niveaux_content = mysql_query($schema_niveaux_content);
			$sql_schema_options = mysql_query($schema_options);
			$sql_schema_options_content = mysql_query($schema_options_content);
			$sql_schema_statut = mysql_query($schema_statut);
			$sql_schema_statut_content = mysql_query($schema_statut_content);
			$sql_schema_whosonline = mysql_query($schema_whosonline);
			$sql_schema_update = mysql_query($schema_update);

			echo ($sql_schema_articles == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_articles : Requête SQL effectué !</div></div>' :  '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_friends == true ?  '<div class="container"><div class="alert alert-success" role="alert">schema_friends : Requête SQL effectué !</div></div>' :  '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_groupes == true ?  '<div class="container"><div class="alert alert-success" role="alert">schema_groupes : Requête SQL effectué !</div></div>' :  '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_groupes_content == true ?  '<div class="container"><div class="alert alert-success" role="alert">schema_groupes_content : Requête SQL effectué !</div></div>' :  '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_livredor == true ?  '<div class="container"><div class="alert alert-success" role="alert">schema_livredor : Requête SQL effectué !</div></div>' :  '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_livredor_options == true ?  '<div class="container"><div class="alert alert-success" role="alert">schema_livredor_options : Requête SQL effectué !</div></div>' :  '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_livredor_options_content == true ?  '<div class="container"><div class="alert alert-success" role="alert">schema_livredor_options_content : Requête SQL effectué !</div></div>' :  '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_membre == true ?  '<div class="container"><div class="alert alert-success" role="alert">schema_membre : Requête SQL effectué !</div></div>' :  '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			
			$schema_membre_content = mysql_query("
			INSERT INTO `iwa_membre` (`id`, `pseudo`, `pass`, `grade`, `mail`, `confirm`, `nom`, `prenom`, `pays`, `born`, `sexe`, `website`, `avatar`, `signature`, `pensebete`, `photoperso`, `lastquerytime`, `theme_selected`, `banni`, `averto`, `ddn_jour`, `ddn_mois`, `ddn_annee`, `derniere_visite`, `post`, `inscrit`) VALUES
			('', '".htmlentities($_POST['username'])."', '".md5($_POST['password'])."', '1', '".htmlentities($_POST['email'])."', '', '', '', '', '', 'homme', '', '', '', '', '', 0, 'dreamgray2', '0', '', '1', 'janvier', '1950', '', '', '');");


			echo ($sql_schema_membre_content == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_membre_content : Requête SQL effectué !</div></div><div class="alert alert-success" role="alert">schema_membre_content : Role admin '.htmlentities($_POST['username']).' crée !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_menu == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_menu : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_menu_content == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_menu_content : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_menu_contenu == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_menu_contenu : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_menu_contenu_content == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_menu_contenu_content : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_menu_module == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_menu_module : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_menu_module_content == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_menu_module_content : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_module == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_module : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_module_content == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_module_content : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_mp == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_mp : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_msgmembre == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_msgmembre : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_news == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_news : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_news_commentaires == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_news_commentaires : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_news_op == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_news_op : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_news_op_content == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_news_op_content : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_niveaux == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_niveaux : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_niveaux_content == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_niveaux_content : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_options == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_options : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_options_content == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_options_content : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_statut == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_statut : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_statut_content == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_statut_content : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_update == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_update : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');
			echo ($sql_schema_whosonline == true ? '<div class="container"><div class="alert alert-success" role="alert">schema_whosonline : Requête SQL effectué !</div></div>' : '<div class="container"><div class="alert alert-danger" role="alert">Requête impossible !</div></div>');

			echo '<div class="alert alert-info" role="alert">INSTALLATION TERMINEE : <br /> Merci de supprimer le dossier "install/"</div>';
		} else {
			echo '<div class="container">
			<div class="alert alert-danger" role="alert">'.htmlentities($_POST['db_server']).' introuvable !</div>
			</div>';
		}
	} else {
		echo '<div class="container">
		<div class="alert alert-danger" role="alert">Erreur fatale ! impossible de se connecter MySQL !</div>
		</div>';
	}

} else {
?>

  <form method="post" action="install.php">
  	  <div class="container">
  	  	<img src="../logo.png" alt="">
	    <h1>Script Installer IwaPHP CMS old version</h1>
	    <p>(this script use bootstrap online cdn for stylesheet)</p>
		  <?php
		  if(file_exists('../config/writable.tmp')) {
			  $perms = 777;
			  if ($perms != fileperms('../config/writable.tmp')) {
				  echo '<div class="alert alert-danger" role="alert">Veuillez modifier les droits chmod de "config/" sur "777" pour permettre l\'écriture avant de continuer !</div>';
			  } else {
				  echo '<div class="alert alert-success" role="alert">Condition remplie : "config/" est autorisé pour l\'écriture !</div>';
			  }

		  }



		  ?>

		<h2>Nouveau super utilisateur</h2>
		<div class="form-group">Nom d'utilisateur :* <input class="form-control class="form-control" class="form-control"" type="text" name="username" required/></div>
		<div class="form-group">Mot de passe :* <input class="form-control" class="form-control" type="password" name="password" required/></div>
		<div class="form-group">E-mail :* <input class="form-control" type="email" name="email" required/></div>
		<h2>Connexion MySQL</h2>
		<div class="form-group">Serveur :* <input class="form-control" type="text" name="name_server" placeholder="localhost" required/></div>
		<div class="form-group">Nom d'utilisateur :* <input class="form-control" type="text" name="user_server" placeholder="root" required/></div>
		<div class="form-group">Mot de passe :* <input class="form-control" type="password" name="pass_server" required/></div>
		<div class="form-group">Nom de la base de données MySQL :* <input class="form-control" type="text" name="db_server" placeholder="iwaphp" required/></div>
		<button type="submit" class="btn btn-default">Install</button> (*:required)
	  </div>
	</form><?php } ?>	  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
   	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>  
</body>
</html>
