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

<div class="user-form">
<table>
	<?php foreach($query->result() as $row): ?>
		<tr>
			<td>
			<?php echo $row->last_name . ", " . $row->first_name; ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
</div>

</body>
</html>