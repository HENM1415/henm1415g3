<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Edit Profile - AlmostPerfect</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
</head>
<body>
<div class="background"></div>

<div class="header">
    <div>Almost<span>Perfect</span>
    
     
    
    </div>
   
    <?php if ($filename): ?>
    <img id="user-pic" src="<?php echo base_url('user_pictures/thumb_'.$filename); ?>" />
    <?php endif; ?>
</div>

<form class="profile-form">
    <span class="header-text" name="first_name"><?php echo $first_name .' '.$last_name ?></span>
    &nbsp;
    <span class="header-text" name="last_name"><?php echo $last_name; ?></span><br/>
    <span class="header-text" name="email"><?php echo $email; ?></span><br/>
    <span class="header-text" name="city"><?php echo $city; ?></span><br/>
    <span class="header-text" name="country"><?php echo $country; ?></span><br/>
    <span class="header-text" name="gender"><?php echo ($gender == 'm') ? 'male' : 'female'; ?></span><br/>
    <span class="header-text" name="orientation"><?php echo $orientation; ?></span><br/>

    <br/><br />
    
    <div style="color: #00CCFF;"><?php echo anchor('logout', 'Logout'); ?></div>
</form>


<?php if ($this->session->userdata('user_id') == $user_id): ?>
<form class="closest-match" action="<?php echo site_url('users'); ?>">
    <input placeholder="Search by family..." type="text" name="name_str" />
    <input name="findButton" type="button" value="Find"/>
    <br/>
    <br/>
    <br/>
    <span class="normal-text">The closest person to you is:</span>
    <br/>

    <span class="header-text" id="names"><?php echo $nearest_user->first_name.' '.$nearest_user->last_name;?></span>
    <br/>
    <input name="navigate-to-profile" value="View Profile" type="button" onclick="location.href='<?php echo site_url('profile/'.$nearest_user->user_id); ?>'"/>
</form>
<?php endif; ?>
</body>
</html>