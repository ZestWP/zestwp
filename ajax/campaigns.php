<?php
require_once("../../../../wp-config.php");
require_once("../core/constants.php");
global $wpdb;
$table = $wpdb->prefix._DATABASE;
$table_name = _TABLE_CAMPAIGN;

$results = $wpdb->get_results( 
			"SELECT id, properties, created
				FROM {$table}
				WHERE name='{$table_name}'
				
				ORDER BY created DESC
			"
		);

$s = $_GET['id'] ? $_GET['id'] : 0;
echo '<option disabled=disabled selected="selected">--select campaign--</option>';
if(sizeof($results)>0){
	foreach($results as $item){
		$r = unserialize($item->properties);
		$sel = ($s == $item->id) ? ' selected="selected"' : '';
		echo '<option value="'.$item->id.'" '.$sel.'>'.$r['name'].'</option>';


	}
}



?>