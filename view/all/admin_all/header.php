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
	<a href="admin.php">Home</a>
	<a href="admin.php?v=createSchedule">New Tutorial</a>
	<?php if (isset($message)) {
		echo "<font color='red'>$message</font>";
	} ?>
</header>
