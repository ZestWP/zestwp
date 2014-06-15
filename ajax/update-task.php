<?php
require_once("../../../../wp-config.php");
require_once("../core/constants.php");
global $wpdb;
$table = $wpdb->prefix._DATABASE;
$table_name = _TABLE_TASK;

$data['name'] = $_POST['name'];
$data['description'] = $_POST['description'];
$data['date'] = strtotime($_POST['date']);
if(isset($_POST['done']) && $_POST['done'] == 1) $data['done'] = 1;
if(isset($_POST['id'])) $id = $_POST['id'];

$properties = serialize($data);
$d = date("Y-m-d H:i:s");

if($id > 0 ) {	
	
	$wpdb->get_results( 
			"UPDATE {$table} set properties = '{$properties}', modified = '{$d}'
				WHERE id='{$id}'
			"
		);


}
else{
	$wpdb->get_results( 
			"INSERT INTO  {$table} set properties = '{$properties}', created = '{$d}', name = '{$table_name}'"				
		);
}
			
echo $data['name'];exit;

?>
