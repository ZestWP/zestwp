<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_CAMPAIGN_TITLE); ?></h2>
    <br class="clear" />
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-campaign" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
       
		<div id="poststuff" class="metabox-holder">
		   <div class="form-field form-required">
				<label for="title"><?php _e('Enter campaign name here');?></label>
				<input type="text" name="name" size="30" tabindex="1" value="<?php echo $campaign->properties['name']; ?>" id="title" autocomplete="off" />
			</div>
			<div class="form-field">
				<label for="description"><?php _e('Description'); ?></label><br class="clear" />
				<textarea name="description" id="description" rows="12" tabindex="2" ><?php echo $campaign->properties['description']; ?></textarea>
			</div>
			<div class="form-field width20">
				<label for="startDate"><?php _e('Enter campaign start Date');?></label>
				<input type="text" name="startDate" size="30" tabindex="3" value="<?php if($campaign->properties['startDate'] != 0) echo date('d-m-Y', $campaign->properties['startDate']); ?>" class="datepicker" />
				<br class="clear" />
			</div>	
			<div class="form-field width20">
				<label for="endDate"><?php _e('Enter campaign End Date');?></label>
				<input type="text" name="endDate" size="30" tabindex="4" value="<?php if($campaign->properties['endDate'] != 0) echo date('d-m-Y', $campaign->properties['endDate']); ?>" class="datepicker" />
				<br class="clear" />
			</div>
        </div>
        <p><input name="publish" id="publish" class="button button-primary button-large" value="Save Campaign" type="submit" /></p>
		</form>
</div>