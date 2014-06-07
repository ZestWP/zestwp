<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_EMAIL_TITLE); ?></h2>
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-mails" method="post" >

		<div class="leftPanel metabox-holder formDiv float margin10">
		    <div class="form-field form-required">
				<label for="campaign"><?php _e('Select Campaign');?></label><br class="clear" />
				<select name="campaign" id="campaign" class="width95">
					<option disabled="disabled">Loading...</option>
				</select>
			</div><br class="clear" />
		
			<div class="form-field form-required ">
				<label for="email"><?php _e('Select Email');?></label><br class="clear" />
				<select name="email" id="email" class="width95">
					<option disabled="disabled">--Select campaign--</option>
				</select>
			</div><br class="clear" />
			
			<div class="form-field form-required  ">
				<label for="sendmail"><?php _e('Send mail using');?></label><br class="clear" />
				<select name="sendmail" id="sendmail" class="width95">
					<option disabled="disabled" selected="selected">--Select type--</option>
					<option value="sendmail">sendmail</option>
					<option value="smtp">smtp</option>
				</select>
			</div><br class="clear" />
			
			<div class="form-field form-required ">
				<label for="list"><?php _e('Select List');?></label><br class="clear" />
				<select name="list" id="list" class="width95">
					<option disabled="disabled" selected="selected">--Select List--</option>
					<?php
					if(sizeof($lists)>0){
						foreach($lists as $item){
							$r = unserialize($item->properties);
							echo '<option value="'.$item->id.'">'.$r['name'].'</option>';
						}
					}
					?>
				</select>
			</div><br class="clear" />
			
		</div>
		
		<div class="float width30 rightPanel">
		
		<div id="side-sortables" class="accordion-container">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Send Mail') ?></h3>
			<div class="inside">
					
					<label for="fromAddress"><?php _e('Override default From Address');?></label>
					<input type="text" name="fromAddress" size="30" tabindex="1" value="" id="title" autocomplete="off" />
				
					<label for="fromName"><?php _e('Override default From Name');?></label>
					<input type="text" name="fromName" size="30" tabindex="1" value="" id="title" autocomplete="off" />
					
					<label for="replyToAddress"><?php _e('Override default ReplyTo Address');?></label>
					<input type="text" name="replyToAddress" size="30" tabindex="1" value="" id="title" autocomplete="off" />
				
					<label for="replyToName"><?php _e('Override default ReplyTo Name');?></label>
					<input type="text" name="replyToName" size="30" tabindex="1" value="" id="title" autocomplete="off" />
			
				<p><input name="send" id="send" class="preview button button-primary button-large" value="Send Mail" type="submit" /></p>
				<br class="clear" />
			</div>
		</div><!-- /submitdiv -->		
		</div>
		
		<div id="side-sortables" class="accordion-container">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Lists') ?></h3>
			<div class="inside" style="display:none;">
				<div class="list-item list-item--1" style="display:block;">-- Select List --</div>
				<?php
				if(sizeof($lists)>0){
					foreach($lists as $item){
						$r = unserialize($item->properties);
						if(sizeof($r['email'])>0){
							echo '<div class="list-item list-item-'.$item->id.'">';
							foreach($r['email'] as $k=>$v){
								echo '<label><input type="checkbox" name="emailList['.$item->id.']['.$k.']" value="'.$v['fname'].' '.$v['lname'].'" checked=checked/>'.$v['fname'].' '.$v['lname'].' &lt;<b>'.$k.'</b>&gt;<br class="clear"/></label>';
							}
							echo '</div>';
						}
					}
				}
				?>
			</div>
		</div><!-- /submitdiv -->		
		</div>
		
		<?php if(isset($_POST['send'])){ ?>
		<div id="side-sortables" class="accordion-container">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Success Mails') ?></h3>
			<div class="inside" style="display:none;">
				<?php
				if(sizeof($logs['success'])>0){
					foreach($logs['success'] as $email=>$item){
						echo '<div>'.$email.'</div>';
					}
				}
				else _e("No Mails sent");
				?>
			</div>
		</div><!-- /submitdiv -->		
		</div>
		<?php } ?>
		
		<?php if(isset($_POST['send'])){ ?>
		<div id="side-sortables" class="accordion-container">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Error Mails') ?></h3>
			<div class="inside" style="display:none;">
				<?php
				if(sizeof($logs['error'])>0){
					foreach($logs['error'] as $email=>$item){
						echo '<div>'.$email.'  =>  <span class="zest-error">'.$item.'</span></div><br>';
					}
				}
				else _e("No error in sent mail");
				?>
			</div>
		</div><!-- /submitdiv -->		
		</div>
		<?php } ?>
		
		</div>
		</form>

<script type="text/javascript">
jQuery(document).ready( function($) {
	
	$('#campaign').empty().html('<option>Loading...</option>');
	$.get('<?php echo  zest_url();?>ajax/campaigns.php', function(data){
		$('#campaign').html(data);
	});
	
	$('#form-mails').delegate('.handlediv', 'click', function(){
		$(this).siblings('.inside').slideToggle();
		$(this).toggleClass('handleclose');
	});
	
	$('#form-mails').delegate('#campaign', 'change', function(){
		$v = $(this).val();
		$('#email').empty().html('<option>Loading...</option>');
		$.get('<?php echo  zest_url();?>ajax/emails.php?id=' + $v, function(data){
			$('#email').html(data);
			
		});
	});
	$('#form-mails').delegate('#list', 'change', function(){
		$v = $(this).val();
		$('.list-item').hide();
		$('.list-item-'+$v).show();
	});
});
</script>
</div>




