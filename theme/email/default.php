<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style type="text/css">
/* small desktop */
@media all and (min-width: 1025px) {
.desktop{width:800px !important;}
}

/* tablet */
@media all and (min-width: 1024px) and (max-width: 1150px) {
.desktop{width:100% !important;margin-top:0px !important;}
.paddingAround{padding:0px 15px 0px 15px;}
}
@media all and (max-width: 1024px) {
.desktop{width:100% !important; margin-top:0px !important;}
.paddingAround{padding-left:25px !important;padding-right:25px !important;}
.menuContainer{float:left !important; padding:10px 10px 0px 25px !important; text-align:left !important;}
}

/* mobile phone */
@media all and (max-width: 768px) {
table{width:100% !important; float:left !important; padding:0px !important;}
.headerClass{font-size:20pt !important;}
.mobilelogofr{text-align:center !important; padding:10px 10px 10px 10px !important;}
}
</style>
</head>

<body style="margin:0px; padding:0px; background-color:#dedede;">
	<table cellpadding="0" cellspacing="0" align="center" border="0" style="width:80%; margin-top:30px;background-color:#ffffff; border:1px solid #bfbfbf;font-family:segoe UI; font-size:11pt; padding:10px 20px 10px 0px; color:#363535;" class="desktop">

        <tr>
        	<td align="left" valign="top" style="padding:0px 25px 0px 25px;">

            <?php echo ($content) ?>
            </td>
        </tr>
        <tr>
        <td align="left" valign="top">
        </td>
        </tr>
        
        <tr>
                	<td align="left" valign="top" style="text-align:center; color:#414141;padding:10px 0px 15px 0px;font-family:segoe UI; font-size:10pt;">

                    Copyright © 2014  zestwp.com<br>

All rights reserved and other such important stuff.


                    </td>
                </tr>
    </table> 
    <table cellpadding="0" cellspacing="0" border="0" style="width:80%;" align="center" class="desktop">
    	<tr>
        	<td align="left" valign="top">
            	
    <table cellpadding="0" cellspacing="0" border="0" style="width:35%; float:right;">
    	<tr>
        	<td align="right" valign="top" style="padding:10px;" class="paddingAround mobilelogofr">
            	<?php if($logo) {?><tr><td><img src="<?php echo site_url().'?logo=1'; ?>" width="200" height="100"></td></tr><?php } ?>
            </td>
        </tr>
        
    </table><table cellpadding="0" cellspacing="0" border="0" style="width:60%; float:left">
    	<tr>
        	<td align="left" valign="top" style="color:#898888;padding:45px 0px 30px 0px;font-family:segoe UI; font-size:9pt;" class="paddingAround mobilelogofr">
            	You're receiving this newsletter because you asked to receive updates.<br>
 <?php if($link) {?><a href="<?php echo site_url().'?mailer=1&id='.$id.'&q='.$link; ?>" target="_blank">Having trouble reading this email? View it in your browser. <br></a><?php } ?>
            </td>
        </tr>
        
    </table>
            </td>
        </tr>
        
    </table>
    

</body>
</html>
