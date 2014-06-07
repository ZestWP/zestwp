<form id="email" action="<?php echo site_url().'?lead=1';?>" method="get">
<?php if(sizeof($form)>0){ 
echo '<input name="lead" value="1" type="hidden"/>';
echo '<input name="source" value="'.$source.'" type="hidden"/>';
foreach($form->properties as $k=>$v){
	switch($k){
		case 'fname':
		case 'lname':
		case 'email':
		case 'contact':
			echo ' <p>'.$v.' : <br><input type="text" name="'.$k.'" id="'.$k.'" value=""></p>';
			break;
		case 'textbox':
			foreach($v as $textbox)
				echo ' <p>'.$textbox.' : <br><input type="text" name="textbox[]" value=""></p>';
			break;
		case 'address':
		case 'message':
			echo ' <p>'.$v.' : <br><textarea rows=3 cols=15 name="'.$k.'"></textarea></p>';
			break;
		case 'textarea':
			echo ' <p>'.$v.' : <br><textarea rows=3 cols=15 name="'.$k.'[]"></textarea></p>';
			break;
		case 'captcha':
			echo ' <p>'.$v.' : <br><input type="text" name="'.$k.'" value=""></p>';
			break;
		case 'select':
			foreach($v as $i=>$sel){
				echo '<p>'.$sel.' : <br><select name="select['.$i.']"><option value="" selected="selected" disabled="disabled">--Select--</option>';
				$options = explode("\n", $form->properties['selectArray'.$i]);
				foreach($options as $opt){
					echo '<option value="'.$opt.'">'.$opt.'</option>';
				}
				echo '</select></p>';
			}
			break;
		case 'radio':
		case 'checkbox':
			foreach($v as $i=>$sel){
				echo '<p>'.$sel.' : <br>';
				$options = explode("\n", $form->properties['selectArray'.$i]);
				foreach($options as $opt){
					echo '<input type="'.$k.'" name="'.$k.'['.$i.'][]" value="'.$opt.'"/>'.$opt;
				}
				echo '</select></p>';
			}
			break;
	}

}
	echo '<p><input type="submit" value="Send" ></p>';
	
} ?>
</form>