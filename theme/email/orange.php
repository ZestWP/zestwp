<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NewsLetter 1</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
/* small desktop */
@media all and (max-width: 1200px) {

}

/* tablet */
@media all and (min-width: 1024px) and (max-width: 1150px) {
	.mainTable, .hrstyle, .bannerimg{width:100% !important;}
	.showDesktop{display:none !important}
	.disclaimer{background-color:#dedede; padding:30px 0px 30px 0px !important;}
	.desktopborder{border:0px !important;}
}
@media all and (max-width: 1024px) {
	.mainTable, .hrstyle, .bannerimg{width:100% !important;}
	.showDesktop{display:none !important}
	.disclaimer{background-color:#dedede;padding:30px 0px 30px 0px !important;}
	.desktopborder{border:0px !important;}
}

/* mobile phone */
@media all and (max-width: 768px) {
table{width:100% !important; float:left !important; padding:0px !important;}
.logo, .menuContainer{padding:10px 0px 5px 0px !important; text-align:center !important;}
.mailContent{ padding:20px !important;}
}
</style>
</head>

<body style="margin:0px; padding:0px;">
<table cellpadding="0" cellspacing="0" border="0" width="889" align="center" class="mainTable">
	<tr class="showDesktop">
    	<td align="left" valign="bottom" style="vertical-align:bottom; background:url(<?php echo zest_url();?>assets/images/tableHeader.png) center bottom no-repeat;">&nbsp;</td>
    </tr>
    <tr>
    	<td align="left" valign="top" class="desktopborder" style="background:url(<?php echo zest_url();?>assets/images/email_gradient.png) left top repeat-x; border:2px solid #f0c1a3; border-top:0px !important; padding:3px 5px 5px 5px;">
        	<table cellpadding="0" cellspacing="0" border="0" style="background-color:#ffffff; width:100%;" >
            	<tr class="showDesktop">
               		 <td align="left" valign="top" style="text-align:right;"><a href="#" style="color:#d5661c; font-family:segoe UI; font-size:14pt; text-decoration:none; opacity:0.6; padding:15px 10px 0px 0px;">www.zestwp.com</a></td>
                </tr>
				<tr>
                	<td align="left" valign="top" >
                    	<table cellpadding="0" cellspacing="0" border="0" width="30%" style="float:left;">
							<tr>
                            	<td align="left" valign	="top" class="logo" style="padding:20px 20px 20px 65px;">
									<?php if($logo) {?><img src="<?php echo site_url().'?logo=1'; ?>" width="200" height="100"><?php } ?>
                                </td>
                            </tr>
                        </table>

                    <hr style="background-color:#b2b2b2; height:1px; border:0px; width:745px; clear:both; margin:0px auto; margin-bottom:15px;" class="hrstyle" />
                    </td>
                </tr>

                <tr>
                	<td align="left" valign="top">
                    <table cellpadding="0" cellspacing="0" border="0">
                    	<tr>
                        	<td align="left" valign="top" class="mailContent" style="padding:20px 20px 20px 65px;font-family:segoe UI; font-size:12pt; color:#000000;">
							<?php echo ($content) ?>
							</td>
                        </tr>
                    </table>
                    
                    </td>
                </tr>
                <tr>
                	<td align="left" valign="top" style="text-align:center; color:#414141;padding:30px 0px 15px 0px;font-family:segoe UI; font-size:10pt;">
<hr style="background-color:#b2b2b2; height:1px; border:0px; width:745px; clear:both; margin:0px auto; margin-bottom:15px;" class="hrstyle" />
                    Copyright © 2014  zestwp.com<br>

All rights reserved and other such important stuff.


                    </td>
                </tr>
               
            </table>
        </td>
    <tr class="showDesktop">
    	<td align="left" valign="top" style="text-align:center; height:46px;"><img src="<?php echo zest_url();?>assets/images/tableFooter.png" alt="" /></td>
    </tr>
     <tr>
                	<td align="left" valign="top" style="text-align:center; color:#898888;padding:0px 0px 30px 0px;font-family:segoe UI; font-size:9pt;" class="disclaimer">
                    You're receiving this newsletter because you asked to receive updates.<br>
 <?php if($link) {?><a href="<?php echo site_url().'?mailer=1&id='.$id.'&q='.$link; ?>" target="_blank">Having trouble reading this email? View it in your browser. <br></a><?php } ?>
 Want to be taken off the list/Unsubscribe instantly.
                    </td>
                </tr>
</table>

</body>
</html>
