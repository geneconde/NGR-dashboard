<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'gathering-data';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(16, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'gathering-data-qq1-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;
?>
<!DOCTYPE html>
<html lang="en" <?php if($language == "ar_EG") { ?> dir="rtl" <?php } ?>>
<head>
<title><?php echo _("Gathering Data"); ?></title> <!-- Change module title here -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/hexaflip.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
body {overflow:hidden;}
.wrap { border-left: 1px dashed #c1d0e5; border-right: 1px dashed #c1d0e5; }
.bg { background: url('images/16/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
#answer p { text-align:center; }
.red img, .green img { height: 30px; vertical-align: sub; }
img.next-toggle { display: none; }
.bg ul li { font-size: 24px; list-style-type: none; }

#box { margin: 20px auto 0; }
#box .info { padding: 20px 0; }

#hexaflip { margin: 20px 0 10px 310px; }

body #answer img.answerImg { height: 160px; }
.instruc {color:#8D3FB3;}

html[dir="rtl"] #hexaflip { margin: 0 auto; }
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _('Quiz Question #1'); ?></h1>
				<h2><?php echo _('Choose the best way to increase the accuracy of a measurement.'); ?></h2>
				<ul>
					<li id="A"><?php echo _('A'); ?>. <?php echo _('Make the measurement very carefully.'); ?></li>
					<li id="B"><?php echo _('B'); ?>. <?php echo _('Make the measurements at different times.'); ?></li>
					<li id="C"><?php echo _('C'); ?>. <?php echo _('Make several measurements and average them.'); ?></li>
					<li id="D"><?php echo _('D'); ?>. <?php echo _('Ask someone to check your measurement.'); ?></li>
				</ul>
					
				<div id="box">
					<p class="info"><span class="instruc"><?php echo _('Rotate or flip the box below either up or down to set your answer. Click, hold and slide mouse up or down.'); ?></span></p>

					<div id="hexaflip"> </div>
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _('Quiz Question #1'); ?> - <?php echo _('How did I do?'); ?></h1>
				<p class="center"><?php echo _('You answered...'); ?></p>
				<div id="feedback"> </div>
				
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#answer" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="17.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Your first quiz question is...'); ?></strong></section></section>
	<script src="scripts/hexaflip.js"></script>
	<script>
	var hexa,
	images = ['./images/others/a.jpg','./images/others/b.jpg','./images/others/c.jpg','./images/others/d.jpg'];
	hexa = new HexaFlip(document.getElementById('hexaflip'), { set: images }, { size: 220 });
	</script>
	<script>
	var answered = <?php echo $answered; ?>,
		question = $('#question'),
		answer = $('#answer'),
		feedback = $('#feedback'),

		check = $('img.check-toggle'),
		back = $('img.back-toggle'),
		next = $('img.next-toggle');
		
	$(document).ready(function() {
		check.on('click', function() {
			question.fadeOut(function() { answer.fadeIn(); });
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

	});
	
	function save() {
			var ans = null;
			var hexaValue = hexa.getValue();

			if (hexaValue == './images/others/a.jpg') {
				feedback.html(
					'<p class="center"><img src="./images/others/a.jpg" alt="A" class="answerImg"/></p>' + '<p class="center">' + $('li#A').html() + '</p>' +
					'<p class="red center"><img src="images/others/wrong.png" alt="Wrong" /> <?php echo _("Nope! Care needs to be taken every time you make a measurement, but the best way to increase the accuracy of a measurement is to make several measurements and average them."); ?></p>');

				ans = 'A';
			}

			if (hexaValue == './images/others/b.jpg') {
				feedback.html('<p class="center"><img src="./images/others/b.jpg" alt="B" class="answerImg"/></p>' + '<p class="center">' + $('li#B').html() + '</p>' +
					'<p class="red center"><img src="images/others/wrong.png" alt="Wrong" /> <?php echo _("Nope! You want to keep everything the same as much as possible when you are measuring or experimenting. For instance, when using a scale to weigh an object, try to place the scale in the same place each time."); ?></p>');

				ans = 'B';
			}

			if (hexaValue == './images/others/c.jpg') {
				feedback.html('<p class="center"><img src="./images/others/c.jpg" alt="C" class="answerImg"/></p>' + '<p class="center">' + $('li#C').html() + '</p>' +
					'<p class="green center"><img src="images/others/correct.png" alt="Wrong" /> <?php echo _("Correct! Averaging your measurements is a great way to increase accuracy."); ?></p>');

				ans = 'C';
			}

			if (hexaValue == './images/others/d.jpg') {
				feedback.html('<p class="center"><img src="./images/others/d.jpg" alt="D" class="answerImg"/></p>' + '<p class="center">' + $('li#D').html() + '</p>' +
					'<p class="red center"><img src="images/others/wrong.png" alt="Correct" /> <?php echo _("Nope! Having someone else measure again is not the best way to make it more accurate."); ?></p>');

				ans = 'D';
			}

			if (answered == 0) {
				saveAnswer('gathering-data-qq1-a', ans);
				answered = 1;
			}
		}
		
	</script>
	
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
