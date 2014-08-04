<?php
$_SESSION["language"] = "en"; // set the default language of the website

if($this->session->userdata('lang') != "") { // check if get any language change parameter and change the session value
	$_SESSION["language"] = $this->session->userdata('lang');
}

if(isset($_SESSION["language"]) && $_SESSION["language"] != ""){
	$language = $_SESSION["language"];
	include "lang/".$language."/".$language.".php"; // include the language file from the 'lang' folder
}

$this->session->set_userdata('translate', $lang);