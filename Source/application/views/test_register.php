<html>
<head></head>
<body>
	

	<h1>Registration</h1>
	
	
	<form action="<?php echo site_url('register')?>" enctype="multipart/form-data" method="post">
	
		Email <input name="email" /><br />
		First <input name="first_name" /><br />
		Last  <input name="last_name" /><br />
		Password   <input type="password" name="password" /><br />
		Repeat    <input type="password" name="password_repeat" /><br />
		Date of birth     <input type="date" name="birthdate" /><br />
		      city <input name="city" /><br />
		    Country  <input name="country" /><br />
		 Gender     <select name="gender">
		      	<option value="f">Female</option>
		      	<option value="m">Male</option>
		      </select><br />
		Orientation      <select name="orientation">
		      	<option value="heterosexual">Heterosexual</option>
		      	<option value="bisexual">Bisexual</option>
		      	<option value="homosexual">Homosexual</option>
		      </select>
		      
		      
		      <br /><?php echo form_upload('userfile'); ?>
		      
		      <br /><br />
		      <?php echo form_submit('submit', 'Register!'); ?>
	</form>
	
</body>
</html>