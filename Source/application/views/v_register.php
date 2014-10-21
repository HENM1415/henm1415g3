<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="UTF-8">
<title>Register at AlmostPerfect</title>
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('css/style.css'); ?>">
</head>
<body>
	<div class="background"></div>

	<div class="header">
		<div>
			Almost<span>Perfect</span>
		</div>
	</div>

	<form class="register-form"
		action="<?php echo site_url('register'); ?>" method="post">
		<div style="color: #CC0000;">
			<?php echo validation_errors(); ?>
		</div>

		<input name="first_name" type="text" placeholder="First name" required
			value="<?php echo $this->input->post('first_name'); ?>" /> <input
			name="last_name" type="text" placeholder="Last name" required
			value="<?php echo $this->input->post('last_name'); ?>" /> <input
			name="email" type="email" placeholder="Email" required
			value="<?php echo $this->input->post('email'); ?>" /> <input
			name="birthdate" placeholder="Date of Birth" type="text"
			onfocus="(this.type='date')"
			value="<?php echo $this->input->post('birthdate'); ?>" /> <input
			name="password" type="password" placeholder="Password" required /> <input
			name="password_repeat" placeholder="Retype password" type="password"
			required /> <input name="city" type="text" placeholder="City"
			value="<?php echo $this->input->post('city'); ?>" required /> <input
			name="country" type="text" placeholder="Country"
			value="<?php echo $this->input->post('country'); ?>" required /> <br>

		<div id="pictureWrap">
			<span>Picture</span> <input name="picture" type="file"
				class="picture-input" />
		</div>
		<br> <input class="css-checkbox" type="radio" name="sex" id="male"
			value="male" checked="checked"> <label class="css-label" for="male">Male</label>

		<br /> <input class="css-checkbox" type="radio" class="css-checkbox"
			name="sex" id="female" value="female"> <label class="css-label"
			for="female">Female</label>
		
		<div>
		My orientation is:<br />
		<input type="radio" name="orientation" value="heterosexual" id="heterosexual" checked="checked"> <label class="css-label" for="heterosexual">Heterosexual</label><br />
		<input type="radio" name="orientation" value="homosexual" id="homosexual"> <label class="css-label" for="homosexual">Homosexual</label><br />
		<input type="radio" name="orientation" value="bisexual" id="bisexual"> <label class="css-label" for="bisexual">Bisexual</label><br />
		
		</div>	
			
		<br> <input id="submit" name="submit_registration"
			type="submit" value="Submit" />
	</form>
</body>
</html>
