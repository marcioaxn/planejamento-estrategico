<?php
$commands = array(
	'echo $PWD',
	'whoami',
	'git pull',
	'git status',
	'git submodule sync',
	'git submodule update',
	'git submodule status',
);

$output = '';

foreach($commands AS $command) {

	$tmp = shell_exec($command);

	$output .= "<span style=\"color: #6BE234;\"></span><span style=\"color: #729FCF;\">{$command}</span><br />";
	$output .= htmlentities(trim($tmp)) . "\n<br /><br />";

}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GIT DEPLOYMENT SCRIPT</title>
</head>
<body style="background-color: #000000; color: #FFFFFF; font-weight: bold; padding: 0 10px;">
<div style="width: 700px;">

	<div style="float: left; width: 350px;">
		
		<p style="color: white;">Git Deployment Script</p>

		<?php print($output); ?>

	</div>
	
</div>
</body>
</html>