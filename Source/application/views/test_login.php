<html>
<head></head>
<body>
	
	<?php if (isset($wrong_password)): ?>
	Wrong username and/or password. Please try again.<br /><br />
	<?php endif; ?>
	
	Please login:
	
	<form action="<?php echo site_url('login'); ?>" method="post">
	
		User: <input type="text" name="email" />
		<br />Pass: <input type="password" name="password" />
		<br /><input type="submit" name="submit" />
	
	</form>
	
</body>
</html>