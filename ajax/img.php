<?php
if(isset($_GET['img'])){
	$img = $_GET['img'];
	echo '<img src="'.$img.'" width=500 height=100/>';
}
?>