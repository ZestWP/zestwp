<!doctype html>
<html lang="en-us">
<head>
	<meta charset="utf-8">
	<title><?php _e($email->properties['title']) ?></title>
	<meta property="og:title" content="<?php _e($email->properties['title']) ?>">

</head>
<body>
<?php

include('email_template.php');
?>

</body>
</html>