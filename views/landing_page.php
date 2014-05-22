<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?php _e(get_the_title($page->ID)) ?></title>
	<meta property="og:title" content="<?php _e(get_the_title($page->ID)) ?>">

</head>
<body>
<pre>
<?php



echo '<h2>'.get_the_title($page->ID).'</h2>';
echo the_content(); 

?>

</body>
</html>