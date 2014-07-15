<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>NewsLetter 1</title>
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
.repeatContainer{width:100% !important;}
.repeatContainer span{padding-left:30px !important;}
.showdesktop{display:none;}
}
@media all and (max-width: 1024px) {
.desktop{width:100% !important; margin-top:0px !important;}
.paddingAround{padding-left:25px !important;padding-right:25px !important;}
.menuContainer{float:left !important; padding:10px 10px 0px 25px !important; text-align:left !important;}
.repeatContainer{width:100% !important;}
.repeatContainer span{padding-left:30px !important;}
.showdesktop{display:none;}
}

/* mobile phone */
@media all and (max-width: 768px) {
table{width:100% !important; float:left !important; padding:0px !important;}
.headerClass{font-size:20pt !important;}
.mobilelogofr{text-align:left !important;  padding:10px 10px 10px 20px !important;}
.OrangeLogo{padding-left:0px !important; width:184px !important;}
.topMenu{width:50% !important;  float:right !important; padding:15px !important;}
.topMenu li a{padding-left:0px !important;}
.dateTime{padding-right:20px !important;}

}
</style>
</head>

<body style="margin:0px; padding:0px; background-color:#dedede;">
	<table cellpadding="0" cellspacing="0" align="center" border="0" style="width:80%; margin-top:30px;background-color:#ffffff; border:1px solid #d5d5d5; border-top:11px solid #8c8c8c;" class="desktop">
    	<tr>
        	<td align="left" valign="top" style="border-bottom:1px solid #ff6920; ">

                <table cellpadding="0" cellspacing="0" border="0" width="240" class="OrangeLogo" style="float:left; padding-left:40px;">
							<tr>
                            	<td align="left" valign	="top"  style="padding:15px 10px 0px 40px; ">
                                	<?php if($logo) {?><tr><td><img src="<?php echo site_url().'?logo=1'; ?>" width="200" height="100"></td></tr><?php } ?>
                                </td>
                            </tr>
                        </table>
                        
                       
            </td>
        </tr>
        <tr>
        	<td align="left" valign="top" style="padding:0px 25px 0px 25px;">
            	
                
                <table cellpadding="0" cellspacing="0" border="0" align="center" style="width:92%; ">
                	<tr>
                    	<td align="left" valign="top" style="font-family:segoe UI; font-size:11pt; padding:30px 20px 10px 0px; color:#363535;">
                        	<?php echo ($content) ?>
                        </td>
                    </tr>
                </table>
            
            </td>
        </tr>
        <tr>
        </tr>

    </table> 
    <table cellpadding="0" cellspacing="0" border="0" style="width:80%; background-color:#6b6b6b; margin-bottom:50px;" align="center" class="desktop">
    	<tr>
        	<td align="left" valign="top">
<table cellpadding="0" cellspacing="0" border="0" style="width:60%; float:left">
    <tr>
    <td align="left" valign="top" style="color:#ffffff; color:#ffffff; padding:20px 0px 0px 20px;font-family:segoe UI; font-size:9pt;">
    	 Copyright © 2014  zestwp.com<br>
All rights reserved and other such important stuff.
    </td>
    </tr>
    	<tr>
        	<td align="left" valign="top" style="color:#b1b1b1;padding:20px 0px 30px 20px;font-family:segoe UI; font-size:9pt;" class="paddingAround mobilelogofr">
            	You're receiving this newsletter because you asked to receive updates.<br>
				 <?php if($link) {?><a href="<?php echo site_url().'?mailer=1&id='.$id.'&q='.$link; ?>" target="_blank">Having trouble reading this email? View it in your browser. <br></a><?php } ?>
Want to be taken off the list/Unsubscribe instantly.
            </td>
        </tr>
        
    </table>
            </td>
        </tr>
        
    </table>
    

</body>
</html>
