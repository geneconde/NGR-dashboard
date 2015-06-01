<?php 
	require_once '../../session.php';
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once 'locale.php';
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(21, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'solar-power-qq6-a');
		$answered = ($sa ? 1 : 0 );
	} else $answered = 1;
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
<link rel="stylesheet" type="text/css" href="styles/nlform-default.css" />
<link rel="stylesheet" type="text/css" href="styles/nlform-component.css" />
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
a:hover, a:active { color: #0D0F58; }
.nl-dd ul li.nl-dd-checked { color: #0D0F58; }
.nl-field ul { background: #3438A7; }
.bg { background: url('images/21/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
.nl-field-toggle, .nl-form input, .nl-form select { color: #3438A7; border-bottom: 1px dashed #3438A7; }
#answer { display: none; }
#answer-icon { display: inline-block; height: 30px; margin-right: 10px; }
#question .placeholder, #answer .placeholder { /* background: rgba(255,255,255,0.5); */border-radius: 10px;padding: 0px 10px 10px 10px;}
img.next-toggle { display: none; }
#buttons .next { display: none; }
.nl-form { font-size: 27px; text-align: left; }
#answer p { text-align: center; }
#ans1, #ans2, #ans3 { color: #3438A7; border-bottom: 1px solid #3438A7; }

	@media only screen and (max-width: 1250px) {
	h2 {margin-top:0px; font-size: 20px !important;}
	.nl-form {font-size: 20px;}
	p {font-size: 20px !important;}
	}

	@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	h2 {margin-top:0px; font-size: 24px !important;}
	.nl-form {font-size: 24px;}

	}
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quiz Question #6"); ?></h1>
				<div class="placeholder">
					<h2><?php echo _("Select the correct words to fill in the blanks."); ?></h2>
					<form id="nl-form" class="nl-form">
						<?php echo _("Water is found on Earth's surface as a liquid in lakes, rivers, streams and oceans and as a solid in glaciers, snow cover and ice. The radiant energy of the sun heats water and causes it to"); ?>
						<select id="opt1">
							<option value="" selected>&#60;<?php echo _("select"); ?>&#62;</option>
							<option value="condense"><?php echo _("condense"); ?></option>
							<option value="radiate"><?php echo _("radiate"); ?></option>
							<option value="precipitate"><?php echo _("precipitate"); ?></option>
							<option value="evaporate"><?php echo _("evaporate"); ?></option>
						</select>
						<?php echo _("into water vapor. The water vapor then rises into the air and collects in clouds. Eventually, the water vapor cools enough to"); ?>
						<select id="opt2">
							<option value="" selected>&#60;<?php echo _("select"); ?>&#62;</option>
							<option value="condense"><?php echo _("condense"); ?></option>
							<option value="radiate"><?php echo _("radiate"); ?></option>
							<option value="precipitate"><?php echo _("precipitate"); ?></option>
							<option value="evaporate"><?php echo _("evaporate"); ?></option>
						</select>
						<?php echo _("or change back into very small droplets of water. These small droplets of water combine into bigger droplets that then fall back to Earth as"); ?>
						<select id="opt3">
							<option value="" selected>&#60;<?php echo _("select"); ?>&#62;</option>
							<option value="condense"><?php echo _("condense"); ?></option>
							<option value="radiate"><?php echo _("radiate"); ?></option>
							<option value="precipitate"><?php echo _("precipitate"); ?></option>
							<option value="evaporate"><?php echo _("evaporate"); ?></option>
						</select> 
						<?php echo _("in the form of rain, sleet, hail or snow."); ?>
						<div class="nl-overlay"></div>
					</form>
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _("Quiz Question #6"); ?> - <?php echo _("How did I do?"); ?></h1>
				<div class="placeholder">
					<p><?php echo _("You answered..."); ?></p>
					<p><?php echo _("Water is found on Earth's surface as a liquid in lakes, rivers, streams and oceans and as a solid in glaciers, snow cover and ice. The radiant energy of the sun heats water and causes it to <span id='ans1'></span> (to change from a liquid into a water vapor). The water vapor then rises into the air and collects in clouds. Eventually, the water vapor cools enough <span id='ans2'></span> or change back into very small droplets of water. These small droplets collect into bigger droplet and fall back to earth's surface or <span id='ans3'></span> as liquid rain or solid snow, hail, or sleet."); ?></p>
					<div><p><img id="answer-icon"><span id="feedback"></span></p></div>
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
		<a href="22.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="22.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Is it raining?"); ?></strong></section></section>
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
		ans1,
		ans2,
		ans3;
		
	$(document).ready(function() {
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "20.php";
			} else if (answer.is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					question.fadeIn();
				});
			}
		});
		
		check.click(function(e){
			checkNull();
			console.log(nullAnswer);
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
					
					/* For checking */
					answer1 = $('#opt1').val() + '-' + $('#opt2').val() + '-' + $('#opt3').val();
					$('#ans1').text($('#opt1 option:selected').text());
					$('#ans2').text($('#opt2 option:selected').text());
					$('#ans3').text($('#opt3 option:selected').text());
					
					ans1 = $('#opt1').val();
					ans2 = $('#opt2').val();
					ans3 = $('#opt3').val();
					
					if(answer1 == 'evaporate-condense-precipitate') {
						textstr =  '<?php echo _("Correct! The water cycle consists of evaporation where water turns into vapor, condensation where the vapor turns into small droplets of water that combine into larger droplets that fall back to Earth as precipitation in the form of rain, sleet, hail and snow."); ?>';
						answericon.attr("src", "images/others/correct.png");
						feedback.addClass('green');
					} else {
						textstr =  '<?php echo _("Not quite! The water cycle consists of evaporation where water turns into vapor, condensation where the vapor turns into small droplets of water that combine into larger droplets that fall back to Earth as precipitation in the form of rain, sleet, hail and snow."); ?>';
						answericon.attr("src", "images/others/wrong.png");
						answericon.addClass('img-align');
						feedback.removeClass();
						feedback.addClass('red');
					}
					feedback.text(textstr);
					/* End checking */
					
					if(answered == 0) {
						saveAnswer('solar-power-qq6-a', ans1);
						saveAnswer('solar-power-qq6-b', ans2);
						saveAnswer('solar-power-qq6-c', ans3);
						answered = 1;
					} // end save to db
					
				}); // end question fade
			} // end else
		}); // end check
	}); // end doc ready
	
	function checkNull() {
		if($('#opt1').val() == 0 || $('#opt2').val() == 0 || $('#opt3').val() == 0) nullAnswer = true;
	}
	</script>
	<script src="scripts/nlform.js"></script>
	<script>
		var nlform = new NLForm( document.getElementById( 'nl-form' ) );
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
