<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_USERS_TITLE); ?></h2>
    <br class="clear" />
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-user" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		<input type="hidden" name="source" value="<?php echo $user->properties['source']; ?>" />
		<input type="hidden" name="source_id" value="<?php echo $user->properties['source_id']; ?>" />
       
		<div id="poststuff" class="metabox-holder">
		   <div class="form-field form-required">
				<label for="fname"><?php _e('First name');?></label>
				<input type="text" name="fname" size="30" value="<?php echo $user->properties['fname']; ?>" id="fname" autocomplete="off" />
			</div><br class="clear" />
			<div class="form-field form-required">
				<label for="lname"><?php _e('Last name');?></label>
				<input type="text" name="lname" size="30" value="<?php echo $user->properties['lname']; ?>" id="lname" autocomplete="off" />
			</div><br class="clear" />
			<div class="form-field form-required">
				<label for="email"><?php _e('Email address');?></label>
				<input type="text" name="email" size="30" value="<?php echo $user->properties['email']; ?>" id="email" autocomplete="off" />
			</div><br class="clear" />
			<div class="form-field form-required">
				<label for="contact"><?php _e('Contact number');?></label>
				<input type="text" name="contact" size="30" value="<?php echo $user->properties['contact']; ?>" id="contact" autocomplete="off" />
			</div><br class="clear" />
			<div class="form-field">
				<label for="address"><?php _e('Address'); ?></label><br class="clear" />
				<textarea name="address" id="address" rows="5"><?php echo $user->properties['address']; ?></textarea>
			</div>
        </div>
        <p><input name="publish" id="publish" class="button button-primary button-large" value="Save User" type="submit" /></p>
		</form>
</div>