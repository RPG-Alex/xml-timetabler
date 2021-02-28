<!DOCTYPE html>
<html>
	<head>
		<title>
			<?php echo $title; ?>
		</title>
		<link rel="stylesheet" href="style/bootstrap.css">
	</head>
<body>
	<header>
		<a href="index.php" class="">Home</a>
		<?php if (isset($message)) {
			echo "<font color='red'>$message</font>";
		} ?>
	</header>
