<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php _e(get_the_title($page->ID)) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo zest_url().'assets/style.css'; ?>"/>
</head>
<body>
<!-- Header Area -->
<div class="LandingContainer header">
  <div class="LandingInner">
    <div class="logo"><img src="<?php echo site_url().'?logo=1'; ?>" alt="zestWP" /></div>
    <div class="TopMenu">
      <ul id="menu">
	  
	  
        <li id="facebook"><a title="Share with Facebook"  target="_new" onclick="var sTop = window.screen.height/2-(218); var sLeft = window.screen.width/2-(313);window.open(this.href,'sharer','toolbar=0,status=0,width=626,height=256,top='+sTop+',left='+sLeft);return false;" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo site_url().'?'.$page->post_type.'='.$page->post_name; ?>">facebook</a></li>
        <li id="twitter"><a title="Tweet" class="twitter_static" onclick="var stTop = window.screen.height/2-(218); var stLeft = window.screen.width/2-(313);window.open(this.href,'twitter_sharer','toolbar=0,status=0,width=560,height=400,top='+stTop+',left='+stLeft);return false;" href="http://twitter.com/share?tw_p=tweetbutton&amp;url=<?php echo site_url().'?'.$page->post_type.'='.$page->post_name; ?>&amp;via=ZestWP&amp;text=<?php _e(get_the_title($page->ID)) ?>&amp;original_referer=<?php echo site_url().'?'.$page->post_type.'='.$page->post_name; ?>">twitter
			</a>
        <li id="linkedin"><a title="Share with Linkedin"  target="_new" onclick="var stTop = window.screen.height/2-(218); var stLeft = window.screen.width/2-(313);window.open(this.href,'twitter_sharer','toolbar=0,status=0,width=560,height=400,top='+stTop+',left='+stLeft);return false;" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo site_url().'?'.$page->post_type.'='.$page->post_name; ?>&source=ZestWP">linkedin</a></li>
		<br class="clear">
		
    </ul>
    </div>
  </div>
</div>
<!-- Banner Area -->
<div class="LandingContainer banner">
  <div class="LandingInner">
     <div class="Innerrow bannerimg"><h2 class="MainHeading"><?php _e(get_the_title($page->ID)) ?></h2>
           <div class="content"><?php echo the_content(); ?></div></div>
  </div>
</div>
<!-- Slogan Area -->
<?php //include 'email_form.php';?>
<!-- footer Area -->
<div class="LandingContainer footer">
  <div class="LandingInner">
  	<div class="Innerrow">ZestWP © 2014. All Rights Reserved</div>
  </div>
</div>
</body>
</html>
