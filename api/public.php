<?php
/*********************
docs.paxagency.com/php
*********************/
$_URL=array_slice(explode('/',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH)),1);
$_URL_STRING =  implode("/",$_URL);
if($_URL[0]=='public' || $_URL_STRING=="robots.txt" || $_URL_STRING=="sitemap.xml") {
	$ext = pathinfo($_URL_STRING, PATHINFO_EXTENSION);
	if($ext=="css") header('Content-type: text/css');
	if($ext=="js") header('Content-type: text/javascript');
	if($ext=="jpg" || $ext=="jpeg") header('Content-type: image/jpeg');
	if($ext=="png") header('Content-type: image/png');
	if($ext=="webp") header('Content-type: image/webp');
	if($ext=="gif") header('Content-type: image/gif');
	if($ext=="ico") header('Content-type: image/ico');
	if($ext=="svg") header('Content-type: image/svg+xml');
	if($ext=="xml") header('Content-type: application/xml');
	if($ext=="txt") header('Content-type: text/plain');
	if($ext=="csv") header('Content-type: text/csv');
	if($ext=="pdf") header('Content-type: application/pdf');
	if($ext=="zip") header('Content-type: application/zip');
	if($ext=="rss") header('Content-Type: application/rss+xml; charset=ISO-8859-1');
	if($ext=="mp4") header('Content-type: video/mp4');
	if($ext=="mpeg") header('Content-type: video/mpeg');
	if($ext=="mp3") header('Content-type: audio/mpeg');
	
	if(file_exists($_DIR.$_URL_STRING) && !is_dir($_DIR.$_URL_STRING)) {
		readfile($_DIR.$_URL_STRING);
		die();
	}
}

?>
