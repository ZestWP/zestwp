<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '.$this->title); ?></h2>
    <br class="clear" />
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-campaign" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
       
		<div id="poststuff" class="metabox-holder formDiv">
		    <div class="form-field form-required width60">
				<label for="title"><?php _e('Enter Email list name here');?></label>
				<input type="text" name="name" value="<?php echo $group->properties['name']; ?>" id="title" autocomplete="off" />
				<span class="description"><br>This is the title for your reference. Customers will not see this.</span>
			</div><br class="clear" />
			
			<p><input name="publish" id="publish" class="button button-primary button-large float" value="Save <?php _e($this->title)?>" type="submit" /></p>
			<p class="search-box r-btn"><a href="javascript:void(0)" class="addItem zest-button"><?php _e('Create New recipient');?></a></p>
			<table class="wp-list-table widefat fixed lists" cellspacing="0" style="table-layout:fixed;" id="all">
				<thead>
					<tr>
						<th scope="col" class="width40"><?php _e('Email');?></th>
						<th scope="col" class="width15"><?php _e('First name');?></th>
						<th scope="col" class="width15"><?php _e('Last name');?></th>
						<th scope="col" class="width20"><?php _e('Action');?></th>
					</tr>
				</thead>
				
				<tfoot>
					<tr>
						<th><?php _e('Email');?></th>
						<th><?php _e('First name');?></th>
						<th><?php _e('Last name');?></th>
						<th><?php _e('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
			
			<?php 
			$i = 1;
			if(sizeof($group->properties['email'])>0){
			$emails = array_filter($group->properties['email']);
			
			foreach($emails as $key=>$v){ 
				?>
				
				<tr id="cl<?php echo $i;?>">
					<td><?php echo $key; ?></td>
					<td><?php echo $v['fname']; ?></td>
					<td><?php echo $v['lname']; ?></td>
					<td>
					<div class="set_values">
					<span><a href="javasript:void(0);" class="editItem">Edit</a></span> |
					<span><a href="javasript:void(0);" class="trashItem">Delete</a></span>
						
						<input type="hidden" name="cl" value="<?php echo $i; ?>"/>
						<input type="hidden" name="fname[<?php echo $key; ?>]" value="<?php echo $v['fname']; ?>" autocomplete="off" />
						<input type="hidden" name="lname[<?php echo $key; ?>]" value="<?php echo $v['lname']; ?>" autocomplete="off" />
						<input type="hidden" name="email[<?php echo $key; ?>]" value="<?php echo $key; ?>" autocomplete="off" />
						<?php
							if(isset($v['custom']) && sizeof($v['custom'])>0){
								$k = 1;
							foreach($v['custom'] as $field=>$fvalue){
								?>
									<input type="hidden" name="cfield[<?php echo $i; ?>][<?php echo $k; ?>]" value="<?php echo $field; ?>" maxlength="8"/>
									<input type="hidden" name="cvalue[<?php echo $i; ?>][<?php echo $k; ?>]" value="<?php echo $fvalue; ?>" />
								<?php
								$k++;
							}
							}
							?>
						</div>
					</td>
				</tr>

			<?php 
			$i++;
			} }
			
			?>
			</tbody>
			</table>
			<p class="search-box t-btn"><a href="javascript:void(0)" class="addItem zest-button"><?php _e('Create New recipient');?></a></p>
        </div>
		
		<br class="clear" />
		 <div class="form-field width60">
				<label for="title"><?php _e('Upload CSV file to import Email address');?></label>  <a href="<?php echo  zest_url().'/ajax/img.php?img='. zest_url().'assets/images/sample_format.jpg';?>"  rel="lightbox" setDimension="520X120" >Sample format</a><br class="clear" />
				<input type="file" name="file" class="no-border" />
			</div>
		
        <p><input name="publish" id="publish" class="button button-primary button-large" value="Save <?php _e($this->title)?>" type="submit" /></p>
		</form>
		<div style="display:none;"><a id="create" rel="lightbox" setDimension="600X400">true</a></div>
</div>

<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#all').delegate('.trashItem', 'click', function(){
		if(confirm('You are sure  to delete')){
			$(this).parents('tr').remove();
		}	
	});
	
	$('.wrap').delegate('.editItem', 'click', function(){
		var h = "<?php echo zest_url().'ajax/egroup.php';?>";
		$tr = $(this).parents('.set_values');
		var s = new Array();
		$tr.find('input').each(function(){
			$n = $(this).attr('name')+'='+$(this).val();
			s.push($n);
		});
		$ser = s.join('&');
		$('#create').attr('href', h+'?'+$ser);
		$('#create').click();
		return false;
	});
	
	$('.wrap').delegate('.addItem', 'click', function(){
		var h = "<?php echo zest_url().'ajax/egroup.php';?>";
		$('#create').attr('href', h);
		$('#create').click();
		return false;
	});
	
});
</script>


</div>

