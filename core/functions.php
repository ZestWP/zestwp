<?php

function zest_url($trailing = true) {
	$url = plugins_url().'/'.__ZEST_ROOT;
	$url .= ($trailing) ? '/' : '';
	return $url;
}

/*MESSAGES TO PRINT*/
function printMsg($message)
{
	if($message == '') return false;
	echo '<div id="message" class="updated">';
	echo '<p>';
		_e($message);
	echo '</p>';
	echo '</div>';
}

/*MESSAGES TO PRINT*/
function errorMsg($message)
{
	if($message == '') return false;
	echo '<div id="message" class="error">';
	echo '<p>';
		_e($message);
	echo '</p>';
	echo '</div>';
}

?>