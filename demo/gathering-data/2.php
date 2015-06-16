<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Gathering Data"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/easeljs-0.6.0.min.js"></script>
<script src="scripts/tweenjs-0.4.0.min.js"></script>
<script src="scripts/movieclip-0.6.0.min.js"></script>
<script src="scripts/2.js"></script>
<script src="scripts/global.js"></script>
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
p { color: #fff; }
h1 { color: #f5833c; }
#canvas { position: absolute; z-index: 2; margin: 0 auto; background: #333333; }
.wrap { position: relative; border-left: 1px dashed #333; border-right: 1px dashed #333; }
.bg { position: relative; z-index: 99; }
</style>
</head>
<body onload="init();">
	<div class="wrap">
		<canvas id="canvas"></canvas>

		<div class="bg">
			<div>
				<h1><?php echo _("Thinking about... gathering data"); ?></h1>
				<p><?php echo _("Scientists, like everyone else, use their five senses to gather <span class='key'>data</span>. The word data is another word for information. So scientists try and figure out ways to extend or improve their senses with instruments. <span class='key'>Instruments</span> are tools scientists use to extend their senses to make observations and measurements. A hand lens and a microscope are examples of instruments scientists use to make things look bigger so they can see things they can't see with their eyes alone. A ruler is an example of a tool scientists use to measure things. What are some different kinds of data scientists collect and what tools or instruments do scientists use to help them?"); ?></p>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="1.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons" title="<?php echo _("Next"); ?>">
		<a href="3.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Are you ready,")." ";echo $user->getFirstName(); ?></strong></section></section> <!-- Change to student name soon -->
	<script>
		// Add script here
	</script>
<?php include("setlocale.php"); ?>	
<script src="scripts/jpreloader.js"></script>
</body>
</html>
