<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php _e(get_the_title($page->ID)) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?php echo zest_url().'assets/zest-style.css';?>" rel="stylesheet" type="text/css">
<?php if(!empty($static->properties['header'])) echo ($static->properties['header']); ?>
</head>

<body>
<div class="LandingContainer">
	<div class="Innerrow alignCenter around ">
    	<img src="<?php echo site_url().'?logo=1'; ?>" alt="zestWP"  style="max-width:100%;height:auto;" />
    </div>
    <div class="Innerrow primaryhding">
    	<?php _e(get_the_title($page->ID)) ?>
    </div>
    
     <div class="Innerrow bodycont">
     	<div class="innerContent ">
        	<?php if(sizeof($form)>0){ ?>     
			<form id="email" action="<?php echo site_url().'?lead=1';?>" method="get">
            <div class="ContentCol form">
            	<div class="LandingForm">
                	<?php include 'landing_form.php'; ?>
                </div>
                <div class="downloadbtn"><a href="#"><img src="<?php echo zest_url().'assets/images/send.png';?>" alt="zestWP" style="max-width:100%;height:auto;" /></a></div>
            </div>
			</form>
			<?php } ?>
            <div class="introContent">
            	
               <?php echo the_content(); ?>
                
                
            </div>
        </div>
     </div>

     
     <!-- footer Area -->
	
</div>
<?php if(!empty($static->properties['footer'])) echo ($static->properties['footer']); ?>
<?php if(!empty($static->properties['google'])) echo ($static->properties['google']); ?>
</body>
</html>
