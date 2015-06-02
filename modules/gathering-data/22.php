<?php 
	require_once '../../session.php'; 
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(0, $_SESSION['smid']);
		$smc->finishModule($_SESSION['smid']);
	}
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Gathering Data"); ?></title> <!-- Change module title here -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<style>
.wrap { border-left: 1px dashed #d8e2a9; border-right: 1px dashed #d8e2a9; }
.bg { background: url('images/22/bg.jpg');  background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position:relative; }
h1 { font-size: 50px; text-align: center; }
p { text-align: center; }
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
	background: -moz-linear-gradient(top,  #ffd700 0%, #cd7f31 100%); 
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffd700), color-stop(100%,#cd7f31)); Safari4+ */
	background: -webkit-linear-gradient(top,  #ffd700 0%,#cd7f31 100%); 
	background: -o-linear-gradient(top,  #ffd700 0%,#cd7f31 100%); 
	background: -ms-linear-gradient(top,  #ffd700 0%,#cd7f31 100%); 
	background: linear-gradient(to bottom,  #ffd700 0%,#cd7f31 100%); 
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffd700', endColorstr='#cd7f31',GradientType=0 ); */ 
}

p { margin-top: 40px; }
html[dir="rtl"] h1 { text-align: center; }
html[dir="rtl"] p { text-align: center; }
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div>
				<br/>
				<h1 class="blink"><?php echo _('Congratulations, ') . $user->getFirstName() . '!'; ?></h1>		
				<p><?php echo _("You've completed the Gathering Data module."); ?></p>			
				<p><?php echo _("You can check how you did on the 'Quick Checks' and 'Quiz Questions' for this module by clicking the button below."); ?></p>
				<a id="results"
		<?php if ($user->getType() == 0): ?>
			href="../../teacher.php">
			<?php echo _("Go to dashboard"); ?>
		<?php else: ?>
			href="../../results.php?smid=<?php echo $_SESSION['smid']; ?>">
			<?php echo _("How did I do?"); ?>
		<?php endif; ?>
	</a>
			</div>
		</div>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("You're done!"); ?></strong></section></section>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="21.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
