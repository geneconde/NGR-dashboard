<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(13, $_SESSION['smid']);
?>

<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Solar Power"); ?></title> <!-- Change module title here -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<style>

	html, body {overflow: hidden;} 
	.wrap { overflow: hidden; }

.bg { background: url('images/13/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
h1 { color: #376126;margin-left:2%; margin-right: 2%; padding-top: 10px}
.placeholder { /* background: rgba(255, 255, 255, .7); */border-radius:8px; padding:10px}
html[dir="rtl"] h1 { padding-right:10px; }

	<?php if($language == "ar_EG") { ?>
	 .lang-menu ul {margin-right: -9999px !important} 
	.lang-menu ul {left: 9999px }
	<?php } ?>

@media only screen and (max-width: 1250px) {
p {font-size: 20px;}

}
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
				<h1><?php echo _("Summarizing big ideas... about solar power"); ?></h1>
				<div class="placeholder">
					<p><?php echo _("The sun is a giant nuclear power plant within the solar system. Energy is released from the fusion going on inside the sun. Then the sun <span class='key'>radiates</span> huge amounts of energy in all directions in space. This solar energy affects life on earth in many ways. The effect of the sun's energy is directly observable in the <span class='key'>water cycle</span>, weather, and oceans. In plants, solar effects are not only seen in their growth, but also in the energy that animals get from the plants when the plants are eaten as food. The cycle of day and night is another cycle affected by solar energy, which is related to the way the earth rotates around itself at the same time it orbits around the sun. As it rotates, one half of the earth faces the sun and has sunlight, and the other half faces away from the sun and experiences night. Differences in the amount of energy received from the sun at different places on the earth are due to earth's shape and its rotation on a tilted axis as it travels around the sun.  The tilt in the earth on its axis results in changes in how much of sun's energy is received as the earth moves around the sun. It is the difference in energy received that causes different places to be warm (near the equator) or cold (as you get closer and closer the north or south pole)."); ?></p>
				</div>
		</div>
	</div>
<!--
	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="12.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons" title="<?php echo _('Next'); ?>">
		<a href="14.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png"></a>
	</div>
-->
	<div id="buttons">
		<a href="12.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="14.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Putting it all together..."); ?></strong></section></section>
	<?php include("setlocale.php"); ?>
</body>
</html>
