<?php if (isset($campaigns) && !empty($campaigns)): ?>
<?php wp_nonce_field('campaign-save','campaign-save-nonce'); ?>
<input type="hidden" name="object_type" value="<?php echo $type; ?>" />
<input type="hidden" name="object_id" value="<?php echo $id; ?>" />
<?php foreach ($campaigns as $campaign){
		$campaign->properties = unserialize($campaign->properties);
	?>
<div><label><input type="checkbox" name="campaigns[]"<?php if(in_array( $campaign->id, $sel)) echo 'checked="checked"'; ?> value="<?php echo $campaign->id; ?>"/> <?php echo $campaign->properties['name']; ?></label>
</div>
<?php }

 else: ?>
<p>No campaigns have been created.</p>
<?php endif; ?>
