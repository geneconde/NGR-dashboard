<?php 
	/*require_once "../../session.php";
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(10, $_SESSION['smid']);*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo _("More core ideas about heating and cooling"); ?></title>
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

		.image { margin-top: 20px; text-align: center; overflow: hidden; }
		.image img { float: left; }
	
		#conductor, #insulator { display: inline-block; overflow: hidden; }
		#conductor { margin-right: 20px; }

		.bg { background-image: url('images/10/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		#dp_swf_engine { display: none; }

		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
			.image {margin-top:0px;}
		}
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div>
				<h1><?php echo _("More big ideas... about heating and cooling"); ?></h1>
				
				<p><?php echo _("Heat flows differently through different materials. A metal spoon transmits heat easily. A wooden spoon does not transfer heat easily. The metal is a <span class='key'>conductor</span> and the wood is an <span class='key'>insulator</span>. A conductor is something that lets heat go through it and an insulator is something that does not let heat go through it easily."); ?></p>
				
				<p><?php echo _("Insulators are used to prevent heat energy from moving from place to place. The special mitten that you use to take something from the oven acts as an insulator. The mitten prevents the heat energy from moving from the pan or dish that is at a high temperature to your hand that is at a lower temperature. The special jackets, pants and gloves that you wear in the winter are made of insulating materials to keep heat energy from going from your warm body to the cold outside air."); ?></p>
				
				<div class="image">
					<div id="conductor">
						<img src="images/10/conductor1.jpg" width="300" height="230" alt="Conductor 1">
						<img src="images/10/conductor2.jpg" width="300" height="230" alt="Conductor 2">
						<img src="images/10/conductor3.jpg" width="300" height="230" alt="Conductor 3">
					</div>
				
					<div id="insulator">
						<img src="images/10/insulator1.jpg" width="300" height="230" alt="Insulator 1">
						<img src="images/10/insulator2.jpg" width="300" height="230" alt="Insulator 2">
						<img src="images/10/insulator3.jpg" width="300" height="230" alt="Insulator 3">
					</div>
				</div>
			</div>
		</div>	
	</div>
	
	<div id="buttons">
		<a href="9.php#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="11.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	
	<section id="preloader"><section class="selected"><strong><?php echo _("Wood or metal?"); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/cycle.js"></script>
	<script src="scripts/rightclick.js"></script>
	<script>
		$('#conductor').cycle({
			fx: 'curtainX', 
    		sync: false,
			delay: -4000
		});

		$('#insulator').cycle({ 
			fx: 'curtainX', 
    		sync: false,
			delay: -2000
		});

	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
