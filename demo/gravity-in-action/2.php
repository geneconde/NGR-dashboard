<?php
	/* Comment out line 4 and uncomment lines (5, 6, 7 and 10) when ported in the modules folder */

	require_once "../tempsession.php";
	//require_once "../../session.php";
	//$_SESSION['cmodule'] = 'gravity-in-action';
	//require_once '../../verify.php';
	require_once "locale.php";

	//if($user->getType() == 2) $uf->updateStudentLastscreen(2, $_SESSION['smid']);
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
	<link rel="stylesheet" href="css/2.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<?php if ($language == 'ar_EG') : ?>
		<link rel="stylesheet" href="css/grid_rtl.css">
	<?php else : ?>
		<link rel="stylesheet" href="css/grid.css">
	<?php endif; ?>

	<style>
		h1 { color: #4D8F38; }

		.wrap { border-color: #c9ffa7; }
		.bg { background: #fec99d url(assets/2/bg.jpg); }

		#animation { width: 457px; height: 345px; position: absolute; bottom: 80px; left: 140px; }
		#animation p { position: absolute; }
		#others { background: url(assets/2/bg.png) no-repeat; width: 457px; z-index: 3; height: 324px; }
		#sweat { top: 190px; left: 0px; background: url(assets/2/sweat.png) no-repeat; width: 30px; z-index: 4; height: 19px; }
		#leftleg { width: 154px; height: 288px; left: 66px; top: 114px; background: url(assets/2/leftleg.png) no-repeat; z-index: 2; }
		#rightleg { width: 126px; height: 224px; left: 60px; top: 156px; background: url(assets/2/rightleg.png) no-repeat; z-index: 1; }
		@media screen and (max-width: 1250px){
			.bg{ background-size:  100% calc(100% - 65px)!important; background-position: 0 34px; }
		}


		@media screen and (max-width: 960px){
			p.grid_12 {
			    line-height: 20px;
			}
/*			#others {
			    background: url(assets/2/bg.png) no-repeat;
			    width: 82%;
			    z-index: 3;
			    height: 100%;
			    background-size: contain;
			    top: 40px;
			    right: 60px;
			}*/
		}
	</style>
</head>

<body>
	<div class="wrap">
		<div class="bg">
			<div class="container_12">
				<div class="grid_12">

					<h1 class="grid_12"><?php echo _("Thinking about... gravity in action"); ?></h1>

					<p class="grid_12"><?php echo _("Have you ever seen a tug of war between two teams? Each team holding the rope is separated by a certain distance and both are trying to pull the other over a line. It might be hard to imagine a tug of war game without a rope, but such a contest is constantly taking place as objects throughout the universe pull on other objects with a force called <span class='key'>gravity</span>."); ?></p>

				</div>
			</div>

			<div id="animation">
				<p id="sweat"></p>
				<p id="others"></p>
				<p id="rightleg"></p>
				<p id="leftleg"></p>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="1.php" class="back" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="3.php" class="next" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Are you ready,"); ?> <?php echo $user->getFirstName(); ?></strong></section></section>

	<script src="js/jquery.min.js"></script>
	<script src="js/jpreloader.js"></script>

	<?php include 'setlocale.php'; ?>
</body>
</html>
