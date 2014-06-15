<?php
require_once("../../../../wp-config.php");
require_once("../core/constants.php");
global $wpdb;
$table = $wpdb->prefix._DATABASE;
$table_name = _TABLE_EMAIL;
$page = _TABLE_PAGE_CAMPAIGN;
$campaign = _TABLE_CAMPAIGN;
$mail = _TABLE_MAIL_LOG;

$id = $_GET['id'] ? $_GET['id'] : 0;

$ser = serialize($campaign).serialize($id);
$metaSer = serialize($id);

$results = $wpdb->get_results( 
			"SELECT COUNT(meta_key) as tot
				FROM {$wpdb->postmeta}
				WHERE `meta_key` = '{$page}' && `meta_value` LIKE '%{$metaSer}%'
			"
		);
echo '<tbody>';
if(sizeof($results)>0)
	echo '<tr><td>Used Pages : '.$results[0]->tot.'</td></tr>';	

$results = $wpdb->get_results( 
			"SELECT COUNT(id) as tot
				FROM {$table}
				WHERE name='{$table_name}'
				AND properties LIKE '%{$ser}%'
				
				ORDER BY created DESC
			"
		);
if(sizeof($results)>0)
	echo '<tr><td>Total Emails : '.$results[0]->tot.'</td></tr>';
	
$results = $wpdb->get_results( 
			"SELECT *
				FROM {$table}
				WHERE name='{$mail}'
				AND properties LIKE '%{$ser}%'
				
				ORDER BY created DESC
			"
		);
	$i = 0;
if(sizeof($results)>0){
foreach($results as $r){
	$r = unserialize($r->properties);
	$i += $r['count'];
}
echo '<tr><td>Sent Emails : '.$i.'</td></tr>';
}
echo '</tbody>';
?>