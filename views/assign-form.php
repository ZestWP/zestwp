<?php if (isset($forms) && !empty($forms)): ?>
<?php wp_nonce_field('form-save','form-save-nonce'); ?>
<input type="hidden" name="object_type" value="<?php echo $type; ?>" />
<input type="hidden" name="object_id" value="<?php echo $id; ?>" />
<label for="form-page">
Select form
</label>
<select name="form-page">
<option selected="selected" disabled="disabled">--Select form--</option>
<?php foreach ($forms as $form){
		$form->properties = unserialize($form->properties);
		$s = (($form->id == $sel))? ' selected="selected"' : '';
		echo '<option value="'.$form->id.'"'.$s.'>'.$form->properties['name'].'</option>';
	}
	echo '</select>';
 else: ?>
<p>No Forms have been created.</p>
<?php endif; ?>
