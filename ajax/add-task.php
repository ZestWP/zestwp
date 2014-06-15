<?php
require_once("../../../../wp-config.php");
require_once("../core/constants.php");
global $wpdb;
$table = $wpdb->prefix._DATABASE;
$table_name = _TABLE_TASK;
$id = ($_GET['id'] ) ? $_GET['id'] : 0;
$date = ($_GET['date'] ) ? $_GET['date'] : 0;

$upd = ($id > 0 ) ? "Update" : "Create";
if($id > 0){

$results = $wpdb->get_results( 
			"SELECT id, properties, created
				FROM {$table}
				WHERE name='{$table_name}' AND id = '{$id}'
			"
		);
if(sizeof($results)>0)
	$task = $results[0];
	
$task->properties = unserialize($task->properties);	
}
$date = ($task->properties['date'] ) ? $task->properties['date'] : strtotime($date);
?>
<div style="width:560px;">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_TASK_TITLE); ?></h2>
    <br class="clear" />
	<form action="javascript:void(0);" id="form-task" method="post">
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="done" class="done" value="0" />
	   <div class="form-field form-required">
			<label for="title"><?php _e('Enter task name here');?></label>
			<input type="text" name="name" size="30" tabindex="1" value="<?php echo $task->properties['name']; ?>" id="title" autocomplete="off" />
		</div>
		<div class="form-field">
			<label for="description"><?php _e('Description'); ?></label><br class="clear" />
			<textarea name="description" id="description" rows="12" tabindex="2" ><?php echo $task->properties['description']; ?></textarea>
		</div>
		<div class="form-field width20">
			<label for="date"><?php _e('Enter start Date');?></label>
			<input type="text" name="date" id="date" size="30" tabindex="3" value="<?php if($date != "") echo date('d-m-Y', $date); ?>" class="datepicker" />
			<br class="clear" />
		</div>	

	<?php if(!$task->properties['done']) { ?>
	<p><input name="publish" id="publish" class="button button-primary button-large" value="<?php _e($upd) ?> Task" type="button" />
	<?php if($id>0) { ?><input id="done" class="button button-primary button-large" value="Mark as Done" type="button" /><?php } ?></p>
	<?php } ?>
	<div><a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;action=delete&amp;id=<?php echo $id; ?>" class="trash">Delete <?php _e('Task');?></a></div>
	</form>
</div>
<script>
jQuery(document).ready( function($) {
	$('.datepicker').datepicker({ dateFormat: 'dd-mm-yy' });
	$('#done').click(function(){
		$('.done').val(1);
		$('form').submit();
	});
	$('#publish').click(function(){
		$('.done').val(0);
		$('form').submit();
	});
	$('form').submit(function(){
		
		$id = "<?php echo $id;?>";
		$url = "<?php echo zest_url().'ajax/update-task.php';?>";
		$d = $('#date').val();
		$.post($url, $('form').serialize(), function(data){	
			if($id != "" && $id > 0)
				$('.calendar').find(".c"+$id).html(data);
			else 
				$('.calendar .'+$d).append(data);
			$('.fade').click();
		
		});
		
	
	});
});

</script>