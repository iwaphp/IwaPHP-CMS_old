<?php
mysql_query("INSERT INTO `".$prefix."module` ( `id` , `nom` , `url` , `statut` )
VALUES (
NULL , 'news', 'news', 'install'
);");
mysql_query("CREATE TABLE `".$prefix."news` (
  `id` int(11) NOT NULL auto_increment,
  `titre` varchar(120) NOT NULL,
  `contenu` text NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `timestamp_proposition` int(11) NOT NULL,
  `timestamp_validation` int(11) NOT NULL,
  `valide` tinyint(1) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

");
mysql_query("CREATE TABLE `".$prefix."news_commentaires` (
  `id` int(11) NOT NULL auto_increment,
  `idnews` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `message` text NOT NULL,
  `timestamp` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

");

mysql_query("CREATE TABLE `".$prefix."news_op` (
  `id` bigint(20) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `valeur` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
");

mysql_query("INSERT INTO `".$prefix."news_op` (`id`, `nom`, `valeur`) VALUES 
(0, 'nbr_de_news', '5'),
(0, 'nbr_de_com', '5');");
?>