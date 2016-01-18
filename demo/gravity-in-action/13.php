<?php
	/* Comment out line 4 and uncomment lines (5, 6, 7 and 10) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";

	//if($user->getType() == 2) $uf->updateStudentLastscreen(13, $_SESSION['smid']);
?>

<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
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
		h1 { color: #fff75c; }
		p { color: #fff; }

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) { h1 { font-size: 33px; } }

		.wrap { border-color: #1683b1; }
		.bg { background-image: url(assets/13/bg.jpg); }
		@media screen and (max-width: 1250px){
		
			.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; }
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12 clearfix">
				<div class="grid_12">

					<h1 class="grid_12"><?php echo _("Summarizing big ideas about... gravity in action"); ?></h1>

					<p class="grid_12"><?php echo _("All objects in the universe exert a gravitational force on each other. The force of <span class='key'>gravity</span> pulls objects together without the objects actually being in physical contact with each other. There are two factors that affect the strength of gravity. The first is the mass of the object and the second is the distance between objects. The larger the mass, the greater the gravitational force it exerts. The farther away two objects are from each other, the weaker the gravitational force is between them. It's important to note that all objects exert a gravitational force on all other objects. Just as the earth is pulling on the moon, the moon is pulling on the earth. <span class='key'>Ocean tides</span> are caused by the gravitational pull of the moon. Earth's gravitational force extends far space. In outer space, gravitational forces of planets and stars account for the order and structure of solar systems and galaxies. The system of the moon orbiting Earth depends on a perfect balance of motion and gravity. In the case of <span class='key'>satellites</span> in general, a stable orbit requires a balance of enough speed to keep the object from falling completely back to Earth, but not so much speed that it shoots off into space."); ?></p>

				</div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="12.php" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="14.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Putting it all together..."); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
