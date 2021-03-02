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
	<?php if (!$_GET['v']=="createSchedule"): ?>
	<a href="admin.php?v=createSchedule">New Tutorial</a>
	<?php endif; ?>

	<a href="index.php">Student View</a>
	<?php if (isset($message)) {
		echo "<font color='red'>$message</font>";
	} ?>
</header>
