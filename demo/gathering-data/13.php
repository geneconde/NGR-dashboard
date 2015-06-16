<?php
	require_once '../tempsession.php';
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once 'locale.php';
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
.bg { background: url('images/13/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
<?php if($language == "es_ES") { ?>
	h1 { font-size: 31px; }
<?php } ?>
</style>
</head>
<body>
	<div class="wrap" >
		<div class="bg">
			<div>
				<h1><?php echo _('Summarizing big ideas... about gathering data'); ?></h1>
				<p>
					<?php echo _("The term <span class=\"key\">data</span> refers to information gathered through observation. <span class=\"key\">Instruments</span> are tools designed to help us extend our senses. Data that consist of descriptions of characteristics or behaviors without numbers are called <span class=\"key\">qualitative data</span>. Data that consist of measured amounts or things that can be counted are called <span class=\"key\">quantitative data</span>. All measurements have some amount of <span class=\"key\">error</span>. It is a good idea to take several measurements and <span class=\"key\">average</span> them to reduce error. The <span class=\"key\">metric system</span> is used in science and many other countries because measures in the metric system are related by factors of 10. When exact measurements are not needed, the measurement can be estimated. An <span class=\"key\">estimate</span> is a measurement or answer that is close to the real measurement or answer."); ?>
				</p>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="12.php" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons" title="<?php echo _("Next"); ?>">
		<a href="14.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Putting it all together...'); ?></strong></section></section>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
