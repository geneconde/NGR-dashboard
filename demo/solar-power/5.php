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
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" type="text/css" href="styles/svgcomponent.css" />
<link rel="stylesheet" href="styles/font-awesome.min.css">

<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
	html, body {overflow: hidden;} 
	.wrap { overflow: hidden; }
	.bg { background: url('images/5/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
	#answer { display: none; }
	#answer-icon1, #answer-icon2 { display: inline-block; height: 30px; margin-right: 10px; }
	#question .placeholder, #answer .placeholder { /*background: rgba(255,255,255,0.5); */border-radius: 10px;position: absolute; padding: 0px 10px 10px 0px;margin-left: -15px; width: 100%;}
	h2 { margin: 0; /* padding: 5px; */color: #6D47A5; }
	#buttons .next { display: none; }
	img.next-toggle { display: none; }

#answer p, h2 {margin-left: 15px; margin-right: 10px;}

#choices1 { margin-left: 20px; }
input[type=radio].css-radio { display:none; }
input[type=radio].css-radio + label.css-label {
	background-image: url('images/5/unchecked.png');
	height:40px; 
	display:inline-block;
	line-height:30px;
	background-repeat:no-repeat;
	background-position: 0 3px;
	background-size: 20px 20px;
	font-size:24px;
	vertical-align:middle;
	cursor:pointer;
	padding-left: 26px;
}

input[type=radio].css-radio:checked + label.css-label { background-image: url('images/5/checked.png'); }
label.css-label {
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

#spectrum { background: url(images/5/q2a.png) no-repeat; background-size: 100% 100%; margin: 5px auto; border-radius: 10px; width: 504px; height: 230px; position: relative; }
#spectrum span { position: absolute; font-size: 16px; cursor: pointer; }
#spectrum p { position: absolute; left: 42%; top: 54%; font-size: 18px; }
#spectrum span:first-child { left: 2%; top: 20%; }
#spectrum span:nth-child(2) { left: 22%; top: 20%; }
#spectrum span:nth-child(3) { left: 37%; top: 20%; }
#spectrum span:nth-child(4) { left: 54%; top: 20%; }
#spectrum span:nth-child(5) { left: 70%; top: 20%; }
#spectrum span:nth-child(6) { left: 82%; top: 20%; }
#answer p { text-align: center; }

html[dir="rtl"] h2 { text-align: right; }
html[dir="rtl"] #question .placeholder { padding:0 10px 10px 10px; margin-right: -15px; }
html[dir="rtl"] #answer .placeholder { padding:0 10px 10px 10px; margin-right: -15px; } 
html[dir="rtl"] input[type=radio].css-radio + label.css-label { padding-right:26px;background-position-x:right; }
html[dir="rtl"] #spectrum span:first-child { left:0%;top:20%; }
html[dir="rtl"] #spectrum span:nth-child(2) { left:20%;top:15%; }
html[dir="rtl"] #spectrum span:nth-child(3) { left:34%;top:20%; }
html[dir="rtl"] #spectrum span:nth-child(4) { left:49%;top:15%; }
html[dir="rtl"] #spectrum span:nth-child(5) { left:64%;top:22%; }
html[dir="rtl"] #spectrum span:nth-child(6) { left:82%;top:15%; }


@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
		input[type=radio].css-radio + label.css-label {height:36px !important; font-size: 20px !important;}
		#answer p{font-size: 20px !important;}
		#spectrum span {font-size:14px !important;}
		#spectrum p {font-size: 16px !important;}
		#spectrum { height: 220px !important; margin-left:150px !important;}

		#answer p, h2 {margin-right: 50px !important;}
		#question .placeholder, #answer .placeholder { width: 99%; }
}	

	@media only screen and (max-width: 1250px) {
		input[type=radio].css-radio + label.css-label {height:36px; font-size: 20px;}
		#answer p{font-size: 20px;}
		#spectrum span {font-size:14px !important;}
		#spectrum p {font-size: 16px;}
		#spectrum { height: 200px;  width:450px;}


	}
	

	@media only screen and (max-width: 1040px) {
		input[type=radio].css-radio + label.css-label {height:36px; font-size: 20px;}
		#answer p{font-size: 20px;}
		#spectrum span {font-size:14px !important;}
		#spectrum p {font-size: 16px;}
		#spectrum { height: 200px; width: 450px; margin-left: 170px;}

	
	}

	@media only screen and (max-width: 960px) {
		input[type=radio].css-radio + label.css-label {height:36px; font-size: 20px;}
		#answer p{font-size: 20px;}
		#spectrum span {font-size:14px !important;}
		#spectrum p {font-size: 16px;}
		#spectrum { height: 200px; width: 400px; margin-left: 170px;}


	}

	@media only screen and (max-width: 768px) {
		input[type=radio].css-radio + label.css-label {height:36px; font-size: 20px;}
		#answer p{font-size: 20px;}
		#spectrum span {font-size:14px !important;}
		#spectrum p {font-size: 16px;}
		#spectrum { height: 200px; width: 400px; margin-left: 85px;}

	
	}

	@media only screen and (max-width: 600px) {
		input[type=radio].css-radio + label.css-label {height:36px; font-size: 20px;}
		#answer p{font-size: 16px;}
		#spectrum span {font-size:14px !important;}
		#spectrum p {font-size: 14px;}
		#spectrum { height: 170px; width: 387px; margin-left: 57px;}


	}

<?php if($language == "ar_EG") { ?>
	@media only screen and (max-width: 1250px) {
	#spectrum { width: 70%;}
			#answer p, h2 {margin-right: 0px !important;} 
	}
<?php } ?>
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quick Check #1"); ?></h1>
				<div class="placeholder">
					<div class="q-container">
						<h2><?php echo _("Question A. What can you infer about helium from the fact that it's made by nuclear fusion reactions inside the sun?"); ?></h2>
						<div id="choices1">
							<input type="radio" name="choices" id="a1" class="css-radio">
							<label for="a1" class="css-label"><?php echo _("It's heavier than hydrogen."); ?></label><br>
							<input type="radio" name="choices" id="a2" class="css-radio">
							<label for="a2" class="css-label"><?php echo _("It's lighter than hydrogen."); ?></label><br>
							<input type="radio" name="choices" id="a3" class="css-radio">
							<label for="a3" class="css-label"><?php echo _("It's heavier than oxygen."); ?></label><br>
							<input type="radio" name="choices" id="a4" class="css-radio">
							<label for="a4" class="css-label"><?php echo _("It's heavier than carbon."); ?></label>
						</div>
					</div>
					<div class="q-container">
						<h2><?php echo _("Question B. Some snakes have the ability to hunt prey in the darkness by using specialized pit organs on their face which allow them to \"see\" the body heat of their intended meal. Click on the part of the spectrum that can be detected by those pit organs."); ?></h2>
						<div id="spectrum">
							<span id="radiowaves"><?php echo _("Radio waves"); ?></span>
							<span id="microwave"><?php echo _("Microwave"); ?></span>
							<span id="infrared"><?php echo _("Infrared"); ?></span>
							<span id="ultraviolet"><?php echo _("Ultraviolet"); ?></span>
							<span id="xray"><?php echo _("X-Rays"); ?></span>
							<span id="gammaray"><?php echo _("Gamma Rays"); ?></span>
							<p><?php echo _("Visible Light"); ?></p>
						</div>
					</div>
				</div>
				
			</div>
			<div id="answer">
				<h1><?php echo _("Quick Check #1"); ?> - <?php echo _("How did I do?"); ?></h1>
				<div class="placeholder">
					<div class="answer-item">
						<h2><?php echo _("Question A. What can you infer about helium from the fact that it's made by nuclear fusion reactions inside the sun?"); ?></h2>
						<p><?php echo _("You answered..."); ?></p>
						<p><span id="textanswer1"></span></p>
						<p><img id="answer-icon1"><span id="feedback1"></span></p>
					</div>
					<div class="answer-item"> 
						<h2><?php echo _('Question B. Some snakes have the ability to hunt prey in the darkness by using specialized pit organs on their face which allow them to "see" the body heat of their intended meal. Click on the part of the spectrum that can be detected by those pit organs.'); ?></h2>
						<p><?php echo _("You answered..."); ?></p>
						<p><span id="textanswer2"></span></p>
						<p><img id="answer-icon2"><span id="feedback2"></span></p>
					</div>
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
		<a href="6.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="6.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Ready for your first quick check!"); ?></strong></section></section>
	<script>
	var answer1,
		answer2 = 0,
		answered = 1,
		textstr = "",
		nullAnswer = false,
		back = $('a.back-toggle'),
		next = $('a.next-toggle'),
		check = $('a.check-toggle'),
		question = $('#question'),
		answer = $('#answer'),
		textanswer1 = $('#textanswer1'),
		textanswer2 = $('#textanswer2'),
		feedback1 = $('#feedback1'),
		feedback2 = $('#feedback2'),
		answericon1 = $('#answer-icon1'),
		answericon2 = $('#answer-icon2');
		
	$(document).ready(function() {
		$('#spectrum span').each(function() {
			$(this).click(function() {
				textanswer2.text($(this).text());
				clearBorder();
				$(this).css('border-bottom','3px solid orange');
				answer2 = $(this).attr('id');
			});
		});
	
		back.click(function() { 
			if(question.is(':visible')) {
				document.location.href = "4.php#screen2";
			} else if ($('#answer').is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					question.fadeIn();
					window.location.hash = '';
					feedback1.removeClass('red');
					feedback1.removeClass('green');
					feedback2.removeClass('red');
					feedback2.removeClass('green');
					answericon1.removeClass('img-align');
					answericon2.removeClass('img-align');
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
					window.location.hash = '#answer';
					
					/* For checking of question A */
					if($('#a1').is(':checked')) {
						textanswer1.text("<?php echo _("It's heavier than hydrogen."); ?>");
						textstr = "<?php echo _('Correct! Hydrogen atoms combine and make helium, so helium is heavier.'); ?>";
						answericon1.attr("src", "images/others/correct.png");
						feedback1.addClass('green');
						answer1 = "A";
					} else {
						if($('#a2').is(':checked')) {
							textanswer1.text("<?php echo _("It's lighter than hydrogen."); ?>");
							textstr = "<?php echo _('Not quite! Helium is made up of hydrogen atoms fusing, so helium is heavier than hydrogen.'); ?>";
							answer1 = "B";
						} else if ($('#a3').is(':checked')) {
							textanswer1.text("<?php echo _("It's heavier than oxygen."); ?>");
							textstr = "<?php echo _('Nope! Oxygen is heavier than helium, but nuclear fusion in the sun involves hydrogen and helium.'); ?>";
							
							answer1 = "C";
						} else if ($('#a4').is(':checked')) {
							textanswer1.text("<?php echo _("It's heavier than carbon."); ?>");
							textstr = "<?php echo _('Think again! Carbon is heavier than helium, but nuclear fusion in the sun involves hydrogen and helium.'); ?>";
							answer1 = "D";
						}
						answericon1.attr("src", "images/others/wrong.png");
						answericon1.addClass('img-align');
						feedback1.addClass('red');
					}
					feedback1.text(textstr);
					/* End checking of question A */
					
					
					/* For checking of question B */
					if(answer2 == "infrared") {
						textanswer2.text("<?php echo _('Infrared'); ?>");
						textstr = "<?php echo _('Correct! Certain types of snakes have holes on their faces called pit organs. The pit organ can detect infrared radiation from warm bodies up to three feet away.'); ?>";
						answericon2.attr("src", "images/others/correct.png");
						feedback2.addClass('green');
					} else {
						textstr = "<?php echo _('Nope! Visible light gives us the colors that we see, and infrared light is a kind of heat light. Certain types of snakes have holes on their faces called pit organs. The pit organ can detect infrared radiation from warm bodies up to three feet away. This is how the snakes hunt at night.'); ?>";
						answericon2.attr("src", "images/others/wrong.png");
						answericon2.addClass('img-align');
						feedback2.addClass('red');
					}
					feedback2.text(textstr);
					/* End checking of question B */
					
					if(answered == 0) {
						saveAnswer('solar-power-qc1-a', answer1);
						saveAnswer('solar-power-qc1-b', answer2);
						answered = 1;
					} // end save to db
				}); // end question fade
			} // end else
		}); // end check
	}); // end doc ready
	
	function clearBorder() {
		$('#spectrum span').each(function() {
			$(this).css('border','0');
		});
	}
	
	function checkNull() {
		if(!$('#choices1 input:radio').is(':checked')) {
			nullAnswer = true;
		}
		
		if (answer2 == 0) {
			nullAnswer = true;
		}
	}
	</script>
	<script src="scripts/svgcheckbx.js"></script>
	<?php include("setlocale.php"); ?>
</body>
</html>
