<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(2, $_SESSION['smid']);
?>

<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Solar Power"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
	<link rel="stylesheet" href="styles/font-awesome.min.css">
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/easeljs-0.6.0.min.js"></script>
<script src="scripts/tweenjs-0.4.0.min.js"></script>
<script src="scripts/movieclip-0.6.0.min.js"></script>
<script src="scripts/2.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<script>
var canvas, stage, exportRoot;

function init() {
	canvas = document.getElementById("canvas");
	fitToContainer(canvas);
	exportRoot = new lib._2();

	stage = new createjs.Stage(canvas);
	stage.addChild(exportRoot);
	stage.update();

	createjs.Ticker.setFPS(24);
	createjs.Ticker.addEventListener("tick", stage);
}

function fitToContainer(canvas) {
	canvas.style.width='99.6%';
	canvas.style.height='100%';
	
	canvas.width  = canvas.offsetWidth;
	canvas.height = canvas.offsetHeight;
}
</script>
<style>
	html, body {overflow: hidden;} 
h1 { color:#008000; }
#canvas { position: absolute; z-index: 2; margin: 0 auto; background: #ffffe8; }
.wrap { position: relative; }
.bg { position: relative; z-index: 99; }
.buttons, .buttons-back { display: none; }

@media only screen and (max-width: 1250px) {
	h2 {font-size: 21px !important;}
	p {font-size: 20px; padding:20px 0px;}
}


</style>
</head>
<body onload="init();">
	<div class="wrap">
		<canvas id="canvas"></canvas>

		<div class="bg">
			<div>
				<h1><?php echo _("Thinking about... solar power"); ?></h1>
				<p><?php echo _("When you think about energy resources found on Earth, such things as oil, coal and natural gas may come to mind. The energy stored in those fuels can be changed to useful forms of energy to produce electricity, drive cars and heat homes. But have you ever wondered where the energy stored in oil, coal and natural gas fuels, even the food that you ate today, came from? If you said the Sun, you are correct!"); ?></p>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="1.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons" title="<?php echo _('Next'); ?>">
		<a href="3.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png"></a>
	</div>
	<div id="buttons">
		<a href="1.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="3.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Are you ready"); ?>, <?php echo $user->getFirstName(); ?>?</strong></section></section> <!-- Change to student name soon -->
	<script>
		// Add script here
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>

