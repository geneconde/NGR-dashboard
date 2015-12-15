<?php 
	require_once '../../session.php';
	$_SESSION['cmodule'] = 'heating-and-cooling';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(16, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'heating-and-cooling-qq1-a');
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
		.bg { background-image: url('images/16/bg.jpg'); background-repeat: no-repeat; background-size: 100% 100%; width:100%; height:100%; position: relative; }
		#answer { display: none; }
		#box { width: 90%; margin: 40px auto 0; }
		#box .info { width: 600px; float: right; padding: 20px 0; }
		.image { float: right; margin-right: 10px; width: 40%; }
		html[dir="rtl"] .image { margin-left: 15px; }
		html[dir="rtl"] #hexaflip { float: left; }
		
		@media only screen and (max-width: 1250px) {
			h2, p, li {font-size:20px !important;}
			#question img {height:200px;   width: 45%;}
			#box .info {  width: 78%;}
		}
		#dp_swf_engine { display: none; }
	</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #1"); ?></h1>
				<p><?php echo _("Two students make hot chocolate. One student pours the hot chocolate into a foam cup. The other student pours the hot chocolate into a metal cup. The metal cup becomes too hot to touch, but the foam cup can be held comfortably."); ?></p>
				<?php if($language == "ar_EG") { ?> <br> <?php } ?>
				<div class="image">
					<img src="images/16/img1.jpg">
					<img src="images/16/img2.jpg">
				</div>

				<h2><?php echo _("The best explanation for this difference in temperature is that the foam cup:"); ?></h2>

				<ul>
					<li id="A">A. <?php echo _("heats up much faster than the metal cup."); ?></li>
					<li id="B">B. <?php echo _("transfers heat better than the metal cup."); ?></li>
					<li id="C">C. <?php echo _("is a better conductor of heat than the metal cup."); ?></li>
					<li id="D">D. <?php echo _("is a better insulator of heat than the metal cup."); ?></li>
				</ul>

				<div id="box">
					<p class="info"><?php echo _("Rotate or flip the box below either up or down to set your answer. Click, hold and slide mouse up or down."); ?></p>

					<div id="hexaflip"></div>
				</div>
			</div>

			<div id="answer">
				<h1><?php echo _("Quiz Question #1"); ?> - <?php echo _("How did I do?"); ?></h1>
				<p class="center"><?php echo _("You answered..."); ?></p>
				<div id="feedback"></div>
			</div>
		</div>
	</div>

	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="17.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>

	<section id="preloader"><section class="selected"><strong><?php echo _("And the first quiz question is..."); ?></strong></section></section>

	<script src="scripts/jquery.js"></script>
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
			if (question.is(':visible')) { document.location.href = "15.php"; }
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
					'<p class="center"><img src="./images/misc/a.png" alt="A" /></p>' + '<p class="center">' + $('li#A').html() + '</p>' +
					'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. The foam cup does not conduct heat well and does not heat up easily either."); ?></p>');

				ans = 'A';
			}

			if (hexaValue == './images/misc/b.png') {
				feedback.html('<p class="center"><img src="./images/misc/b.png" alt="B" /></p>' + '<p class="center">' + $('li#B').html() + '</p>' +
					'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. The foam cup is an insulator; it does not transfer heat very well at all."); ?></p>');

				ans = 'B';
			}

			if (hexaValue == './images/misc/c.png') {
				feedback.html('<p class="center"><img src="./images/misc/c.png" alt="C" /></p>' + '<p class="center">' + $('li#C').html() + '</p>' +
					'<p class="red center"><img src="images/misc/wrong.png" alt="Wrong" /> <?php echo _("No. The foam cup is an insulator; it does not transfer heat very well at all."); ?></p>');

				ans = 'C';
			}

			if (hexaValue == './images/misc/d.png') {
				feedback.html('<p class="center"><img src="./images/misc/d.png" alt="D" /></p>' + '<p class="center">' + $('li#D').html() + '</p>' +
					'<p class="green center"><img src="images/misc/correct.png" alt="Correct" /> <?php echo _("Correct. The foam cup does not conduct heat well but the metal cup does."); ?></p>');

				ans = 'D';
			}

			if (answered == 0) {
				saveAnswer('heating-and-cooling-qq1-a', ans);
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
