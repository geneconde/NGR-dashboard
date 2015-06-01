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
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/svgcomponent.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
	html, body {overflow: hidden;} 
	.wrap { overflow: hidden; }

	h1 {margin-left: 1%; margin-right: 1%; padding-top: 10px;}
h2	{ padding-bottom:0px; margin-top:  -10px}

.bg { background: url('images/18/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; text-align: center; }
#answer img { display: inline-block; }
#answer-icon { display: inline-block; height: 30px; margin-right: 10px; }
#question .placeholder, #answer .placeholder { /* background: rgba(255,255,255,0.5); */border-radius: 10px;padding: 0px 10px 10px 10px;}
/*img.next-toggle { display: none; }*/
#buttons .next { display: none; }
.img-holder { width: 60%; margin: 0 auto; padding-top: 10px; }
.img-holder img { width: 100%; }
.ac-custom { margin: 0; padding: 15px 0 0 30px; }
.ac-custom label { font-size: 30px; font-weight: normal; color: #000; padding: 0 0 0 80px; }
.ac-circle label::before { background-color: #FFA300; }
.ac-custom svg path { stroke: #FFA300; }
.ac-custom li { padding: 10px 0px; }
.ac-custom input[type="radio"]:checked + label { color: #000; }
#answer p { text-align: center; }

html[dir="rtl"] .ac-custom label { padding:0 80px 0 0; }
html[dir="rtl"] .ac-circle input[type="checkbox"], .ac-circle input[type="radio"], .ac-circle label::before { right:10px; } 
html[dir="rtl"] .ac-circle svg { right:-10px; } 
html[dir="rtl"] #answer-icon { margin-right: 0; }

	<?php if($language == "ar_EG") { ?>
	@media only screen and (max-width: 1250px) {
		html[dir="rtl"] .ac-circle svg {  right: 0px;}
	}
	<?php } ?>
	@media only screen and (max-width: 1250px) {
		#answer p, .ac-custom label {font-size: 20px !important;}
		.ac-circle svg {width:50px; left:0px;}
	}
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #3"); ?></h1>
				<div class="placeholder">
					<h2><?php echo _("The Sun appears to move across the sky each day. What causes this?"); ?></h2>
					<div class="img-holder">
						<img src="images/18/sun-movement.gif">
					</div>
					<form class="ac-custom ac-radio ac-circle" autocomplete="off">
						<ul>
							<li>
								<input id="a1" name="r1" type="radio">
								<label for="a1" class="css-label"><?php echo _("The spinning of Earth on its axis."); ?></label>
							</li>
							<li>
								<input id="a2" name="r1" type="radio">
								<label for="a2" class="css-label"><?php echo _("The path of the Sun around Earth."); ?></label>
							</li>
							<li>
								<input id="a3" name="r1" type="radio">
								<label for="a3" class="css-label"><?php echo _("The production of nuclear energy by the Sun."); ?></label>
							</li>
							<li>
								<input id="a4" name="r1" type="radio">
								<label for="a4" class="css-label"><?php echo _("The tilt of Earth on its axis."); ?></label>
							</li>
						</ul>
					</form>
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _("Quiz Question #3"); ?> - <?php echo _("How did I do?"); ?></h1>
				<div class="placeholder">
					<p><?php echo _("You answered..."); ?></p>
					<img src="images/18/sun-movement.gif">
					<p><span id="textanswer"></span></p>
					<p><img id="answer-icon"><span id="feedback"></span></p>
				</div>
			</div>
		</div>
	</div>
<!--
	<div class="buttons-back" title="<?php echo _('Back'); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _('Check Answer'); ?>"></a>
		<a href="19.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->	
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="19.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("A brighter day"); ?></strong></section></section>
	<script>
	var answer1,
		answered = 1,
		textstr = "",
		nullAnswer = false,
		back = $('a.back-toggle'),
		next = $('a.next-toggle'),
		check = $('a.check-toggle'),
		question = $('#question'),
		answer = $('#answer'),
		textanswer = $('#textanswer'),
		feedback = $('#feedback'),
		answericon = $('#answer-icon'),
		imganswer = $('#imganswer');
		
	$(document).ready(function() {
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "17.php";
			} else if (answer.is(':visible')) {
				next.fadeOut(function() {check.fadeIn(); });
				answer.fadeOut(function() {
					question.fadeIn();
					window.location.hash = '';
					feedback.removeClass('red');
					feedback.removeClass('green');
					answericon.removeClass('img-align');
				});
			}
		});
		
		check.click(function(e){ 
			checkNull();
			if(nullAnswer == true) {
				e.preventDefault();
				window.location.hash = '';
				alert("<?php echo _('Please select your answers.'); ?>");
				nullAnswer = false;
			} else {
				check.fadeOut(function() { next.fadeIn(); });
				question.fadeOut(function(){ 
					answer.fadeIn();
					window.location.hash = "#answer";
					
					/* For checking */
					if($('#a1').is(':checked')) {
						textanswer.text("<?php echo _('The spinning of Earth on its axis.'); ?>");
						textstr = "<?php echo _("Right on! The earth spins on its axis and that's what make it seem to moving across the sky."); ?>";
						answericon.attr("src", "images/others/correct.png");
						feedback.addClass('green');
						answer1 = "A";
					} else {
						if($('#a2').is(':checked')) {
							textanswer.text("<?php echo _('The path of the Sun around Earth.'); ?>");
							textstr = "<?php echo _('Not quite! The Sun does not go around the Earth- the Earth orbits the Sun. But the orbiting does not explain the appearance of the Sun moving across the sky.'); ?>";
							answer1 = "B";
						} else if ($('#a3').is(':checked')) {
							textanswer.text("<?php echo _('The production of nuclear energy by the Sun.'); ?>");
							textstr = "<?php echo _('Think again! Nuclear energy is produced in the Sun and some of that energy reaches the Earth. But that energy is coming in all the time- it does not explain the appearance of the Sun moving across the sky.'); ?>";
							answer1 = "C";
						} else if ($('#a4').is(':checked')) {
							textanswer.text("<?php echo _('The tilt of Earth on its axis.'); ?>");
							textstr = "<?php echo _('Nope! The tilt of the Earth on its axis does cause the change in seasons. But the tilt does not explain the appearance of the Sun moving across the sky.'); ?>";
							answer1 = "D";
						}
						answericon.attr("src", "images/others/wrong.png");
						answericon.addClass('img-align');
						feedback.addClass('red');
					}
					feedback.text(textstr);
					/* End checking */
					
				}); // end question fade
			} // end else
			
		}); // end check
	}); // end doc ready
	
	function checkNull() {
		if(!$('input:radio').is(':checked')) {
			nullAnswer = true;
		}
	}
	</script>
	<script src="scripts/svgcheckbx.js"></script>
	<?php include("setlocale.php"); ?>
</body>
</html>
