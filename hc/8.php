<?php 
	/*require_once "../../session.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(8, $_SESSION['smid']);*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo _("Heating and Cooling"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="initial-scale=1">

	<link rel="stylesheet" href="css/locale.css" />
	<link rel="stylesheet" href="css/normalize.css" />
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="css/jpreloader.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<style>
		html, body {overflow: hidden;}
		h1 { color: #28CDFC; }
		p { text-align: left; }
		html[dir="rtl"] p { text-align: right; }
		.images { width: 54%; margin: 20px auto; overflow: hidden; }
		.images div { float: left; }
		.images div img { margin: 0 10px; }
		.images div p { padding: 0; text-align: center; }
		
		.bg { background-image: url('images/8/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		#dp_swf_engine { display: none; }

		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (-webkit-min-device-pixel-ratio: 1) {
			.images { width: 456px; }
		}	
		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
			.images {width:54%;}
		}

		@media only screen and (max-width: 1024px) {
			h2, p, li {font-size:18px !important;}
			.images {width:65%;}
		}

		@media only screen and (max-width: 960px) {
			h2, p, li {font-size:18px !important;}
			.images {width:75%;}
		}

		@media only screen and (max-width: 768px) {
			h2, p, li {font-size:16px !important;}
			.images {width:90%;}
		}
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div>
				<h1><?php echo _("More big ideas... about heating and cooling"); ?></h1>
				
				<p><?php echo _("Heat energy can move from place to place in different ways. When two objects or substances at different temperatures touch each other, heat energy flows from the one at the higher temperature to the one at the lower temperature by <span class='key'>conduction</span>. If you have ever picked up a spoon from a hot cup of chocolate, the spoon became hotter by conduction."); ?></p>
				
				<p><?php echo _("Particles that are free to move from one place to another can also carry heat energy from one place to another by <span class='key'>convection</span>. The bubbles in a pot of boiling water are carrying heat energy in the particles of water that move to the surface and escape."); ?></p>
				
				<p><?php echo _("Heat energy can also move from place to place by <span class='key'>radiation</span>. If you ever sat near a roaring campfire or next to a hot stove, you probably felt the warmth of the heat by radiation."); ?></p>
				
				<div class="images">
					<div><img src="images/8/conduction.jpg" alt="Conduction"><p><?php echo _("Conduction"); ?></p></div>
					<div><img src="images/8/convection.jpg" alt="Convection"><p><?php echo _("Convection"); ?></p></div>
					<div><img src="images/8/radiation.jpg" alt="Radiation"><p><?php echo _("Radiation"); ?></p></div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="buttons">
		<a href="7.php#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="9.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	
	<section id="preloader"><section class="selected"><strong><?php echo _("Warming up..."); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/rightclick.js"></script>
	<?php include("setlocale.php"); ?>
</body>
</html>
