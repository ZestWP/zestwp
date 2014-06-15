<div class="wrap">
    <h2>
		<?php _e(_MENU_FORM); ?> 
	</h2>
	<?php if (!empty($forms)): ?>
		
	<p>Click Form to see performance</p>
	<div class="float width60">
	<table class="widefat lists float" cellspacing="0" id="all">
    <tbody>
		<?php if (!empty($default)){
				$getList = unserialize($default[0]->properties);		
		?>
		<tr>
			<td id="<?php echo $default[0]->id;?>"><a  class="editItem" href="javascript:void(0);"><?php echo $getList['name']; ?></a> | Default
			<div class="row-actions">
				<span class="edit"><a  class="editItem"  href="javascript:void(0);"><?php _e('View Performance');?></a> </span>
			</div>
		</td>
		<?php
		}
         foreach ($forms as $item){ ?>
		<?php $getList = unserialize($item->properties);?>
        <tr>
			<td id="<?php echo $item->id;?>"><a  class="editItem" href="javascript:void(0);"><?php echo $getList['name']; ?></a>
			<div class="row-actions">
				<span class="edit"><a  class="editItem"  href="javascript:void(0);"><?php _e('View Performance');?></a> </span>
			</div>
		</td>
        </tr>
    
        <?php } ?>
    </tbody>
    </table>
	</div>
    <div class="float width30 margin10imp">
	<table class="widefat float lists" cellspacing="0" id="view">
	<tbody>
		<?php if (sizeof($default)>0){
			$default = unserialize($default[0]->properties);
			?>
		<tr><td>Default form : <?php echo $default['name']; ?></td></tr>
		<?php } else echo '<tr><td>No Default Form</td></tr>'; ?>
	</tbody>
    </table>
	</div>
    <?php else: ?>
    <p>No Forms available.</p>
    <?php endif; ?>

</div>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#all').delegate('.editItem', 'click', function(){
		$('#view').empty().html('<tr><td>Loading...</td></tr>').show();
		$id = $(this).parents('td').attr('id');
		$.get('<?php echo  zest_url();?>ajax/form-performance.php?id=' + $id, function(data){
			$('#view').html(data).show();;
			
		});
	});
});
</script>