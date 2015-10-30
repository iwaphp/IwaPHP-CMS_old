<?php
mysql_query("UPDATE ".$prefix."module WHERE nom='livredor' SET install=0");
mysql_query("DROP TABLE ".$prefix."livredor");
mysql_query("DROP TABLE ".$prefix."livredor_op");
?>