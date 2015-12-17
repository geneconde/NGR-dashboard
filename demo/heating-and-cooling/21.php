<?php 
	require_once '../../session.php';
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(21, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'heating-and-cooling-qq6-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo _("Heating and Cooling"); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="initial-scale=1">

	<link rel="stylesheet" href="css/locale.css" />
	<link rel="stylesheet" href="css/fonts.css" />
	<link rel="stylesheet" href="css/jpreloader.css" />
	<link rel="stylesheet" href="css/global.css" />
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) { ?>
		<link rel="stylesheet" href="css/hexaflip2.css" />
	<?php } else { ?>
		<link rel="stylesheet" href="css/hexaflip.css" />
	<?php } ?>

	<style>
		html, body {overflow: hidden;}
		#buttons .next { display: none; }
		.bg { background-image: url('images/21/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }	
		.bg ul { padding: 0px; margin: 50px 0 0 20px; }
		#answer { display: none; }
		#box { width: 90%; margin: 40px auto 0; }
		#hexaflip { position: absolute; z-index: 9999; }
		#box .info { width: 82%; float: left; padding: 20px 0; margin-left: 18%; }
		@media screen and (max-width: 870px){ #box .info { margin-left: 22%; } }
		
		.image { float: right; margin-left: 20px; margin-top: 10px; width: 40%; }
		html[dir="rtl"] #hexaflip { float: left; }
		html[dir="rtl"] #choices li span { float: right; margin-left: 5px; }
		#dp_swf_engine { display: none; }
		@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
			.image { width: 300px; }
			#hexaflip { margin: 0 auto; }
			html[dir="rtl"] #hexaflip { float: none; }
		}	
		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
			#question img {height:270px;}
			.bg ul {margin:20px 0 0 20px;}
			.bg {overflow: overlay;}
		}
		@media only screen and (max-width: 1024px) {
			#question img {height:270px;}
			.bg ul {margin:20px 0 0 20px;}
		}
		@media only screen and (max-width: 960px) {
			.bg ul {margin:0px 0 0 20px;}
			h2, p, li {font-size:18px !important;}
			#question img {height:240px;}
			.bg {overflow: overlay;}
			#box .info {width: 78%;}
		}

	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #6"); ?></h1>
				<h2><?php echo _("In cup A there is an ice cube that weighs 12 grams. Over time it has melted and all of it was poured into cup B. How much does the substance in cup B weigh? Why?"); ?></h2>

				<div class="image">
					<img src="images/21/ice.jpg">
					<img src="images/21/water.jpg">
				</div>

				<ul id="choices"> 
					<li id="ca"><span>A. </span><?php echo _("10 grams, because the solid ice loses material when it turns into liquid."); ?></li>
					<li id="cb"><span>B. </span><?php echo _("12 grams, because only the form not the amount of matter changes."); ?></li>
					<li id="cc"><span>C. </span><?php echo _("14 grams, because there is more water than ice."); ?></li>
					<li id="cd"><span>D. </span><?php echo _("The weight in B could be more or less—it depends on how fast the ice melted."); ?></li>
				</ul>

				<div id="box">
					<p class="info"><?php echo _("Rotate or flip the box below either up or down to set your answer. Click, hold and slide mouse up or down."); ?></p>
					<div id="hexaflip"></div>
				</div>
			</div>

			<div id="answer">
				<h1><?php echo _("Quiz Question #6"); ?> - <?php echo _("How did I do?"); ?></h1>
				<p class="center"><?php echo _("You answered..."); ?></p>
				<div id="feedback"></div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="22.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("Freezing ice cubes..."); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
	<script src="scripts/jquery-ui.js"></script>
	<script src="scripts/jpreloader.js"></script>
	<script src="scripts/saveanswer.js"></script>
	<script src="scripts/rightclick.js"></script>
	<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') || strstr($_SERVER['HTTP_USER_AGENT'],'iPad')) { ?>
	<script src="scripts/hexaflip2.js"></script>
	<?php } else { ?>
	<script src="scripts/hexaflip.js"></script>
	<?php } ?>
	
	<script>
		var answered = <?php echo $answered; ?>,
		question = $('#question'),
		answer = $('#answer'),
		feedback = $('#feedback'),
		check = $('a.checkanswer'),
		back = $('a.back'),
		next = $('a.next');

		check.on('click', function() {
			question.fadeOut(function() {
				answer.fadeIn();
				window.location.hash = "#answer";
			});
			check.fadeOut(function() { next.fadeIn(); back.fadeIn(); });
			save();
		});

		back.on('click', function() {
			if (question.is(':visible')) { document.location.href = "20.php"; }
			else {
				answer.fadeOut(function() { question.fadeIn(); });
				next.fadeOut(function() { check.fadeIn(); });
			}
		});

		function save() {
			var ans = null;
			var hexaValue = hexa.getValue();

			if (hexaValue == './images/misc/a.png') {
				feedback.html(
					'<p class="center"><img src="./images/misc/a.png" alt="A" /></p>' + '<p class="center">'+$('#ca').html()+'</p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. When ice melts into water its weight stays the same."); ?></p>');
				ans = 'A';
			}

			if (hexaValue == './images/misc/b.png') {
				feedback.html(
					'<p class="center"><img src="./images/misc/b.png" alt="B" /></p>' + '<p class="center">'+$('#cb').html()+'</p>' + '<p class="green center"><img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Correct. When ice melts into water its weight stays the same."); ?></p>');
				ans = 'B';
			}

			if (hexaValue == './images/misc/c.png') {
				feedback.html('<p class="center"><img src="./images/misc/c.png" alt="C" /></p>' + '<p class="center">'+$('#cc').html()+'</p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. When ice melts into water its weight stays the same."); ?></p>');
				ans = 'C';
			}

			if (hexaValue == './images/misc/d.png') {
				feedback.html(
					'<p class="center"><img src="./images/misc/d.png" alt="D" /></p>' + '<p class="center">'+$('#cd').html()+'</p>' + '<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. When ice melts into water its weight stays the same."); ?></p>');
				ans = 'D';
			}

			if (answered == 0) {
				saveAnswer('heating-and-cooling-qq6-a', ans);
				answered = 1;
			}
		}

		$(window).resize(function() { makeHexa(); });
	</script>
	<script>
		var hexa,
            images = [
                './images/misc/a.png',
                './images/misc/b.png',
                './images/misc/c.png',
                './images/misc/d.png'
            ];

		hexa = new HexaFlip(document.getElementById('hexaflip'), { set: images }, { size: 120 });
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
