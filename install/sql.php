<?php
$schema_articles = "
			CREATE TABLE IF NOT EXISTS `iwa_articles` (
			  `id` bigint(20) NOT NULL AUTO_INCREMENT,
			  `titre` varchar(255) NOT NULL,
			  `contenu` text NOT NULL,
			  KEY `id` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;";
			
			$schema_friends = "
			CREATE TABLE IF NOT EXISTS `iwa_friends` (
			  `id_` int(11) NOT NULL,
			  `pseudo` varchar(255) NOT NULL,
			  `id_ami` int(11) NOT NULL,
			  `pseudo_ami` varchar(255) NOT NULL,
			  `ami_depuis` varchar(255) NOT NULL,
			  `accept` tinyint(1) NOT NULL,
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `bloquer` tinyint(1) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `id` (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;";

			$schema_groupes = "
			CREATE TABLE IF NOT EXISTS `iwa_groupes` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `nom` varchar(255) NOT NULL,
			  `description` text NOT NULL,
			  `niveaux` text NOT NULL,
			  `couleur` varchar(255) NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `id` (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;";

			$schema_groupes_content = "
			INSERT INTO `iwa_groupes` (`id`, `nom`, `description`, `niveaux`, `couleur`) VALUES
			(1, 'Administrateurs', '', '1', '$cc0000'),
			(2, 'Modérateurs', '', '2', 'test'),
			(7, 'Privilégiés', '', '3', '');";

			$schema_livredor = "
			CREATE TABLE IF NOT EXISTS `iwa_livredor` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `pseudo` varchar(255) NOT NULL DEFAULT '',
			  `message` text NOT NULL,
			  KEY `id` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;";

			$schema_livredor_options = "
			CREATE TABLE IF NOT EXISTS `iwa_livredor_op` (
			  `id` bigint(20) NOT NULL AUTO_INCREMENT,
			  `nom` varchar(255) NOT NULL,
			  `valeur` text NOT NULL,
			  KEY `id` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;";

			$schema_livredor_options_content = "
			INSERT INTO `iwa_livredor_op` (`id`, `nom`, `valeur`) VALUES
			(2, 'nbr_message_afficher', '5');";

			$schema_membre = "
			CREATE TABLE IF NOT EXISTS `iwa_membre` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `pseudo` varchar(255) NOT NULL DEFAULT '',
			  `pass` varchar(255) NOT NULL DEFAULT '',
			  `grade` varchar(255) NOT NULL DEFAULT '',
			  `mail` varchar(255) NOT NULL DEFAULT '',
			  `confirm` text NOT NULL,
			  `nom` text NOT NULL,
			  `prenom` text NOT NULL,
			  `pays` text NOT NULL,
			  `born` text NOT NULL,
			  `sexe` varchar(255) NOT NULL,
			  `website` text NOT NULL,
			  `avatar` text NOT NULL,
			  `signature` text NOT NULL,
			  `pensebete` text NOT NULL,
			  `photoperso` text NOT NULL,
			  `lastquerytime` int(11) NOT NULL DEFAULT '0',
			  `theme_selected` varchar(255) NOT NULL DEFAULT '',
			  `banni` varchar(255) NOT NULL DEFAULT '',
			  `averto` varchar(255) NOT NULL DEFAULT '',
			  `ddn_jour` varchar(255) NOT NULL,
			  `ddn_mois` varchar(255) NOT NULL,
			  `ddn_annee` varchar(255) NOT NULL,
			  `derniere_visite` varchar(255) NOT NULL,
			  `post` varchar(255) NOT NULL,
			  `inscrit` varchar(255) NOT NULL,
			  KEY `id` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;";

			

			$schema_menu = "
			CREATE TABLE IF NOT EXISTS `iwa_menu` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `titre` varchar(255) NOT NULL DEFAULT '',
			  `emplacement` varchar(255) NOT NULL DEFAULT '',
			  `position` varchar(255) NOT NULL DEFAULT '',
			  `type` varchar(255) NOT NULL DEFAULT '',
			  KEY `id` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;";

			$schema_menu_content = "
			INSERT INTO `iwa_menu` (`id`, `titre`, `emplacement`, `position`, `type`) VALUES
			(44, 'espace_membre', 'droite', '1', 'fixe'),
			(69, 'admin', 'gauche', '0', 'fixe'),
			(78, 'statistiques', 'gauche', '2', 'fixe');";
			
			$schema_menu_contenu = "
			CREATE TABLE IF NOT EXISTS `iwa_menu_contenu` (
			  `id` bigint(20) NOT NULL AUTO_INCREMENT,
			  `titre` varchar(255) NOT NULL,
			  `valeur` text NOT NULL,
			  `url` text NOT NULL,
			  `position` varchar(255) NOT NULL,
			  `type` varchar(255) NOT NULL,
			  KEY `id` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;";

			$schema_menu_contenu_content = "
			INSERT INTO `iwa_menu_contenu` (`id`, `titre`, `valeur`, `url`, `position`, `type`) VALUES
			(41, 'test', 'essai', '', '-1', 'lien'),
			(42, 'test', 'essai2', '', '0', 'lien'),
			(43, 'test', 'essai3', '', '1', 'lien');";


			$schema_menu_module = "
			CREATE TABLE IF NOT EXISTS `iwa_menu_module` (
			  `id` bigint(20) NOT NULL AUTO_INCREMENT,
			  `module` varchar(255) NOT NULL,
			  `bloc` text NOT NULL,
			  KEY `id` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;";

			$schema_menu_module_content = "
			INSERT INTO `iwa_menu_module` (`id`, `module`, `bloc`) VALUES
			(5, 'admin', 'admin'),
			(6, 'espace_membre', 'espace_membre'),
			(8, 'statistiques', 'statistiques');";

			$schema_module = "
			CREATE TABLE IF NOT EXISTS `iwa_module` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `nom` varchar(255) NOT NULL DEFAULT '',
			  `url` varchar(255) NOT NULL DEFAULT '',
			  `type_menu` varchar(255) NOT NULL DEFAULT '',
			  `titre_module` varchar(255) NOT NULL,
			  `image_module` varchar(255) NOT NULL,
			  `description_module` text NOT NULL,
			  `menudyn_module` varchar(255) NOT NULL,
			  `install` tinyint(1) NOT NULL,
			  `active_menu` tinyint(1) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=80 ;";

			$schema_module_content = "
			INSERT INTO `iwa_module` (`id`, `nom`, `url`, `type_menu`, `titre_module`, `image_module`, `description_module`, `menudyn_module`, `install`, `active_menu`) VALUES
			(34, 'espace_membre', 'espace_membre', 'fixed', 'Espace Membre', '', '', 'enabled', 1, 1),
			(60, 'admin', 'admin', 'fixed', 'Administration', '', '', 'enabled', 1, 1),
			(64, 'articles', 'articles', 'mod', 'Articles', 'articles.png', 'Créer vos propre articles sur le site.', 'disabled', 1, 0),
			(65, 'livredor', 'livredor', 'mod', 'Livre d''or', 'livredor.png', 'Gérez les options et modérer les commentaires du livre d''or.', 'disabled', 1, 0),
			(66, 'news', 'news', 'mod', 'News', 'news.png', 'Ajouter/Supprimer des nouvelles sur votre site.', 'disabled', 1, 0),
			(75, 'statistiques', 'statistiques', 'fixed', 'Statistiques', '', '', '', 1, 1),
			(76, 'edito', 'edito', 'fixed', 'Edito', '', '', '', 1, 0),
			(77, 'boite_reception', 'boite_reception', 'fixed', 'Messagerie interne', '', '', '', 1, 0),
			(78, 'groupes', 'groupes', 'fixed', 'Groupes', '', '', '', 1, 0),
			(79, 'memberlist', 'memberlist', 'fixed', 'Liste des membres', '', '', '', 1, 0);";

			$schema_mp ="
			CREATE TABLE IF NOT EXISTS `iwa_mp` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `id_expediteur` int(11) NOT NULL,
			  `id_receveur` int(11) NOT NULL,
			  `sujet` varchar(255) NOT NULL,
			  `message` longtext NOT NULL,
			  `lu` tinyint(4) NOT NULL DEFAULT '1',
			  `archiv` tinyint(4) NOT NULL DEFAULT '0',
			  `times` bigint(20) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
			
			$schema_msgmembre = "
			CREATE TABLE IF NOT EXISTS `iwa_msgmembre` (
			  `membre_from` int(11) NOT NULL,
			  `membre_to` int(11) NOT NULL,
			  `message_id` int(11) NOT NULL,
			  `message_contenu` text NOT NULL,
			  `message_titre` varchar(255) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
 			
 			$schema_news = "
			CREATE TABLE IF NOT EXISTS `iwa_news` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `titre` varchar(120) NOT NULL,
			  `contenu` text NOT NULL,
			  `pseudo` varchar(25) NOT NULL,
			  `timestamp_proposition` int(11) NOT NULL,
			  `timestamp_validation` int(11) NOT NULL,
			  `valide` tinyint(1) NOT NULL,
			  KEY `id` (`id`),
			  KEY `id_2` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;";

			$schema_news_commentaires ="
			CREATE TABLE IF NOT EXISTS `iwa_news_commentaires` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `idnews` int(11) NOT NULL,
			  `pseudo` varchar(25) NOT NULL,
			  `message` text NOT NULL,
			  `timestamp` int(11) NOT NULL,
			  KEY `id` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;";

			$schema_news_op="
			CREATE TABLE IF NOT EXISTS `iwa_news_op` (
			  `id` bigint(20) NOT NULL,
			  `nom` varchar(255) NOT NULL,
			  `valeur` text NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

			$schema_news_op_content="
			INSERT INTO `iwa_news_op` (`id`, `nom`, `valeur`) VALUES
			(0, 'nbr_de_news', '5'),
			(0, 'nbr_de_com', '5');";

			$schema_niveaux="
			CREATE TABLE IF NOT EXISTS `iwa_niveaux` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `numero` varchar(255) NOT NULL,
			  `valeur` text NOT NULL,
			  KEY `id` (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;";

			$schema_niveaux_content ="
			INSERT INTO `iwa_niveaux` (`id`, `numero`, `valeur`) VALUES
			(1, '1', ' utilisateurs, apparence, configuration, communication, config_server, modules'),
			(6, '2', ' configuration, communication'),
			(7, '3', ''),
			(8, '0', ''),
			(9, '4', ' modules');";

			$schema_options ="
			CREATE TABLE IF NOT EXISTS `iwa_options` (
			  `id` int(11) NOT NULL,
			  `nom_site` text NOT NULL,
			  `url_script` text NOT NULL,
			  `url_site` text NOT NULL,
			  `module_demarrage` text NOT NULL,
			  `nom_licence` text NOT NULL,
			  `copyrights` text NOT NULL,
			  `url_logo` text NOT NULL,
			  `description` text NOT NULL,
			  `keywords` text NOT NULL,
			  `theme` text NOT NULL,
			  `edito` text NOT NULL,
			  `email_admin` text NOT NULL,
			  `regles_de_site` text NOT NULL,
			  `regles_active` text NOT NULL,
			  `lang_general` text NOT NULL,
			  `grade_visiteurs` text NOT NULL,
			  `travaux` text NOT NULL,
			  `changer_pseudo` text NOT NULL,
			  `changer_email` text NOT NULL,
			  `popup_update` text NOT NULL,
			  `active_memberlist` text NOT NULL,
			  `active_user` text NOT NULL,
			  `autoriser_upload_fichier` varchar(255) NOT NULL,
			  `repertoire_envoi_upload` varchar(255) NOT NULL,
			  `quota_max_upload` varchar(255) NOT NULL,
			  `quota_max_upload_memoiretype` varchar(255) NOT NULL,
			  `taille_max_fichier_upload` varchar(255) NOT NULL,
			  `taille_max_fichier_upload_memoiretype` varchar(255) NOT NULL,
			  `max_fichier_joint_msg_prive` varchar(255) NOT NULL,
			  `afficher_img_upload` varchar(255) NOT NULL,
			  `largeur_max_img_joint` varchar(255) NOT NULL,
			  `hauteur_max_img_joint` varchar(255) NOT NULL,
			  `autoriser_avatars` varchar(255) NOT NULL,
			  `autoriser_envoi_avatars` varchar(255) NOT NULL,
			  `poid_max_avatar` varchar(255) NOT NULL,
			  `poid_max_avatar_memoiretype` varchar(255) NOT NULL,
			  `repertoire_stockage_avatars` varchar(255) NOT NULL,
			  `largeur_max_avatar` varchar(255) NOT NULL,
			  `hauteur_max_avatar` varchar(255) NOT NULL,
			  `activer_messagerie_privee` varchar(255) NOT NULL,
			  `nbr_max_dossiers` varchar(255) NOT NULL,
			  `nbr_msg_privee_max_dossier` varchar(255) NOT NULL,
			  `faire_quand_boite_reception_pleine` varchar(255) NOT NULL,
			  `autoriser_bbcodes` varchar(255) NOT NULL,
			  `autoriser_smileys` varchar(255) NOT NULL,
			  `autoriser_fichiers_joints` varchar(255) NOT NULL,
			  `autoriser_surveillance_reponses` varchar(255) NOT NULL,
			  `autoriser_liens_msg` varchar(255) NOT NULL,
			  `confirmation_visuelle_visiteurs` varchar(255) NOT NULL,
			  `largeur_max_img_msg` varchar(255) NOT NULL,
			  `hauteur_max_img_msg` varchar(255) NOT NULL,
			  `autoriser_bbcodes_msg` varchar(255) NOT NULL,
			  `autoriser_fichiers_joints_msg` varchar(255) NOT NULL,
			  `autoriser_smileys_msg` varchar(255) NOT NULL,
			  `autoriser_signatures` varchar(255) NOT NULL,
			  `autoriser_bbcodes_signatures` varchar(255) NOT NULL,
			  `nbr_max_img_signature` varchar(255) NOT NULL,
			  `largeur_max_img_signature` varchar(255) NOT NULL,
			  `hauteur_max_img_signature` varchar(255) NOT NULL,
			  `autoriser_liens_signatures` varchar(255) NOT NULL,
			  `autoriser_img_signatures` varchar(255) NOT NULL,
			  `autoriser_smileys_signatures` varchar(255) NOT NULL,
			  `activation_compte` varchar(255) NOT NULL,
			  `long_max_nom_utilisateur` varchar(255) NOT NULL,
			  `long_min_nom_utilisateur` varchar(255) NOT NULL,
			  `interdire_caractere_nom_utilisateur` varchar(255) NOT NULL,
			  `complexite_mdp` varchar(255) NOT NULL,
			  `long_min_mdp` varchar(255) NOT NULL,
			  `expiration_mdp` varchar(255) NOT NULL,
			  `autoriser_enregistrement_email_multi` varchar(255) NOT NULL,
			  `activer_confirm_visuelle_inscription` varchar(255) NOT NULL,
			  `nom_expediteur` varchar(255) NOT NULL,
			  `fonction_envoi_mail` varchar(255) NOT NULL,
			  `video_preview` varchar(255) NOT NULL,
			  `downloads_preview` varchar(255) NOT NULL,
			  `infos_preview` varchar(255) NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

			$schema_options_content ="
			INSERT INTO `iwa_options` (`id`, `nom_site`, `url_script`, `url_site`, `module_demarrage`, `nom_licence`, `copyrights`, `url_logo`, `description`, `keywords`, `theme`, `edito`, `email_admin`, `regles_de_site`, `regles_active`, `lang_general`, `grade_visiteurs`, `travaux`, `changer_pseudo`, `changer_email`, `popup_update`, `active_memberlist`, `active_user`, `autoriser_upload_fichier`, `repertoire_envoi_upload`, `quota_max_upload`, `quota_max_upload_memoiretype`, `taille_max_fichier_upload`, `taille_max_fichier_upload_memoiretype`, `max_fichier_joint_msg_prive`, `afficher_img_upload`, `largeur_max_img_joint`, `hauteur_max_img_joint`, `autoriser_avatars`, `autoriser_envoi_avatars`, `poid_max_avatar`, `poid_max_avatar_memoiretype`, `repertoire_stockage_avatars`, `largeur_max_avatar`, `hauteur_max_avatar`, `activer_messagerie_privee`, `nbr_max_dossiers`, `nbr_msg_privee_max_dossier`, `faire_quand_boite_reception_pleine`, `autoriser_bbcodes`, `autoriser_smileys`, `autoriser_fichiers_joints`, `autoriser_surveillance_reponses`, `autoriser_liens_msg`, `confirmation_visuelle_visiteurs`, `largeur_max_img_msg`, `hauteur_max_img_msg`, `autoriser_bbcodes_msg`, `autoriser_fichiers_joints_msg`, `autoriser_smileys_msg`, `autoriser_signatures`, `autoriser_bbcodes_signatures`, `nbr_max_img_signature`, `largeur_max_img_signature`, `hauteur_max_img_signature`, `autoriser_liens_signatures`, `autoriser_img_signatures`, `autoriser_smileys_signatures`, `activation_compte`, `long_max_nom_utilisateur`, `long_min_nom_utilisateur`, `interdire_caractere_nom_utilisateur`, `complexite_mdp`, `long_min_mdp`, `expiration_mdp`, `autoriser_enregistrement_email_multi`, `activer_confirm_visuelle_inscription`, `nom_expediteur`, `fonction_envoi_mail`, `video_preview`, `downloads_preview`, `infos_preview`) VALUES
			(1, 'Mon site', 'C:wampwwwwampIwaPHP-CMS', 'http://localhost/', 'news', 'votre nom', '', 'logo.png', 'Description', 'keyword1, keyword2', 'dreamgray2', '<h1 style=\"color: #ff0000; text-align: center;">Bienvenue sur la page d''accueil !</h1>\r\n<p style=\"text-align: center;\"><img src=\"logo.png\" alt=\"\" width=\"130\" height=\"37\" /></p>', 'admin@serveur.ex', '', 'non', 'francais', 'Utilisateur', 'disabled', 'non', 'non', 'non', 'oui', 'oui', 'oui', 'systeme/uploads/', '10', 'ko', '1', 'mo', '3', 'oui', '600', '800', 'oui', 'oui', '800', 'ko', 'systeme/images/uploads/', '120', '120', 'oui', '15', '20', 'supp_ancien', 'oui', 'oui', 'oui', 'oui', 'oui', 'non', '600', '800', 'oui', 'oui', 'oui', 'oui', 'oui', '1', '400', '150', 'oui', 'oui', 'oui', 'email', '18', '3', '~, #, {, (, |, ,^, @, ], [, ), }, =, +, °, *, /, <, >', 'non', '6', '0', 'non', 'oui', 'admin', 'mail', '', '', '');";

			$schema_statut="
			CREATE TABLE IF NOT EXISTS `iwa_statut` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `id_` int(11) NOT NULL,
			  `statut` text NOT NULL,
			  PRIMARY KEY (`id`),
			  KEY `id` (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;";

			$schema_statut_content="
			INSERT INTO `iwa_statut` (`id`, `id_`, `statut`) VALUES
			(2, 36, 'online');";";

			$schema_
			CREATE TABLE IF NOT EXISTS `iwa_update` (
			  `id` bigint(20) NOT NULL AUTO_INCREMENT,
			  `nom` varchar(255) NOT NULL,
			  `valeur` text NOT NULL,
			  KEY `id` (`id`)
			) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;";

			$schema_update = "
			INSERT INTO `iwa_update` (`id`, `nom`, `valeur`) VALUES
			(1, 'popup_update', '');";

			$schema_whosonline = "
			CREATE TABLE IF NOT EXISTS `iwa_whosonline` (
			  `online_id` int(11) NOT NULL,
			  `online_time` int(11) NOT NULL,
			  `online_ip` int(15) NOT NULL,
			  `online_membre` int(11) NOT NULL,
			  KEY `online_id` (`online_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
			";