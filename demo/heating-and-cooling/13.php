<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(13, $_SESSION['smid']);
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo _("Heating and Cooling"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="initial-scale=1">

	<link rel="stylesheet" href="css/locale.css" />
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="css/jpreloader.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<style>
		html, body {overflow: hidden;}
		.bg p { text-align: left; }
		html[dir="rtl"] p { text-align: right; }
		h1 { color: #BE7679; }
		.bg { background-image: url('images/13/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		#dp_swf_engine { display: none; }
		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
		}
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div>
				<h1><?php echo _("Summarizing big ideas... about heating and cooling"); ?></h1>
				<p><?php echo _("<span class='key'>Heat</span> is a form of energy. Heat can be produced from other forms of energy when wood or gas burns. Heat is also produced by <span class='key'>friction</span> when two objects or materials rub together. Heat energy causes the tiny particles of matter to vibrate or move about.  The more heat that is added to the particles, the faster the particles will vibrate or move. <span class='key'>Temperature</span> is a measure of how fast or slowly the particles are moving. Heat is the measure of the total energy of the particles in a system. Heat energy always moves from something at a high temperature to something at a lower temperature. Heat energy can move from one place to another by means of <span class='key'>conduction</span>, <span class='key'>convection</span> or <span class='key'>radiation</span>. Heating and cooling both involve the movement of heat energy.  Things get hotter when heat energy is added and things get colder when heat energy is taken away. Heat energy can be prevented from moving from place to place with <span class='key'>insulation</span>."); ?></p>
			</div>
		</div>
	</div>
	
	<div id="buttons">
		<a href="12.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="14.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	
	<section id="preloader"><section class="selected"><strong><?php echo _("Putting it all together..."); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/rightclick.js"></script>
	<?php include("setlocale.php"); ?>
</body>
</html>
