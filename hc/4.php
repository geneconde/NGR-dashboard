<?php 
	require_once "../tempsession.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once "locale.php";
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?>  <?php } ?>>
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
		h1 { color: #28CDFC; }
		p { text-align: left; }

		.bg { background-image: url('images/4/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }

		.image { margin-top: 20px; }
		.image img { margin-right: 20px; }
		.image img:last-child { margin-right: 0; }
		html[dir="rtl"] p { text-align: right; }
		#dp_swf_engine { display: none; }

		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
			.image img {height: 200px; margin-top: -15px;}
		}
		@media only screen and (max-width: 960px) {
			h2, p, li {font-size:18px !important;}
			.image img {height: 200px; margin-top: -15px;}
		}	
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div>
				<h1><?php echo _("Reviewing big ideas... about heating and cooling"); ?></h1>
								
				<p><?php echo _("<span class='key'>Heat</span> is a form of energy that causes atoms and molecules, the particles of matter, to <span class='key'>vibrate</span> or move around faster. When heat energy is taken away from matter the particles vibrate less and move around more slowly."); ?></p>
				
				<p><?php echo _("How fast or slowly the tiny particles of matter vibrate or move around is called <span class='key'>temperature</span>. The faster the particles move, the higher the temperature is. The more slowly the particles move, the lower the temperature is. How much heat energy is needed to raise or lower the temperature of matter depends on the amount of matter involved. The more matter there is, the more heat energy has to be exchanged to raise or lower the temperature. The heat energy of something is the total amount of energy."); ?></p>
				
				<div class="image">
					<img src="images/4/cold.jpg" alt="Hot">
					<img src="images/4/hot.jpg" alt="Cold">
				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="3.php#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="5.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Learning science is cool!"); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/rightclick.js"></script>
	<?php include("temp-setlocale.php"); ?>
</body>
</html>
