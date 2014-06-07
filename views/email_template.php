<table width=700 cellpadding=0 cellspacing=0 border=0 style="margin:0px auto; width:700px;margin-top:20px;border:1px solid #333;font-family:Georgia, 'Times New Roman', 'Bitstream Charter', Times, serif;font-size:14px;">
<?php if($link) {?><tr><td height=20 style="font-family:Georgia;font-size:9px;" align=center colspan=2><a href="<?php echo site_url().'?mailer=1&id='.$id.'&q='.$link; ?>" target="_blank">view message in browser</a></td></tr><?php } ?>
<?php if($logo) {?><tr><td><img src="<?php echo site_url().'?logo=1'; ?>" width="200" height="100"></td></tr><?php } ?>
<tr>
	<td width=480 valign=top style="padding:20px;word-wrap:break-word;font-family:Georgia">
		<?php echo ($content) ?>
	</td>
	<td>
	<table>
	<tr>
		<td>
		<?php if(sizeof($form)>0) include 'email_form.php'; ?>
		
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<?php if($track) {?><img src="<?php echo site_url().'?track=1&q='.$link; ?>" width="1" height="1"><?php } ?>
