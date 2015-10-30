<?php
mysql_query("DELETE FROM ".$prefix."module WHERE nom='news'");
mysql_query("DROP TABLE ".$prefix."news");
mysql_query("DROP TABLE ".$prefix."news_commentaires");
mysql_query("DROP TABLE ".$prefix."news_op");

?>