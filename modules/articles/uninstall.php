<?php
mysql_query("DELETE FROM ".$prefix."module WHERE nom='articles'");

mysql_query("DROP TABLE ".$prefix."articles");


?>