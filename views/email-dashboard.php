<div class="wrap">
    <h2>
		<?php _e(_MENU_EMAIL); ?> 
	</h2>
	<?php if (!empty($emails)): ?>
		
	<p>Click Email to see performance</p>
	<div class="float width60">
	<table class="widefat lists float" cellspacing="0" id="all">
    <tbody>
        <?php foreach ($emails as $item){ ?>
		<?php $getList = unserialize($item->properties);?>
        <tr>
			<td id="<?php echo $item->id;?>"><a  class="editItem" href="javascript:void(0);"><?php echo $getList['title']; ?></a>
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
		<tr><td>Total Email sent : <?php echo $mails['total']; ?></td></tr>
		<tr><td>Failed Emails : <?php echo $mails['fail']; ?></td></tr>
		<tr><td>Received mails : <?php echo $rate['email']; ?></td></tr>
		<tr><td>Opened in Browser : <?php echo $rate['browser']; ?></td></tr>
		<tr><td></td></tr>
	</tbody>
    </table>
	</div>
    <?php else: ?>
    <p>No Emails available.</p>
    <?php endif; ?>

</div>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#all').delegate('.editItem', 'click', function(){
		$('#view').empty().html('<tr><td>Loading...</td></tr>').show();
		$id = $(this).parents('td').attr('id');
		$.get('<?php echo  zest_url();?>ajax/email-performance.php?id=' + $id, function(data){
			$('#view').html(data).show();;
			
		});
	});
	$('.editItem:first').click();
});
</script>