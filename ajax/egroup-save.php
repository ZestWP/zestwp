
<?php
$post = ($_POST);
if(isset($post['email'])) $email = $post['email'];
?>
<td><?php echo $email; ?></td>
<td><?php echo $post['fname']; ?></td>
<td><?php echo $post['lname']; ?></td>
<td>
<div class="set_values">
<span><a href="javasript:void(0);" class="editItem">Edit</a></span> |
<span><a href="javasript:void(0);" class="trashItem">Delete</a></span>

<?php
if(isset($post['cl']))
	echo '<input type="hidden" name="cl" value="'.$post['cl'].'"/>';

if(isset($post['fname']))
	echo '<input type="hidden" name="fname['.$email.']" value="'.$post['fname'].'"/>';

if(isset($post['lname']))
	echo '<input type="hidden" name="lname['.$email.']" value="'.$post['lname'].'"/>';

if(isset($post['email']))
	echo '<input type="hidden" name="email['.$email.']" value="'.$post['email'].'"/>';

if(isset($post['cfield'])){
	for($i = 1;$i <= sizeof($post['cfield']);$i++){
		echo  '<input type="hidden" name="cfield['.$email.']['.$i.']" value="'.$post['cfield'][$i].'"/>';
		echo  '<input type="hidden" name="cvalue['.$email.']['.$i.']" value="'.$post['cvalue'][$i].'"/>';
	}
}


if(isset($post['af'])){
	$i = isset($post['cfield']) ? sizeof($post['cfield'])+1 : 1;
	for($j = 0;$j < sizeof($post['af']);$j++,$i++){
		echo  '<input type="hidden" name="cfield['.$email.']['.$i.']" value="'.$post['af'][$j].'"/>';
		echo  '<input type="hidden" name="cvalue['.$email.']['.$i.']" value="'.$post['av'][$j].'"/>';
	}
}
?>
</div>
</td>
