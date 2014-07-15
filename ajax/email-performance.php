<?php
require_once("../../../../wp-config.php");
require_once("../core/constants.php");
global $wpdb;
$table = $wpdb->prefix._DATABASE;
$table_name = _TABLE_EMAIL;
$mail_log = _TABLE_MAIL_LOG;
$mail_track = _TABLE_MAIL_TRACK;

$id = $_GET['id'] ? $_GET['id'] : 0;

$ser = serialize('email').serialize($id);

$title = "";
$ret = $wpdb->get_results( 
			"SELECT properties FROM {$table} WHERE `id`='{$id}'
			"
		);
		
	if(sizeof($ret[0])>0){
		$prop = unserialize($ret[0]->properties);
		$title = $prop['title'];
	}
	
	
$ret = $wpdb->get_results( 
			"SELECT properties FROM {$table} WHERE `name`='{$mail_log}' AND properties LIKE '%{$ser}%'
			"
		);
		
	$total = $fail = 0;
	if(sizeof($ret)>0)
	foreach($ret as $r){
		$r->properties = unserialize($r->properties);
		
		$total += $r->properties['count'];			
		$fail += $r->properties['fail'];			
	}
	
	$ret = $wpdb->get_results( 
		"SELECT properties FROM {$table} WHERE `name`='{$mail_track}' AND properties LIKE '%{$ser}%'
		"
	);
		
	$email = $browser = 0;
	if(sizeof($ret)>0)
	foreach($ret as $r){
		$r->properties = unserialize($r->properties);
		if($r->properties['source'] == 'browser') $browser++;
		else if($r->properties['source'] == 'email') $email++;
	}
	?>
<thead>
		<tr><th colspan=2><?php echo $title; ?></th></tr>
	</thead>
	<tbody>	

	<tr><td>Emails sent </td><td>:<b> <?php echo $total; ?></b></td></tr>
	<tr class="alternate"><td>Email Bounces </td><td>:<b> <?php echo $fail; ?></b></td></tr>
	<tr><td>Email Open Rate  </td><td>:<b> <?php echo $email; ?></b></td></tr>
	<tr class="alternate"><td>Email Click Rate </td><td>:<b> <?php echo $browser; ?></b></td></tr>
</tbody>
