<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once 'locale.php';
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Solar Power"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<style>
	html, body {overflow: hidden;} 
.wrap { overflow: hidden; }
.bg { background: url('images/22/bg.jpg');  background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position:relative; }
h1 { color: #f03b61; font-size: 50px; text-align: center !important; }
p { text-align: center !important; }
a { text-decoration: none; }
#results { 
	width: 216px;
	margin: 60px auto 0;
	text-align: center;
	color: white;
	font-size: 28px;
	padding: 6px;
	display: block;
	border: 2px solid #fff;

	-webkit-border-radius: 6px;
	border-radius: 6px;
	background-clip: padding-box;

	background: yellow;
	background: -moz-linear-gradient(top,  #f03b61 0%, #e24d6d 100%); 
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f03b61), color-stop(100%,#e24d6d)); Safari4+ */
	background: -webkit-linear-gradient(top,  #f03b61 0%,#e24d6d 100%); 
	background: -o-linear-gradient(top,  #f03b61 0%,#e24d6d 100%); 
	background: -ms-linear-gradient(top,  #f03b61 0%,#e24d6d 100%); 
	background: linear-gradient(to bottom,  #f03b61 0%,#e24d6d 100%); 
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f03b61', endColorstr='#e24d6d',GradientType=0 ); */ 
}

p { margin-top: 40px; margin-left: 2%; margin-right: 2%;}

</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<br>
			<h1 class="blink"><?php echo _("Congratulations"); ?>, <?php echo $user->getFirstName(); ?>!</h1>		
			<p><?php echo _("You've completed the Solar Power module."); ?></p>			
			<p><?php echo _("You can check how you did on the 'Quick Checks' and 'Quiz Questions' for this module by clicking the button below."); ?></p>
			<!-- <a href="#" >How did I do?</a> -->
			<a id="results"
				<?php if ($user->getType() == 0): ?>
					href="../../teacher.php" >
					<span id="link"><?php echo _("Go to dashboard"); ?></span>
				<?php else: ?>
					href="../../results.php?smid=<?php echo $_SESSION['smid']; ?>">
					<?php echo _("How did I do?"); ?>
				<?php endif; ?>
			</a>
		</div>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("You're done!"); ?></strong></section></section>
	<div id="buttons">
		<a href="21.php" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
	</div>
	<?php include("setlocale.php"); ?>
</body>
</html>
