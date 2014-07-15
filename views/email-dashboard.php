<div class="wrap">
    <h2>
		<?php _e($this->title); ?> 
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
				<span class="editPer"><?php _e('View Performance');?></span>
			</div>
		</td>
        </tr>
    
        <?php } ?>
    </tbody>
    </table>
	</div>
    <div class="float width30 margin10imp">
	<table class="widefat float lists" cellspacing="0" id="view">
	<thead>
		<tr><th colspan=2>Overall performance</th></tr>
	</thead>
	
	
	<tbody>
		<tr><td>Emails sent </td><td>:<b> <?php echo $mails['total']; ?></b></td></tr>
		<tr><td>Email Bounces </td><td>:<b> <?php echo $mails['fail']; ?></b></td></tr>
		<tr><td>Email Open Rate </td><td>:<b> <?php echo $rate['email']; ?></b></td></tr>
		<tr><td>Email Click Rate </td><td>:<b> <?php echo $rate['browser']; ?></b></td></tr>
	</tbody>
    </table>
	</div>
    <?php else: ?>
    <p>No Emails available.</p>
    <?php endif; ?>

</div>
<style>
.row-actions{color:#BBB;}
#view td{width:50%;}
</style>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#all').delegate('.editItem', 'click', function(){
		
		$id = $(this).parents('td').attr('id');
		if($('#'+$id).attr('rel') =='clicked') return false;
		$('#all td').removeAttr('rel').removeClass('hilight');
		$('#'+$id).attr('rel','clicked').addClass('hilight');

		
		$('#view').empty().html('<tr><td>Loading...</td></tr>').show();
		$.get('<?php echo  zest_url();?>ajax/email-performance.php?id=' + $id, function(data){
			$('#view').html(data).show();;
			
		});
	});
	//$('.editItem:first').click();
});
</script>