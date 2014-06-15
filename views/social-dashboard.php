<div class="wrap">
    <h2>
		<?php _e(_MENU_SOCIAL_MEDIA); ?> 
	</h2>
	
	<?php if (!empty($pages->posts)): ?>
		
	<p>Click Page to see social shares</p>
	<div class="float width60">
	<table class="widefat lists float" cellspacing="0" id="all">
    <tbody>
        <?php foreach ( $pages->posts as $post ){ ?>
		
        <tr>
			<td id="<?php echo site_url().'?'._MENU_LANDINGPAGE_MENU.'='.$post->post_name;?>"><a  class="editCampaign" href="javascript:void(0);"><?php echo ($post->post_title); ?></a>
			<div class="row-actions">
				<span class="edit"><a  class="editCampaign"  href="javascript:void(0);"><?php _e('View Performance');?></a> </span>
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
    <p>No Landing page created.</p>
    <?php endif; ?>

</div>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#all').delegate('.editCampaign', 'click', function(){
		$('#view').empty().html('<tr><td>Loading...</td></tr>').show();
		$id = $(this).parents('td').attr('id');
		$.get('<?php echo  zest_url();?>ajax/page-share.php?id=' + $id, function(data){
			$('#view').html(data).show();;
			
		});
	});
	$('.editCampaign:first').click();
});
</script>