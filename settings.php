<?php

function getHeader() {
	echo("<!DOCTYPE html>\n");
	echo("<html lang=\"en\">\n");
	echo("<head>\n");
	echo("<title>DIG Prototype</title>\n");
	echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.css\">\n");
	echo("<script src=\"http://code.jquery.com/jquery-latest.min.js\"></script>\n");
	echo("</head>\n");
	echo("<body>\n");
	echo("\t<div id=\"fb-root\"></div>\n");
	echo("\t<div class=\"container\">\n");
}

function getFooter() {
	echo("\t</div>\n");
	echo("\t\t<!-- Javascript files will go under here -->\n");
	echo("<script src=\"http://code.jquery.com/jquery-latest.min.js\"></script>\n");
}

?>