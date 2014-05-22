<?php
require_once("../../../../wp-config.php");
require_once("../core/constants.php");
global $wpdb;
$table = $wpdb->prefix._DATABASE;
$campaign = _TABLE_CAMPAIGN;
$table_name = _TABLE_EMAIL;


$search = serialize(_TABLE_CAMPAIGN).serialize($_GET['id']);

$results = $wpdb->get_results( 
			"SELECT id, properties, created
				FROM {$table}
				WHERE name='{$table_name}'
				AND properties LIKE '%{$search}%}'
				ORDER BY created DESC
			"
		);
echo '<option disabled=disabled selected="selected">--select Email--</option>';
if(sizeof($results)>0){
	foreach($results as $item){
		$r = unserialize($item->properties);
		echo '<option value="'.$item->id.'">'.$r['title'].'</option>';
	}
}



?>