<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_FORM_TITLE); ?></h2>
    <br class="clear" />
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-form" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
       
		<div class="leftPanel metabox-holder formDiv float margin10" id="main-form">
		   <div class="form-field form-required">
				<label for="title"><?php _e('Enter name here');?></label>
				<input type="text" name="name" size="30" tabindex="1" value="<?php echo $form->properties['name']; ?>" id="title" autocomplete="off" />
			</div><br class="clear" />
			<div class="form-field">
				<label for="field" class="float" style="padding-top:5px;"><?php _e('Add field');?> : </label>
				<select name="field" id="field" class="float">
					<option value="" selected="selected">--select-</option>
					<option value="fname">First name</option>
					<option value="lname">Last name</option>
					<option value="email">Email</option>
					<option value="contact">Contact number</option>
					<option value="address">Address</option>
					<option value="message">Message box</option>
					<option value="textbox">Custom Text box</option>
					<option value="select">Dropdown</option>
					<option value="textarea">Custom Text area</option>
					<option value="captcha">Captcha</option>
					<option value="radio">Custom Radio button</option>
					<option value="checkbox">Custom Check box</option>
				
				</select>
				<input name="add" id="add" class="preview button button-large float width10imp margin10imp" value="Add" type="button" />
			</div><br class="clear" />
			<div id="sortable">
			<?php 
				$counter = 0;
				$prop  = $form->properties;
				if(sizeof($prop)>0){
					foreach($prop as $k=>$v){
						switch($k){
							case 'fname':
							case 'lname':
							case 'email':
							case 'contact':
								$s = (isset($prop['validate'.$k]) && $prop['validate'.$k]==1) ? ' checked="checked"' : '';
								echo ' <div class="toRemove"><br class="clear" /><div class="form-field">
									<label class="width15imp float">'.$v.'</label>
									<input type="text" size="30" name="'.$k.'" value="'.$v.'"  class="width40imp"/>
									<input name="validate'.$k.'" style="width:10px;" value="1"'.$s.' type="checkbox" /> Validate
									<span class="remove margin10imp width10imp"><img src="'. __ZEST_URL.'assets/images/remove.png'.'"/></span>
								</div></div>';
								break;
							case 'textbox':
							case 'textarea':
								foreach($v as $textbox)
								echo ' <div class="toRemove"><br class="clear" /><div class="form-field">
									<label class="width15imp float">'.$textbox.'</label>
									<input type="text" size="30" name="'.$k.'[]" value="'.$textbox.'"  class="width40imp"/>
									<span class="remove margin10imp width10imp"><img src="'. __ZEST_URL.'assets/images/remove.png'.'"/></span>
								</div></div>';
								break;
							case 'address':
							case 'message':
							case 'captcha':
								echo ' <div class="toRemove"><br class="clear" /><div class="form-field">
									<label class="width15imp float">'.$v.'</label>
									<input type="text" size="30" name="'.$k.'" value="'.$v.'"  class="width40imp"/>
									<span class="remove margin10imp width10imp"><img src="'. __ZEST_URL.'assets/images/remove.png'.'"/></span>
								</div></div>';
								break;
							case 'select':
							case 'radio':
							case 'checkbox':
								$counter++;
								foreach($v as $sel=>$select)
								echo ' <div class="toRemove"><br class="clear" /><div class="form-field">
									<label class="width15imp float">'.$select.'</label>
									<input type="text" size="30" name="'.$k.'['.$sel.']" value="'.$select.'"  class="width40imp float"/>
									<textarea rows=3 cols=10 class="width30imp margin10imp float txt" name="selectArray'.$sel.'" placeholder="Add values in new lines">'.print_r($prop['selectArray'.$sel],true).'</textarea>
									<span class="remove margin10imp width10imp"><img src="'. __ZEST_URL.'assets/images/remove.png'.'"/></span>
								</div></div>';
								break;
				
				
				
						}
					}
				}
			?>
        </div>
        </div>
		
		
		<div class="float width30 rightPanel">
		<div id="side-sortables" class="accordion-container">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Publish'); ?></h3>
			<div class="inside">
				<label for="default">
				<input name="default" id="default" value="1" type="checkbox" /><?php _e('Make Default');?></label>
				<?php $datef = __( 'M j, Y @ G:i' ); ?>
				<p>Created : <?php _e(date_i18n( $datef, strtotime( $form->created ) )) ?> </p>
				<p>Last Modified :  <?php _e(date_i18n( $datef, strtotime( $form->modified ) )) ?></p>
				<div id="delete-action">
				<a href="admin.php?page=<?php echo $_GET['page']; ?>&amp;action=delete&amp;id=<?php echo $id; ?>" class="trash">Delete <?php _e(_MENU_FORM_TITLE);?></a></div>	
				<p><input name="publish" id="publish" class="preview button button-primary button-large" value="Save Form" type="submit" /></p>
				<br class="clear" />
			</div>
		</div><!-- /submitdiv -->		
		</div>
		
		<div id="side-sortables" class="accordion-container">
		<div id="submitdiv" class="stuffbox submit-box float postbox width100" >
			<div class="handlediv" title="Click to toggle"><br/></div>
			<h3><?php _e('Instruction'); ?></h3>
			<div class="inside">
				
				<p>In dropdown, add values in new lines</p>
				<br class="clear" />
			</div>
		</div><!-- /submitdiv -->		
		</div>
		
		</div>
		
		
		
        </form>
</div>
<style>
.toRemove{cursor:move;}
.remove{cursor:pointer;}
</style>
<script>
jQuery(document).ready( function($) {
	$( "#sortable" ).sortable();
	$('#form-form').delegate('.handlediv', 'click', function(){
		$(this).siblings('.inside').slideToggle();
		$(this).toggleClass('handleclose');
	});
	$('#form-form').delegate('.remove', 'click', function(){
		$(this).parents('.toRemove').remove();
	});
	$i=<?php echo $counter; ?>;
	$('#form-form').delegate('#add', 'click', function(){
		switch($('#field').val()){
			case 'fname':
			case 'lname':
			case 'email':
			case 'contact':
				$v = ($('#field').val());
				$t = ($('#field option:selected').text());
				$c = $('#hiddenTextbox').clone().appendTo('#main-form').show().removeAttr('id').addClass('toRemove');
				$c.find('label').text($t);
				$c.find('.inp').val($t).attr('name',$v);
				$c.find('.chk').attr('name','validate'+$v);
				break;
			case 'address':
			case 'captcha':
			case 'message':
				$v = ($('#field').val());
				$t = ($('#field option:selected').text());
				$c = $('#hiddenMsg').clone().appendTo('#main-form').show().removeAttr('id').addClass('toRemove');
				$c.find('label').text($t);
				$c.find('.inp').val($t).attr('name',$v);
				break;
			case 'textbox':
			case 'textarea':
				$v = ($('#field').val());
				$t = ($('#field option:selected').text());
				$c = $('#hiddenCTextbox').clone().appendTo('#main-form').show().removeAttr('id').addClass('toRemove');
				$c.find('label').text($t);
				$c.find('.inp').val($t).attr('name', $v+'[]')
				break;
			case 'select':
			case 'checkbox':
			case 'radio':
				$i++;
				$v = ($('#field').val());
				$t = ($('#field option:selected').text());
				$c = $('#hiddenSelect').clone().appendTo('#main-form').show().removeAttr('id').addClass('toRemove');
				$c.find('label').text($t);
				$c.find('.inp').val($t).attr('name', $v+'['+$i+']')
				$c.find('.txt').attr('name', 'selectArray'+$i)
				break;
			
		}
	});
	
});

</script>
 <div class="form-field" id="hiddenTextbox" style="display:none;">
	<br class="clear"/>
	<label class="width15imp float"></label>
	<input type="text" size="30" class="width40imp inp"/>
	<input style="width:10px;" class="chk" value="1" type="checkbox" /> Validate
	<span class="remove margin10imp width10imp"><img src="<?php echo __ZEST_URL.'assets/images/remove.png';?>"/></span>
</div>
 <div class="form-field" id="hiddenCTextbox" style="display:none;">
	<br class="clear"/>
	<label class="width15imp float"></label>
	<input type="text" size="30" name="textbox[]" class="width40imp inp"/>
	<span class="remove margin10imp width10imp"><img src="<?php echo __ZEST_URL.'assets/images/remove.png';?>"/></span>
</div>
<div class="form-field" id="hiddenMsg" style="display:none;">
	<br class="clear"/>
	<label class="width15imp float"></label>
	<input type="text" size="30" class="width40imp inp"/>
	<span class="remove margin10imp width10imp"><img src="<?php echo __ZEST_URL.'assets/images/remove.png';?>"/></span>
</div>
<div class="form-field" id="hiddenSelect" style="display:none;">
	<br class="clear"/>
	<label class="width15imp float"></label>
	<input type="text" size="30" class="width40imp float inp"/>
	<textarea rows=3 cols=10 class="width30imp margin10imp float txt" placeholder="Add values in new lines"></textarea>
	<span class="remove margin10imp width10imp"><img src="<?php echo __ZEST_URL.'assets/images/remove.png';?>"/></span>
</div>