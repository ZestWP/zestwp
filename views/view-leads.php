<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_LEADS_TITLE); ?></h2>
    <br class="clear" />
	<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-leads" method="post" >
		<input type="hidden" name="id" value="<?php echo $ID; ?>" />
		<input type="hidden" name="source" value="<?php echo $type; ?>" />
		<input type="hidden" name="source_id" value="<?php echo $id; ?>" />
		<div id="poststuff" class="metabox-holder formDiv margin10">
		   
	<?php
	if(sizeof($crm)>0) {
		if($type == 'page') {
			setup_postdata( $source );
			echo ' <div class="rows">
			<div class="col1">Source</div>
			<div class="col2">'.get_the_title($source->ID).'  <a class="view" target="_new" href="'.site_url().'?'._MENU_LANDINGPAGE_MENU.'='.$source->post_name.'">View</a></div>
			
		   </div> <br class="clear" />';
			
		}
		else {
			echo ' <div class="rows">
			<div class="col1">Source</div>
			<div class="col2">'.$source->properties['name'].'  <a class="view" target="_new" href="'.site_url().'?mailer='.$id.'&preview=true">View</a></div>
			
		   </div> <br class="clear" />';
		}
		$array = array('fname'=>'First Name', 'lname'=>'Last Name', 'email'=>'Email', 'contact'=>'Contact', 'select'=>'Custom Select', 'address'=>'Address', 'message'=>'Message', 'radio'=>'Custom Radio', 'checkbox'=>'Custom checkbox', 'textarea'=>'Custom Textarea', 'textbox'=>'Custom Textbox');
		
		foreach($crm->properties as $k=>$prop){
			
			switch($k){
				case 'fname':
				case 'lname':
				case 'email':					
				case 'contact':
					echo '<input type="hidden" name="'.$k.'" id="'.$k.'" value="'.$prop.'"/>
							<div class="rows">
							<div class="col1">'.$array[$k].'</div>
							<div class="col2">'.$prop.'</div>
							
						   </div> <br class="clear" />';
					break;
				case 'textbox':
					foreach($prop as $i=>$sel){
						echo '<input type="hidden" name="textbox['.$i.']" value="'.$sel.'"/>
							<div class="rows">
							<div class="col1">'.$array[$k].'</div>
							<div class="col2">'.$sel.'</div>
							
						   </div> <br class="clear" />';
					}
					break;
				case 'address':
				case 'message':
					echo '<input type="hidden" name="'.$k.'" id="'.$k.'" value="'.$prop.'"/>
							<div class="rows">
							<div class="col1">'.$array[$k].'</div>
							<div class="col2">'.$prop.'</div>
							
						   </div> <br class="clear" />';
				case 'textarea':
					foreach($prop as $i=>$sel){
						echo '<input type="hidden" name="textarea['.$i.']" value="'.$sel.'"/>
							<div class="rows">
							<div class="col1">'.$array[$k].'</div>
							<div class="col2">'.$sel.'</div>
							
						   </div> <br class="clear" />';
					}
					break;
				case 'captcha':
					break;
				case 'select':
					foreach($prop as $i=>$sel){
						echo '<input type="hidden" name="select['.$i.']" value="'.$sel.'"/>
							<div class="rows">
							<div class="col1">'.$array[$k].'</div>
							<div class="col2">'.$sel.'</div>
							
						   </div> <br class="clear" />';
					}
					break;
				case 'radio':
				case 'checkbox':
					foreach($prop as $i=>$sel){
						echo '<input type="hidden" name="'.$k.'['.$i.']" value="'.implode(',',$sel).'"/>
							<div class="rows">
							<div class="col1">'.$array[$k].'</div>
							<div class="col2">'.implode(',',$sel).'</div>
							
						   </div> <br class="clear" />';
					}
					break;
			}
		
		
		}
		
		if(isset($crm->properties['email']) && !isset($crm->properties['converted']))
		echo ' <p><input name="convert" id="convert" class="button button-primary button-large" value="Convert as User" type="submit" /></p>';
		else if($crm->properties['converted'] == 1) echo "<br class='clear' />Converted as User";
		
	}
	else echo "Leads are empty";
	?>
	</div>
	</form>
</div>
<style>
#form-leads{font-size:14px;}
.rows{width:90%; margin:10px;clear:both;float:left;}
.col1{float:left; width:40%;font-weight:bold;}
.col2{float:left; width:40%;}
.view{margin-left:30px;}
</style>