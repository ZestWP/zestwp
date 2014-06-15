<?php
require_once("../../../../wp-config.php");
require_once("../core/constants.php");
global $wpdb;
$table = $wpdb->prefix._DATABASE;


$url = $_GET['id'] ? $_GET['id'] : 0;


$cnt = 0;
if(@$facebook = file_get_contents("http://graph.facebook.com/?id=".$url)){
	$f = json_decode($facebook);
	
	if(isset($f->shares)) $cnt = $f->shares;
	else if(isset($f->likes)) $cnt = $f->likes;
	
}

echo '<tr><td>Facebook  shares: '.$cnt.'</td></tr>';	

$cnt = 0;
if(@$twitter = file_get_contents("http://cdn.api.twitter.com/1/urls/count.json?url=".$url)){
	$f = json_decode($twitter);
	
	if(isset($f->count)) $cnt = $f->count;
	
	
}
echo '<tr><td>Twitter tweets: '.$cnt.'</td></tr>';	


$cnt = 0;
if(@$linkedin = file_get_contents("http://www.linkedin.com/countserv/count/share?format=json&url=".$url)){
	$f = json_decode($linkedin);
	if(isset($f->count)) $cnt = $f->count;
}
echo '<tr><td>Linkedin shares: '.$cnt.'</td></tr>';	


?>
