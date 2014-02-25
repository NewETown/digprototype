<?php

function getHeader() {
	echo("<!DOCTYPE html>\n");
	echo("<html lang=\"en\">\n");
	echo("<head>\n");
	echo("<meta charset=\"utf-8\">\n");
    echo("<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">\n");
    echo("<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n");
	echo("<title>Statistically.Me</title>\n");
	echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.css\">\n");
	echo("<link rel=\"stylesheet\" type=\"text/css\" href=\"css/custom.css\">\n");
	echo("<link href='http://fonts.googleapis.com/css?family=Istok+Web:400,400italic' rel='stylesheet' type='text/css'>\n");
	echo("<script src=\"http://code.jquery.com/jquery-latest.min.js\"></script>\n");
	echo("</head>\n");
	echo("<body>\n");
	echo("\t<div id=\"fb-root\"></div>\n");
	echo("\t<div class=\"blog-masthead\">\n");
	echo("\t\t<div class=\"container\">\n");
	echo("\t\t\t<nav class=\"blog-nav\">\n");
	// echo("\t\t\t\t<a class=\"blog-nav-item active\" href=\"#\">Home</a>\n");
	// echo("\t\t\t\t<a class=\"blog-nav-item\" href=\"#\">New features</a>\n");
	// echo("\t\t\t\t<a class=\"blog-nav-item\" href=\"#\">Press</a>\n");
	// echo("\t\t\t\t<a class=\"blog-nav-item\" href=\"#\">New hires</a>\n");
	// echo("\t\t\t\t<a class=\"blog-nav-item\" href=\"#\">About</a>\n");
	echo("\t\t\t\t<span class=\"blog-nav-item\">STATISTICALLY.ME</span>\n");
	echo("\t\t\t\t<a id=\"login\" class=\"blog-nav-item pull-right\" href=\"#\">Log In</a>\n");
	echo("\t\t\t\t<a id=\"register\" class=\"blog-nav-item pull-right\" href=\"#\">Register</a>\n");
	// echo("\t\t\t\t<a id=\"logout\" href=\"#\" class=\"pull-right\"><img id=\"fbPic\" class=\"img-responsive\"></a>\n");
	echo("\t\t\t\t<a id=\"logout\" href=\"#\" class=\"blog-nav-item pull-right\"></a>\n");
	echo("\t\t\t</nav>\n");
	echo("\t\t</div>\n");
	echo("\t</div>\n");
	//echo("\t<div class=\"container\">\n");
}

function getFooter() {
	//echo("\t</div> <!-- End Container -->\n");
	echo("\t\t<!-- Javascript files will go under here -->\n");
}

?>