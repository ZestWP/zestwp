<div class="wrap">
    <h2>
		<?php _e($this->title); ?> 
	</h2>
	<?php if (!empty($campaigns)): ?>
		
	<p>Click campaign to see Campaign performance</p>
	<div class="float width60">
	<table class="widefat lists float" cellspacing="0" id="all">
    <tbody>
        <?php foreach ($campaigns as $item){ ?>
		<?php $getList = unserialize($item->properties);?>
        <tr>
			<td id="<?php echo $item->id;?>"><a  class="editCampaign" href="javascript:void(0);"><?php echo $getList['name']; ?></a>
			<div class="row-actions">
				<span class="editPer"><?php _e('View Performance');?></span>
			</div>
		</td>
        </tr>
    
        <?php } ?>
    </tbody>
    </table>
	</div>
    <div class="float width30 margin10imp">
	<table class="widefat float lists" cellspacing="0" id="view" style="display:none">
    
    </table>
	</div>
    <?php else: ?>
    <p>No Campaigns available.</p>
    <?php endif; ?>

</div>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#all').delegate('.editCampaign', 'click', function(){
		$id = $(this).parents('td').attr('id');
		if($('#'+$id).attr('rel') =='clicked') return false;
		$('#all td').removeAttr('rel').removeClass('hilight');
		$('#'+$id).attr('rel','clicked').addClass('hilight');
		$('#view').empty().html('<tr><td>Loading...</td></tr>').show();
		$id = $(this).parents('td').attr('id');
		$.get('<?php echo  zest_url();?>ajax/performance.php?id=' + $id, function(data){
			$('#view').html(data).show();;
			
		});
	});
	$('.editCampaign:first').click();
});
</script>