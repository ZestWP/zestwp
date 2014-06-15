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
<tbody>	
<tr><td>Total Email sent : <?php echo $total; ?></td></tr>
<tr><td>Failed Emails : <?php echo $fail; ?></td></tr>
<tr><td>Received mails : <?php echo $email; ?></td></tr>
<tr><td>Opened in Browser : <?php echo $browser; ?></td></tr>
</tbody>
