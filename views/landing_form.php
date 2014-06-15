<?php if(sizeof($form)>0){ 
echo '<input name="lead" value="1" type="hidden"/>';
echo '<input name="source" value="'.$source.'" type="hidden"/>';
echo '<input name="form" value="'.$form->id.'" type="hidden"/>';
if(!empty($campaigns[0]['campaign']) && sizeof($campaigns[0]['campaign'])>0)
foreach($campaigns[0]['campaign'] as $c) echo '<input name="campaign[]" value="'.$c.'" type="hidden"/>';
if($campaign) echo '<input name="campaign[]" value="'.$campaign.'" type="hidden"/>';
foreach($form->properties as $k=>$v){
	switch($k){
		case 'fname':
		case 'lname':
		case 'email':
		case 'contact':
			echo ' <div class="ctrlrow">
                        <div class="label">
                        	'.$v.'
                        </div>
                        <div class="controls">
                        	<input type="text" name="'.$k.'" id="'.$k.'" value="">
                        </div>
                    </div>';
			break;
		case 'textbox':
			foreach($v as $textbox)
				echo '<div class="ctrlrow">
                        <div class="label">
                        	'.$textbox.'
                        </div>
                        <div class="controls">
                        	<input type="text" name="'.$textbox.'[]" value="">
                        </div>
                    </div>';
			break;
		case 'address':
		case 'message':
			echo ' <div class="ctrlrow">
                        <div class="label">
                        	'.$v.'
                        </div>
                        <div class="controls">
                        	<textarea rows=3 cols=15 name="'.$k.'"></textarea>
                        </div>
                    </div>';
			break;
		case 'textarea':
			echo '<div class="ctrlrow">
                        <div class="label">
                        	'.$v.'
                        </div>
                        <div class="controls">
                        	<textarea rows=3 cols=15 name="'.$k.'[]"></textarea>
                        </div>
                    </div> ';
			break;
		case 'captcha':
			//echo ' <p>'.$v.' : <br><input type="text" name="'.$k.'" value=""></p>';
			break;
		case 'select':
			foreach($v as $i=>$sel){
				echo '<div class="ctrlrow">
                        <div class="label">
                        	'.$sel.'
                        </div>
                        <div class="controls">
                        	<select name="select['.$i.']"><option value="" selected="selected" disabled="disabled">--Select--</option>';
							$options = explode("\n", $form->properties['selectArray'.$i]);
							foreach($options as $opt){
								echo '<option value="'.$opt.'">'.$opt.'</option>';
							}
							echo '</select>
                        </div>
                    </div>';
			}
			break;
		case 'radio':
		case 'checkbox':
			foreach($v as $i=>$sel){
				echo '<div class="ctrlrow">
                        <div class="label">
                        	'.$sel.'
                        </div>
                        <div class="controls">
                        	<textarea rows=3 cols=15 name="'.$k.'"></textarea>
                        </div>
                    </div>';
					$options = explode("\n", $form->properties['selectArray'.$i]);
					foreach($options as $opt){
						echo '<input type="'.$k.'" name="'.$k.'['.$i.'][]" value="'.$opt.'"/>'.$opt;
					}
			}
			break;
	}

}
	
} ?>
