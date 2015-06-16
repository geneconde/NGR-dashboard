<?php
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once 'locale.php';

	if($user->getType() == 2) $smc->updateStudentLastscreen(1, $_SESSION['smid']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo _("Solar Power"); ?></title>
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
<script src="scripts/jpreloader.min.js"></script>
<style>
	html, body {overflow: hidden;} 
	.bg { background: url('images/1/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; }
	h1 { color: #fff46a; text-align: center !important; padding-top: 85px; }
	#next { position: absolute; right: 20%; bottom: 10%; height: 120px; width: 120px; }
	p { padding: 0; font-family: 'PlaytimeRegular'; color: #5E492E; font-size: 27px; color: #F9FFB3; z-index: 2; position: absolute; top: 43px; left: 28px; cursor: pointer; }
	.imgClass { 
    background-image: url(images/1/next.png);
	background-color: transparent;
    height: 100%;
	width: 100%;
    border: 0px;
	vertical-align: bottom;
	cursor: pointer;
	vertical-align: middle;
	background-size: 100% 100%;
	z-index: 1;
	text-transform: none;
	}

	/* wiggle */
	@-ms-keyframes wiggle{0%{-ms-transform:rotate(3deg);}50%{-ms-transform:rotate(-3deg);}100%{-ms-transform:rotate(3deg);}}
	@-moz-keyframes wiggle{0%{-moz-transform:rotate(3deg);}50%{-moz-transform:rotate(-3deg);}100%{-moz-transform:rotate(3deg);}}
	@-webkit-keyframes wiggle{0%{-webkit-transform:rotate(3deg);}50%{-webkit-transform:rotate(-3deg);}100%{-webkit-transform:rotate(3deg);}}
	@keyframes wiggle{0%{transform:rotate(3deg);}50%{transform:rotate(-3deg);}100%{transform:rotate(3deg);}}
	.wiggle-me:hover{-ms-animation:wiggle .3s 2;-moz-animation:wiggle .3s 2;-webkit-animation:wiggle .3s 2;animation:wiggle .3s 2;}
	html[dir="rtl"] p { top:50px;left:38px; } 
	<?php if($language == "es_ES") { ?>
		p { left:30px; }
	<?php } ?>

	@media only screen and (max-width: 1250px) { .bg {height: 100% !important;} }
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<h1><?php echo _("Welcome to the Solar Power module"); ?>, <?php echo $user->getFirstName(); ?>!</h1>
			<form method="post" action="2.php">
				<div id="next">
					<p><?php echo _("Start"); ?></p>
					<input id="namebutton" class="imgClass wiggle-me" type="button">
				</div>
			</form>
		</div>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Let's begin"); ?>!</strong></section></section>
	<script>
	$(document).ready(function() {	
		$('.blink').blink({ speed: 1500, blinks: 1000  });
		$('#namebutton').click(function(){
			document.location.href= "2.php";
		});
		
		$('#next p').click(function(){
			document.location.href= "2.php";
		});
	});
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html> 
