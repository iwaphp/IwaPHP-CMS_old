<?php

#########################
# Meta Tags generation  		        #
#########################
$head .= "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=iso-8859-1 \">\n";
$head .= "<META HTTP-EQUIV=\"EXPIRES\" CONTENT=\"0\">\n";
$head .= "<META NAME=\"RESOURCE-TYPE\" CONTENT=\"DOCUMENT\">\n";
$head .= "<META NAME=\"DISTRIBUTION\" CONTENT=\"GLOBAL\">\n";
$head .= "<META NAME=\"AUTHOR\" CONTENT=\"".recuperer('nom_site')."\">\n";
$head .= "<META NAME=\"COPYRIGHT\" CONTENT=\"Copyright (c) by ".recuperer('nom_site')."\">\n";
$head .= "<META NAME=\"KEYWORDS\" CONTENT=\"".recuperer('keywords')."\">\n";
$head .= "<META NAME=\"DESCRIPTION\" CONTENT=\"".recuperer('description')."\">\n";
$head .= "<META NAME=\"ROBOTS\" CONTENT=\"INDEX, FOLLOW\">\n";
$head .= "<META NAME=\"REVISIT-AFTER\" CONTENT=\"1 DAYS\">\n";
$head .= "<META NAME=\"RATING\" CONTENT=\"GENERAL\">\n";
$head .= "<META NAME=\"GENERATOR\" CONTENT=\"IwaPHP\">\n";

?>