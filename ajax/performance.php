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


$title = "";
$ret = $wpdb->get_results( 
			"SELECT properties FROM {$table} WHERE `id`='{$id}'
			"
		);
		
	if(sizeof($ret[0])>0){
		$prop = unserialize($ret[0]->properties);
		$title = $prop['name'];
	}
	
	
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
	$total_pages = $results[0]->tot;	

$results = $wpdb->get_results( 
			"SELECT COUNT(id) as tot
				FROM {$table}
				WHERE name='{$table_name}'
				AND properties LIKE '%{$ser}%'
				
				ORDER BY created DESC
			"
		);
if(sizeof($results)>0)	
	$total_emails = $results[0]->tot;	
	
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
	$sent_mails = $i;
}
?>

<thead>
		<tr><th colspan=2><?php echo $title; ?></th></tr>
	</thead>
	<tbody>	

	<tr><td>Pages </td><td>:<b> <?php echo $total_pages; ?></b></td></tr>
	<tr class="alternate"><td>Emails  </td><td>:<b> <?php echo $total_emails; ?></b></td></tr>
	<tr><td>Sent Mails  </td><td>:<b> <?php echo $sent_mails; ?></b></td></tr>
</tbody>