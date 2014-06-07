<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_TASK_TITLE); ?></h2>
    <br class="clear" />
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-task" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
       
		<div id="poststuff" class="metabox-holder">
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
				<input type="text" name="date" size="30" tabindex="3" value="<?php if($task->properties['date'] != 0) echo date('d-m-Y', $task->properties['date']); ?>" class="datepicker" />
				<br class="clear" />
			</div>	

        </div>
        <p><input name="publish" id="publish" class="button button-primary button-large" value="Save Task" type="submit" /></p>
		<div><a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;action=delete&amp;id=<?php echo $id; ?>" class="trash">Delete <?php _e('Task');?></a></div>
		</form>
</div>