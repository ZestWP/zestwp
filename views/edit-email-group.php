<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: '._MENU_EMAIL_GROUP_TITLE); ?></h2>
    <br class="clear" />
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-campaign" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $id; ?>" />
       
		<div id="poststuff" class="metabox-holder formDiv">
		    <div class="form-field form-required width60">
				<label for="title"><?php _e('Enter Group name here');?></label>
				<input type="text" name="name" value="<?php echo $group->properties['name']; ?>" id="title" autocomplete="off" />
			</div><br class="clear" />
			
			 <div class="form-field width60">
				<label for="title"><?php _e('Upload CSV file to import Email address');?></label>  <a href="<?php echo  zest_url().'/ajax/img.php?img='. zest_url().'assets/images/sample_format.jpg';?>"  rel="lightbox" setDimension="520X120" >Sample format</a><br class="clear" />
				<input type="file" name="file" class="no-border" />
			</div><br class="clear" />
			<?php 
			$i = 1;
			if(sizeof($group->properties['email'])>0){
			$emails = array_filter($group->properties['email']);
			
			foreach($emails as $key=>$v){ 
				?>
			<div class="form-field toClone" id="<?php echo $i; ?>">
				<label><?php _e('First Name:'); ?></label>
				<input type="text" name="fname[]" class="width20imp inp" value="<?php echo $v['fname']; ?>" autocomplete="off" />
				<label><?php _e('Last Name:'); ?></label>
				<input type="text" name="lname[]" class="width20imp inp" value="<?php echo $v['lname']; ?>" autocomplete="off" />
				<label><?php _e('  Email:'); ?></label>
				<input type="text" name="email[]" class="width30imp inp" value="<?php echo $key; ?>" autocomplete="off" />
				<a href="javascript:void(0);" class="remove">Remove</a> | <a href="javascript:void(0);" class="add">Add</a><br class="clear" />
				<a href="javascript:void(0);" class="addCustom">Add Custom tag</a><br class="clear" />
				<?php
				if(isset($v['custom']) && sizeof($v['custom'])>0){
					$k = 1;
					foreach($v['custom'] as $field=>$fvalue){
						?>
						<div class="customClone" id="<?php echo $k; ?>">
							<label>{</label>
							<input type="text" class="width10imp dictName" name="cfield[<?php echo $i; ?>][<?php echo $k; ?>]" value="<?php echo $field; ?>" maxlength="8" autocomplete="off" />
							<label>} : </label>
							<input type="text" class="width20imp dict" name="cvalue[<?php echo $i; ?>][<?php echo $k; ?>]" value="<?php echo $fvalue; ?>" autocomplete="off" />
							<a href="javascript:void(0);" class="removeCustom">Remove</a> | <a href="javascript:void(0);" class="addCustom">Add Custom tag</a><br class="clear" />
						</div>
						
						<?php
						$k++;
					}
				}				
				?>
			</div>
			<?php 
			$i++;
			} }
			
			?>
			<div class="form-field toClone" id="<?php echo $i; ?>">
				<label><?php _e('First Name:'); ?></label>
				<input type="text" name="fname[]" class="width20imp inp" value="<?php echo $value; ?>" autocomplete="off" />
				<label><?php _e('Last Name:'); ?></label>
				<input type="text" name="lname[]" class="width20imp inp" value="<?php echo $value; ?>" autocomplete="off" />
				<label><?php _e('  Email:'); ?></label>
				<input type="text" name="email[]" class="width30imp inp" value="" autocomplete="off" />
				<a href="javascript:void(0);" class="remove">Remove</a> | <a href="javascript:void(0);" class="add">Add</a><br class="clear" />
				<a href="javascript:void(0);" class="addCustom">Add Custom tag</a><br class="clear" />
			</div>
        </div>
        <p><input name="publish" id="publish" class="button button-primary button-large" value="Save List" type="submit" /></p>
		</form>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('form').on('click', '.add', function(){
		$c = $(this).parents('.toClone').clone().appendTo( ".formDiv" );;
		$c.attr('id',$('.toClone').size());
		$c.find('input.inp').val('');
		$c.find('.dictName').each(function(){
			$n = ($(this).attr('name'));
			$a = $n.sreplace(7, ($n.indexOf("]")-7), $('.toClone').size());
			$(this).attr('name', $a);
		});
		$c.find('.dict').each(function(){
			$n = ($(this).attr('name'));
			$a = $n.sreplace(7, ($n.indexOf("]")-7), $('.toClone').size());
			$(this).attr('name', $a);
		});
	});
	$('form').on('click', '.remove', function(){
		$(this).parents('.toClone').remove();
	});
	//$('.toClone').addClass('alternate');
	$('form').on('click', '.addCustom', function(){
		$c = $(this).parents('.toClone');
		$i = parseInt($(this).parents('.toClone').attr('id')); //parent id
		$v = $('#customClone').clone().addClass('customClone').appendTo($c);
		
		$p = $c.find('.customClone').size() ;
		
		$v.find('.dictName').val('CTAG'+$p).attr({'name':'cfield['+$i+']['+$p+']', 'id':$p});
		$v.find('.dict').attr('name','cvalue['+$i+']['+$p+']');
	});
	$('form').on('click', '.removeCustom', function(){
		$(this).parents('.customClone').remove();
	});
});

String.prototype.sreplace = function(start, length, word) {
    return this.replace(
        new RegExp("^(.{" + start + "}).{" + length + "}"),
        "$1" + word);
};
</script>
</div>

<div style="display:none;">
<div id="customClone">
	<label>{</label>
	<input type="text" class="width10imp dictName" maxlength="8" autocomplete="off" />
	<label>} : </label>
	<input type="text" class="width20imp dict" autocomplete="off" />
	<a href="javascript:void(0);" class="removeCustom">Remove</a> | <a href="javascript:void(0);" class="addCustom">Add Custom tag</a><br class="clear" />
</div>
</div>