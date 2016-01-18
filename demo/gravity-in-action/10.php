<?php
	/* Comment out line 4 and uncomment lines (5, 6, 7 and 10) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";

	//if($user->getType() == 2) $uf->updateStudentLastscreen(10, $_SESSION['smid']);
?>

<!DOCTYPE html>
<html <?php if ($language == 'ar_EG') echo 'dir="rtl"'; ?>>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php echo _("Gravity in Action"); ?></title>

	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/locale.css">
	<link rel="stylesheet" href="css/jpreloader.css">
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<?php if ($language == 'ar_EG') : ?>
		<link rel="stylesheet" href="css/grid_rtl.css">
	<?php else : ?>
		<link rel="stylesheet" href="css/grid.css">
	<?php endif; ?>

	<style>
		h1 { color: #009014; }
		p { 
			<?php if ($language == 'es_ES') { ?>
				 font-size: 21px;
			<?php }else{ ?>
				font-size: 23px;
			<?php } ?>
			 margin: 0px auto;}
		.wrap { border-color: #009014; }
		.bg { background-image: url(assets/10/bg.jpg);  }
		.side_image {margin-top: 57px;}
		.text-justify { text-align: justify; }
		
		@media only screen and (max-width: 1250px) {
			p {
			<?php if ($language == 'es_ES') { ?>
				 font-size: 19px;
			<?php }else{ ?>
				font-size: 20px;
			<?php } ?>
			 margin: 0px auto;} 
			.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; }
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_10">

					<h1 class="grid_12"><?php echo _("More big ideas about... gravity in action"); ?></h1>

					<p class="grid_12 text-justify"><?php echo _("<span class='key'>Velocity</span> is the speed of a moving object. Sometimes objects move at a constant speed – like a car driving down the highway at 105 kilometers per hour (Km/h). But usually, moving objects speed-up or slow down. <span class='key'>Acceleration</span> is how quickly that happens. Does the car accelerate quickly – going from 0 to 105 Km/h in 6 seconds? Or does it accelerate slowly going from 0 to 105 Km/h in 30 seconds?"); ?></p>
					<p class="grid_12 text-justify"><?php echo _("Gravity causes free-falling objects to fall to Earth at a constant acceleration of 9.8 meters per second, per second. Thus, a ball that is from rest dropped from a cliff will be falling, not accounting for air resistance, at 9.8 meters per second after one second. After two seconds, it will be falling at 9.8 x 2 = 19.6 meters per second. And after three seconds, the ball will be falling at 9.8 x 3 = 29.4 meters per second. Thus, objects increase in speed as they are falling, covering more distance each second they are in the air. The following image of a falling basketball demonstrates this. The ball’s position, beginning with it being held and dropped at the top, is pictured after each 1/20th of a second. Notice how the basketball is covering more distance during each additional 1/20th of a second that it falls."); ?></p>
					<div class="clear"></div>

				</div>
				
				<div class="grid_2">
					<div class="side_image">
						<img src="assets/10/10a.jpg" alt="">
					</div>

					<div class="clear"></div>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="9.php" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="11.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Studying gravity..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
