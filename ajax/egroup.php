<?php
require_once("../../../../wp-config.php");
require_once("../core/constants.php");

$get = $_GET;
if(isset($get) && sizeof($get)>0){
	$cl = $get['cl'];
	$fname = array_pop($get['fname']);
	$lname = array_pop($get['lname']);
	$email = array_pop($get['email']);
	if(isset($get['cfield'])){
		$cfield = array_pop($get['cfield']);
		$cvalue = array_pop($get['cvalue']);
	}
	
}
?>


<div class="width90">
    <h1>Add recipient</h1>
	<form action="javascript:void(0);" id="form-recipient" method="post">
		<?php if($cl > 0 ) echo '<input type="hidden" name="cl" value="'.$cl.'"/>'; ?>
	    <div class="form-field form-required">
			<label for="title" class="float width30imp">First name</label>
			<input type="text" name="fname" size="30" class="float width60imp" tabindex="1" value="<?php echo $fname ; ?>" id="title" autocomplete="off" />
		</div><br class="clear t-margin"/>
		
		<div class="form-field form-required">
			<label for="title" class="float width30imp">Last name</label>
			<input type="text" name="lname"  class="float width60imp" size="30" tabindex="1" value="<?php echo $lname ; ?>" id="title" autocomplete="off" />
		</div><br class="clear t-margin"/>
		
		<div class="form-field form-required">
			<label for="title" class="float width30imp">Email address</label>
			<input type="text" name="email" class="float width60imp" size="30" tabindex="1" value="<?php echo $email ; ?>" id="title" autocomplete="off" />
		</div><br class="clear t-margin"/>
		<div id="adder">
		<?php 
			if(isset($cfield)){?>
				<br class="clear"/>
				<div class="form-field form-required">
					<div class="width30imp float"><b>Custom Tag name</b></div>
					<div class="width40imp float"><b>Value</b></div>
				</div>
				<?php
				 foreach($cfield as $i=>$k){ ?>
					
					<div class="remover"><br class="clear"/>
						<span class="float width30imp">{<input type="text" class="width70imp" name="cfield[<?php echo $i; ?>]" value="<?php echo $k; ?>" maxlength="8" autocomplete="off" />} : </span>
						<input type="text" class="width30imp float" name="cvalue[<?php echo $i; ?>]" value="<?php echo $cvalue[$i]; ?>" autocomplete="off" />
						<span class="remove margin10imp width10imp float"><img src="<?php echo __ZEST_URL;?>assets/images/remove.png"/></span>
					</div>
				
				<?php }
			}
		?>
		</div>
		<br class="clear"/>
	<p><input name="add" id="add" class="button button-primary button-large" value="Add Custom tag" type="button" /></p>
	<p><input name="publish" id="publish" class="button button-primary button-large" value="Update" type="submit" /></p>

	</form>
</div>

<script type="text/javascript">
jQuery(document).ready( function($) {
	var cl = '<?php echo $cl; ?>';
	$('#form-recipient').delegate('.remove', 'click', function(){
		if(confirm('You are sure  to delete')){
			$(this).parents('.remover').remove();
		}	
	}).delegate('#add', 'click', function(){ 
		$h = $('#none').html();
		$('#adder').append($h);
	});
	
	$('#form-recipient').submit(function(){ 
		$ser = $(this).serialize();
		$.post('<?php echo __ZEST_URL;?>ajax/egroup-save.php',$ser, function(data){
			if(cl>0){
				$('#cl'+cl).html(data);			
			}
			else $('#all').append('<tr>'+data+'</tr>');
			$('.close').click();
			$('.lists tbody tr:odd').removeClass('alternate');
			$('.lists tbody tr:even').addClass('alternate');
		});
	});;
	
	
});
</script>
<div style="display:none;" id="none">
	<div class="remover"><br class="clear"/>
		<span class="float width30imp">{<input type="text" class="width70imp" name="af[]" value="" maxlength="8" autocomplete="off" />} : </span>
		<input type="text" class="width30imp float" name="av[]" value="" autocomplete="off" />
		<span class="remove margin10imp width10imp float"><img src="<?php echo __ZEST_URL;?>assets/images/remove.png"/></span>
	</div>

</div>