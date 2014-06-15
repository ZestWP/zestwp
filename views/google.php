<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_GOOGLE); ?></h2>
    <br class="clear" />
	<?php printMsg($msg); errorMsg($error); ?>
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-campaign" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $static->id; ?>" />
       
			<div class="form-field">
				<label for="google" class="width20imp float"><?php _e('Google analytics');?></label>
				<textarea name="google" class="width60imp float" id="google"><?php echo $static->properties['google']; ?></textarea>
			</div><br class="clear"/>
			
        </div>
        <p><input name="save" id="save" class="button button-primary button-large" value="Save" type="submit" /></p>
		</form>
</div>