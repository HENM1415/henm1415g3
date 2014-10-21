<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Welcome to AlmostPerfect, the social network of Aachen.</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
</head>
<body>

<div class="background"></div>
<div class="header">
    <div>Almost<span>Perfect</span></div>
</div>

<form class="user-form" action="<?php echo site_url('login'); ?>" method="post">

	<?php if (isset($wrong_password)): ?>
	<div style="color: #CC0000; ">Wrong username and/or password. Please try again.</div>
	<?php endif; ?>
    <input type="email" name="email" placeholder="email" />
    <input type="password" name="password" placeholder="password" />
    <input type="submit" name="submit" value="Login" />
    <input type="button" value="Register" onclick="location.href='<?php echo site_url('register'); ?>';"/>
</form>

</body>
</html>