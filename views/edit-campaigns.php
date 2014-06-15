<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_CAMPAIGN_TITLE); ?></h2>
    <br class="clear" />
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-campaign" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
       
		<div id="poststuff" class="metabox-holder <?php if($id>0) echo '  width70 float margin10'; ?>">
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
        
        
        <p><input name="publish" id="publish" class="button button-primary button-large" value="Save Campaign" type="submit" /></p>
		</div>
		
		<?php if($id>0) { ?>
		
		<div class="float rightPanel">
			<div id="side-sortables" class="accordion-container">
			<div id="submitdiv" class="stuffbox submit-box width25 float postbox" >
				<div class="handlediv" title="Click to toggle"><br/></div>
				<h3><?php _e('Email') ?></h3>
				<div class="submit-box-content inside">
					<?php
					if(sizeof($emails)>0){
						foreach($emails as $id=>$name){
							echo '<a href="admin.php?page='._PLUGIN_NAME.'-email&id='.$id.'" target="_blank">'.$name.'</a><br class="clear"/>';
						
						
						}
					}
					else echo "No email created";
					?>
				</div>
			</div><!-- /submitdiv -->		
			</div><!-- /submitdiv -->		
		
			<div id="side-sortables" class="accordion-container">
			<div id="submitdiv" class="stuffbox submit-box width25 float postbox" >
				<div class="handlediv" title="Click to toggle"><br/></div>
				<h3><?php _e('Landing Page') ?></h3>
				<div class="submit-box-content inside">
					<?php
					if(sizeof($posts)>0){
						foreach($posts as $id=>$name){
							echo '<a href="post.php?post='.$id.'&action=edit" target="_blank">'.$name.'</a><br class="clear"/>';
						
						
						}
					}
					else echo "No Landing page created";
					?>
				</div>
			</div><!-- /submitdiv -->		
			</div><!-- /submitdiv -->		
			
			</div>
		<?php  } ?>
		</form>
</div>

<script type="text/javascript">
jQuery(document).ready( function($) {
	
	$('#form-campaign').delegate('.handlediv', 'click', function(){
		$(this).siblings('.inside').slideToggle();
		$(this).toggleClass('handleclose');
	});
});
</script>