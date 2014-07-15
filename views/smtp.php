<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_SMTP_TITLE); ?></h2>
    <br class="clear" />
	<?php printMsg($msg); errorMsg($error); ?>
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-campaign" method="post">
		<input type="hidden" name="id" value="<?php echo $smtp->id; ?>" />
       
		<div class="leftPanel metabox-holder formDiv float">
		   <div class="form-field form-required">
				<label for="host"><?php _e('Enter SMTP Host');?></label>
				<input type="text" name="host" size="30" tabindex="1" value="<?php echo $smtp->properties['host']; ?>" id="host" autocomplete="off" />
			</div>
			
			<div class="form-field form-required">
				<label for="port"><?php _e('Enter SMTP Port');?></label>
				<input type="text" name="port" size="30" tabindex="2" value="<?php echo $smtp->properties['port']; ?>" id="port" autocomplete="off" />
			</div>
			
			<div class="form-field form-required">
				<label for="username"><?php _e('Enter SMTP Username');?></label>
				<input type="text" name="username" size="30" tabindex="3" value="<?php echo $smtp->properties['username']; ?>" id="username" autocomplete="off" />
			</div>
			
			<div class="form-field form-required">
				<label for="password"><?php _e('Enter SMTP Password');?></label>
				<input type="text" name="password" size="30" tabindex="4" value="<?php echo $smtp->properties['password']; ?>" id="password" autocomplete="off" />
			</div>
			
			<div class="form-field form-required">
				<label for="secure"><?php _e('SMTP secure layer');?></label>
				<select name="secure" tabindex="5" id="secure" class="width95">
				<option value="ssl">SSL</option>
				<option value="tls" <?php if($smtp->properties['secure'] == 'tls') echo 'selected="selected"';?>>TLS</option>
				</select>
			</div>
			
			<div class="form-field">
				<label for="fromName"><?php _e('Default From Name');?></label>
				<input type="text" name="fromName" size="30" tabindex="6" value="<?php echo $smtp->properties['fromName']; ?>" id="fromName" autocomplete="off" />
			</div>
			
			<div class="form-field">
				<label for="fromAddress"><?php _e('Default From address');?></label>
				<input type="text" name="fromAddress" size="30" tabindex="7" value="<?php echo $smtp->properties['fromAddress']; ?>" id="fromAddress" autocomplete="off" />
			</div>
			
			<div class="form-field">
				<label for="replyToName"><?php _e('Default <b>Reply To</b> name');?></label>
				<input type="text" name="replyToName" size="30" tabindex="7" value="<?php echo $smtp->properties['replyToName']; ?>" id="replyToName" autocomplete="off" />
			</div>
			
			<div class="form-field">
				<label for="replyToAddress"><?php _e('Default <b>Reply To</b> address');?></label>
				<input type="text" name="replyToAddress" size="30" tabindex="7" value="<?php echo $smtp->properties['replyToAddress']; ?>" id="replyToAddress" autocomplete="off" />
			</div>
        </div>
		
		
		<div class="float width30 rightPanel">
			<div id="side-sortables" class="accordion-container">
			<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
				<div class="handlediv" title="Click to toggle"><br/></div>
				<h3><?php _e('DKIM settings') ?></h3>
				<div class="inside">
						
						<label for="DKIM_domain"><?php _e('DKIM domain');?></label>
						<input type="text" name="DKIM_domain" size="30" tabindex="7" value="<?php echo $smtp->properties['DKIM_domain']; ?>" id="DKIM_domain" autocomplete="off" /><br/>
					
						<label for="DKIM_private"><?php _e('DKIM private key');?></label>
						<input type="text" name="DKIM_private" size="30" tabindex="7" value="<?php echo $smtp->properties['DKIM_private']; ?>" id="DKIM_private" autocomplete="off" /><br/>
						
						<label for="DKIM_selector"><?php _e('DKIM Selector');?></label>
						<input type="text" name="DKIM_selector" size="30" tabindex="7" value="<?php echo $smtp->properties['DKIM_selector']; ?>" id="DKIM_selector" autocomplete="off" /><br/>
					
						<label for="DKIM_passphrase"><?php _e('DKIM pass phrase');?></label>
						<input type="text" name="DKIM_passphrase" size="30" tabindex="7" value="<?php echo $smtp->properties['DKIM_passphrase']; ?>" id="DKIM_passphrase" autocomplete="off" /><br/>
				
					<p><input name="save" id="save" class="button button-primary button-large" value="Save" type="submit" /></p>
					<br class="clear" />
				</div>
			</div><!-- /submitdiv -->		
			</div>
		</div>
		
		
        
		</form>
</div>