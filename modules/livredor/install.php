<?php
mysql_query("INSERT INTO `".$prefix."module` ( `id` , `nom` , `url` , `statut` )
VALUES (
NULL , 'livredor', 'livredor', 'install'
);");

mysql_query("CREATE TABLE `".$prefix."livredor` (
  `id` int(11) NOT NULL auto_increment,
  `pseudo` varchar(255) NOT NULL default '',
  `message` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;");

mysql_query("CREATE TABLE `".$prefix."livredor_op` (
  `id` bigint(20) NOT NULL auto_increment,
  `nom` varchar(255) NOT NULL,
  `valeur` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;");

mysql_query("INSERT INTO `".$prefix."livredor_op` (`id`, `nom`, `valeur`) VALUES 
(0, 'nbr_message_afficher', '15');");



?>