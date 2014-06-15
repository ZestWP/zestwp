<?php wp_nonce_field('form-save','form-save-nonce'); ?>
<input type="hidden" name="object_type" value="<?php echo $type; ?>" />
<input type="hidden" name="object_id" value="<?php echo $id; ?>" />
<label for="form-page">
Select Page
</label>
<select name="page-type">
<option selected="selected" disabled="disabled">--Select page--</option>
<option value="track" <?php if($sel == 'track') echo 'selected="selected"';?>>Track only</option>
<option value="lead" <?php if($sel == 'lead') echo 'selected="selected"';?>>Lead Trackable</option>
</select>