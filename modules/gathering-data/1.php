<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) $smc->updateStudentLastscreen(1, $_SESSION['smid']);
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
	<script src="scripts/modernizr.min.js"></script>
	<script src="scripts/jquery.wiggle.min.js"></script>
	<script src="scripts/jquery.blink.min.js"></script>
	<script src="scripts/global.js"></script>
	<style>
		.wrap { border-left: 1px dashed #6fbfc6; border-right: 1px dashed #6fbfc6; }
		.bg { background: url('images/1/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
		h1 { text-align: center; color: #6a0008;  background: rgba(155, 230, 233, 0.7); padding: 10px; -webkit-border-radius: 10px; -moz-border-radius: 10px; border-radius: 10px; width: 80%; margin: 0 auto; }
		.pic { margin: 0 auto; width: 71% !important;position:relative;top:70px; }
		#start { right: 3%; width: 140px; height: 50px; background: url(images/1/pencil.png) no-repeat; top: 88%; font-size: 30px; padding: 9px 0 0 60px; position: absolute; 
		-webkit-animation-name: spaceboots;
		-webkit-animation-duration: 0.8s;
		-webkit-transform-origin:50% 50%;
		-webkit-animation-iteration-count: infinite;
		-webkit-animation-timing-function: linear;
		-moz-animation-name: spaceboots;
		-moz-animation-duration: 0.8s;
		-moz-transform-origin:50% 50%;
		-moz-animation-iteration-count: infinite;
		-moz-animation-timing-function: linear;
		}
		@-webkit-keyframes spaceboots {
			0% { -webkit-transform: translate(2px, 1px) rotate(0deg); }
			10% { -webkit-transform: translate(-1px, -2px) rotate(-1deg); }
			20% { -webkit-transform: translate(-3px, 0px) rotate(1deg); }
			30% { -webkit-transform: translate(0px, 2px) rotate(0deg); }
			40% { -webkit-transform: translate(1px, -1px) rotate(1deg); }
			50% { -webkit-transform: translate(-1px, 2px) rotate(-1deg); }
			60% { -webkit-transform: translate(-3px, 1px) rotate(0deg); }
			70% { -webkit-transform: translate(2px, 1px) rotate(-1deg); }
			80% { -webkit-transform: translate(-1px, -1px) rotate(1deg); }
			90% { -webkit-transform: translate(2px, 2px) rotate(0deg); }
			100% { -webkit-transform: translate(1px, -2px) rotate(-1deg); }
		}
		@-moz-keyframes spaceboots {
			0% { -moz-transform: translate(2px, 1px) rotate(0deg); }
			10% { -moz-transform: translate(-1px, -2px) rotate(-1deg); }
			20% { -moz-transform: translate(-3px, 0px) rotate(1deg); }
			30% { -moz-transform: translate(0px, 2px) rotate(0deg); }
			40% { -moz-transform: translate(1px, -1px) rotate(1deg); }
			50% { -moz-transform: translate(-1px, 2px) rotate(-1deg); }
			60% { -moz-transform: translate(-3px, 1px) rotate(0deg); }
			70% { -moz-transform: translate(2px, 1px) rotate(-1deg); }
			80% { -moz-transform: translate(-1px, -1px) rotate(1deg); }
			90% { -moz-transform: translate(2px, 2px) rotate(0deg); }
			100% { -moz-transform: translate(1px, -2px) rotate(-1deg); }
	}

	html[dir="rtl"] #start { text-align: center; padding: 9px 42px 0 20px; }
	</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<br>
			<h1><?php echo _("Welcome to the Gathering Data module, "); echo $user->getFirstName(); ?></h1>
			<br><br>
			<div class="pic">
				<img src="images/1/gathering-data.png">
			</div>
			<a href="2.php" id="start" ><?php echo _("Start"); ?></a>
		</div>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Let's begin!"); ?></strong></section></section>
	<?php include("setlocale.php"); ?>
	<script src="scripts/jpreloader.js"></script>
</body>
</html>
