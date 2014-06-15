<?php
require_once("../../../../wp-config.php");
require_once("../core/constants.php");
global $wpdb;
$table = $wpdb->prefix._DATABASE;
$page = _TABLE_PAGE_FORM;
$form = 'form-page';
$email = _TABLE_EMAIL;

$id = $_GET['id'] ? $_GET['id'] : 0;

$ser = serialize($form).serialize($id);
$metaSer = serialize($page).serialize($id);

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
				WHERE name='{$email}'
				AND properties LIKE '%{$ser}%'
				
				ORDER BY created DESC
			"
		);
if(sizeof($results)>0)
	echo '<tr><td>Total Emails : '.$results[0]->tot.'</td></tr>';	
	
	
?>
