<?php
mysql_query("INSERT INTO `".$prefix."module` ( `id` , `nom` , `url` , `statut` )
VALUES (
NULL , 'articles', 'articles', 'install'
);");
mysql_query("CREATE TABLE ".$prefix."articles (
`id` BIGINT NOT NULL AUTO_INCREMENT ,
`titre` VARCHAR( 255 ) NOT NULL ,
`contenu` TEXT NOT NULL ,
INDEX ( `id` ) 
) ENGINE = MYISAM ;");

?>