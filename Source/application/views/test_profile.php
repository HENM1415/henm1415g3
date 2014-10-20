<html>
<head></head>
<body>
	

	<?php if ($user_id == $this->session->userdata('user_id')): ?>
		Hello, <?php echo $first_name; ?>!	
	<?php else: ?>
		Hi, I'm <?php echo $first_name; ?> <?php echo $last_name; ?>
	<?php endif; ?>
	
	<?php var_dump($data); ?>
	
</body>
</html>