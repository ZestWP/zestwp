<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_SCRITPS); ?></h2>
    <br class="clear" />
	<?php printMsg($msg); errorMsg($error); ?>
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-campaign" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $static->id; ?>" />
       
		<div id="poststuff" class="metabox-holder">
			<div class="form-field">
				<label for="header" class="width20imp float"><?php _e('Header');?></label>
				<textarea name="header" class="width60imp float" id="header"><?php echo $static->properties['header']; ?></textarea>
			</div><br class="clear"/>
			
			<div class="form-field">
				<label for="footer" class="width20imp float"><?php _e('Footer');?></label>
				<textarea name="footer" class="width60imp float" id="footer"><?php echo $static->properties['footer']; ?></textarea>
			</div><br class="clear"/>
			
			<div class="form-field width60"><br class="clear"/>
				<label for="logo" class="width20imp float"><?php _e('Logo');?></label> 
				<div class="width30imp float"><input type="file" name="logo" class="no-border" /></div>
				<?php if($static->properties['img']) { ?><div class="width40imp float"><img src="data:image/x-icon;base64,<?php echo $static->properties['img']; ?>" width="200" height="100"></div><?php } ?>
			</div><br class="clear" />
        </div>
        <p><input name="save" id="save" class="button button-primary button-large" value="Save" type="submit" /></p>
		</form>
</div>