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
	// echo("\t<script>\n");
	// echo("\t\twindow.fbAsyncInit = function() {\n");
	// echo("\t\t\tFB.init({\n");
	// echo("\t\t\t\tappId      : ,\n");
	// echo("\t\t\t\tstatus     : true,\n");
	// echo("\t\t\t\tcookie     : true,\n");
	// echo("\t\t\t\txfbml      : true\n");
	// echo("\t\t\t});\n");
	// echo("\t\t};\n");

	// echo("\t\t(function(d, s, id){\n");
	// echo("\t\t\tvar js, fjs = d.getElementsByTagName(s)[0];\n");
	// echo("\t\t\tif (d.getElementById(id)) {return;}\n");
	// echo("\t\t\tjs = d.createElement(s); js.id = id;\n");
	// echo("\t\t\tjs.src = \"//connect.facebook.net/en_US/all.js\";\n");
	// echo("\t\t\tfjs.parentNode.insertBefore(js, fjs);\n");
	// echo("\t\t}(document, 'script', 'facebook-jssdk'));\n");
	// echo("\t</script>\n");
}

function getFooter() {
	echo("\t</div>\n");
	echo("\t\t<!-- Javascript files will go under here -->\n");
	echo("<script src=\"http://code.jquery.com/jquery-latest.min.js\"></script>\n");
}

?>