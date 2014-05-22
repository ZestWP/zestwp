<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_EMAIL_TITLE); ?></h2>
	<?php printMsg($msg); errorMsg($error); ?>
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-email" method="post" >
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
		

		<div id="poststuff" class="metabox-holder formDiv  width70 float margin10">
		    <div class="form-field width80">
				<label for="campaign"><?php _e('Select Campaign');?></label><br class="clear" />
				<select type="text" name="campaign" value="" id="campaign" class="width95">
				
				</select>
			</div><br class="clear" />
			
			<div class="form-field form-required width80">
				<label for="title"><?php _e('Enter Title here');?></label>
				<input type="text" name="title" value="<?php echo $email->properties['title']; ?>" id="title" autocomplete="off" />
			</div><br class="clear" />
			
			<div class="form-field form-required width80">
				<label for="subject"><?php _e('Enter Email Subject here');?></label>
				<input type="text" name="subject" value="<?php echo $email->properties['subject']; ?>" id="subject" autocomplete="off" />
			</div><br class="clear" />
			
			<?php 
			$quicktags_settings = array( 'buttons' => 'br,strong,em,link,block,del,ins,img,ul,ol,li' );
			$content = ($email->properties['content'] !='') ? $email->properties['content'] : "Dear {TO_NAME},<br><br><br><br>{SIGNATURE}";
			wp_editor( $content, 'content', array(
					'dfw' => true,
					'drag_drop_upload' => false,
					'tabfocus_elements' => 'insert-media-button,save-post',
					'editor_height' => 360,
					'editor_width' => '600',
					'tinymce' => array(
						'resize' => false,
						'add_unload_trigger' => false,
					),$quicktags_settings
				) ); ?>
				
			</div>
		
			<div class="float rightPanel">
			<div id="side-sortables" class="accordion-container">
			<div id="submitdiv" class="stuffbox submit-box width25 float postbox" >
				<div class="handlediv" title="Click to toggle"><br/></div>
				<h3><?php _e('Publish') ?></h3>
				<div class="submit-box-content inside">
					<input name="preview" id="post-preview" class="preview button" value="Preview" type="submit" />
					
					<br class="clear" />
					<?php $datef = __( 'M j, Y @ G:i' );
					
					?>
					<p>Created : <?php _e(date_i18n( $datef, strtotime( $email->created ) )) ?> </p>
					<p>Last Modified :  <?php _e(date_i18n( $datef, strtotime( $email->modified ) )) ?></p>
					<div id="delete-action">
							<a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;action=delete&amp;id=<?php echo $id; ?>" class="trash">Delete <?php _e('Email');?></a></div>
					<p><input name="publish" id="publish" class="preview button button-primary button-large" value="Save Email" type="submit" /></p>
					<br class="clear" />
				</div>
			</div><!-- /submitdiv -->		
			</div><!-- /submitdiv -->		
		
			<div id="side-sortables" class="accordion-container">
			<div id="submitdiv" class="stuffbox submit-box width25 float postbox" >
				<div class="handlediv" title="Click to toggle"><br/></div>
				<h3><?php _e('Signature') ?></h3>
				<div class="submit-box-content inside">
					<textarea name="signature" id="signature" tabindex="2" class="width95" rows=5><?php echo $email->properties['signature']; ?></textarea>
				</div>
			</div>
			</div>
			<?php if(isset($id) && $id>0){ ?>
			<div id="side-sortables" class="accordion-container">
			<div id="submitdiv" class="stuffbox submit-box width25 float postbox" >
				<div class="handlediv" title="Click to toggle"><br/></div>
				<h3><?php _e('Test Mail') ?></h3>
				<div class="submit-box-content inside">
					<p>You can enter upto 10 mail by adding next line</p>
					<textarea name="testMail" id="testMail" tabindex="2" class="width95" rows=5></textarea>
					<p><input name="test_mail" id="test_mail" class="preview button button-primary button-large" value="Test Email" type="submit" /></p>
				</div><br class="clear" />
			</div>
			</div>
			<?php } ?>
			<div id="side-sortables" class="accordion-container">
			<div id="submitdiv" class="stuffbox submit-box width25 float postbox" >
				<div class="handlediv" title="Click to toggle"><br/></div>
				<h3><?php _e('Tags to used') ?></h3>
				<div class="submit-box-content inside">
					<div>First name&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<b>{FNAME}</b></div><br class="clear" />
					<div>Last name&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<b>{LNAME}</b></div><br class="clear" />
					<div>Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<b>{SIGNATURE}</b></div><br class="clear" />
					<div>Custom tag&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<b>{CTAG1}</b></div><br class="clear" />
				</div>
			</div>
			</div>
			</div>
			
		</form>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#post-preview').click(function(){
		$(this).parents('form').attr({'target':'_blank'});
	});
	
	$('#publish').click(function(){
		$(this).parents('form').removeAttr('target');
	});
	
	$('#campaign').empty().html('<option>Loading...</option>');
	$.get('<?php echo  zest_url();?>ajax/campaigns.php?id=<?php echo $email->properties['campaign']; ?>', function(data){
		$('#campaign').html(data);
		
	});
	
	$('#form-email').delegate('.handlediv', 'click', function(){
		$(this).siblings('.inside').slideToggle();
		$(this).toggleClass('handleclose');
	});
});
</script>
</div>




