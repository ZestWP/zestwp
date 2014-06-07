<div class="wrap">
    <h2><?php _e(_PLUGIN_NAME .' :: Import Users'); ?></h2>
    <br class="clear" />
		<form action="admin.php?page=<?php echo $_GET['page']; ?>" id="form-import" method="post" enctype="multipart/form-data">
		<input type="hidden" name="import" value="1" />
       
		<div id="poststuff" class="metabox-holder formDiv">
			 <div class="form-field width60">
				<label for="title"><?php _e('Upload CSV file to import Users');?></label>  <a href="<?php echo  zest_url().'/ajax/img.php?img='. zest_url().'assets/images/import.jpg';?>"  rel="lightbox" setDimension="520X120" >Sample format</a><br class="clear" />
				<input type="file" name="file" class="no-border" />
			</div><br class="clear" />
			
        </div>
        <p><input name="publish" id="publish" class="button button-primary button-large" value="Save List" type="submit" /></p>
		</form>

</div>
