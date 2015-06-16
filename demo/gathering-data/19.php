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
<link rel="stylesheet" type="text/css" href="styles/locale.css" />
<link rel="stylesheet" type="text/css" href="styles/fonts.css" />
<link rel="stylesheet" type="text/css" href="styles/jpreloader.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
<link rel="stylesheet" type="text/css" href="styles/nlform-default.css" />
<link rel="stylesheet" type="text/css" href="styles/nlform-component.css" />
<script src="scripts/jquery.min.js"></script>
<script src="scripts/modernizr.min.js"></script> <!-- This is used to detect HTML5 and CSS3 in the user's browser -->
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/save-answer.js"></script>

<style>
.wrap { border-left: 1px dashed #c1d0e5; border-right: 1px dashed #c1d0e5; }
.bg { background: url('images/17/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
img.next-toggle { display: none; }

.nl-form { font-size: 27px; text-align: center;margin:0; }
.nl-form p{padding:0;}
#ans1, #ans2, #ans3, #ans4 { color: #FF552A; }
#cycle {margin: 40px auto; 0}
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _('Quiz Question #4'); ?> - <?php echo _('How did I do?'); ?></h1>
				<h2><?php echo _("Click on '&#60;select&#62;' and pull down menu to choose answer."); ?></h2>
				<form id="nl-form" class="nl-form">
					<p><?php echo _('A.'); ?> <?php echo _('One inch is a little bit more than 2 times a'); ?>
					<select id="opt1">
						<option value="1" selected>&#60;<?php echo _('select'); ?>&#62;</option>
						<option value="meter"><?php echo _('meter'); ?></option>
						<option value="centimeter"><?php echo _('centimeter'); ?></option>
						<option value="kilometer"><?php echo _('kilometer'); ?></option>
					</select>. </p>
					<p><?php echo _('B.'); ?> <?php echo _('One way to reduce the error in measurement is to make many measurements and'); ?>
					<select id="opt2">
						<option value="1" selected>&#60;<?php echo _('select'); ?>&#62;</option>
						<option value="average"><?php echo _('average'); ?></option>
						<option value="add"><?php echo _('add'); ?></option>
						<option value="estimate"><?php echo _('estimate'); ?></option>
					</select> <?php echo _("them."); ?> </p>
					<p><?php echo _('C.'); ?> <?php echo _('1 ounce is about 28 times more than a'); ?>
					<select id="opt3">
						<option value="1" selected>&#60;<?php echo _('select'); ?>&#62;</option>
						<option value="pound"><?php echo _('pound'); ?></option>
						<option value="kilogram"><?php echo _('kilogram'); ?></option>
						<option value="gram"><?php echo _('gram'); ?></option>
					</select> . </p>
					<p><?php echo _('D.'); ?> <?php echo _('The term'); ?>
					<select id="opt4">
						<option value="1" selected>&#60;<?php echo _('select'); ?>&#62;</option>
						<option value="instrument"><?php echo _('instrument'); ?></option>
						<option value="data"><?php echo _('data'); ?></option>
						<option value="measurement"><?php echo _('measurement'); ?></option>
					</select> <?php echo _('refers to information gathered through observation.'); ?> </p>
					<div class="nl-overlay"> </div>
				</form>
				<div id="cycle">
					<img src="images/19/a.jpg">
					<img src="images/19/b.jpg">
					<img src="images/19/c.jpg">
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _('Quiz Question #4'); ?> - <?php echo _('How did I do?'); ?></h1>
				<p><?php echo _('You answered...'); ?></p>
				
				<p>a. <?php echo _('One inch is a little bit more than 2 times a'); ?> <span id="ans1"> </span>. </p>
				<p>b. <?php echo _('One way to reduce the error in measurement is to make many measurements and'); ?> <span id="ans2"> </span> <?php echo _('them.'); ?></p>
				<p>c. <?php echo _('1 ounce is about 28 times more than a'); ?> <span id="ans3"> </span>.</p>
				<p>d. <?php echo _('The term'); ?> <span id="ans4"> </span> <?php echo _('refers to information gathered through observation.'); ?></p>
				
				<div><p><img id="answer-icon"><span id="feedback"></span></p></div>
			</div>
		</div>
	</div>
	<div class="buttons-back" title="<?php echo _("Back"); ?>">
		<a href="#" class="wiggle-right"><img class="back-toggle" src="images/buttons/back.png"></a>
	</div>
	<div class="buttons">
		<a href="#answer" class="wiggle"><img class="check-toggle" src="images/buttons/check-answer.png" title="<?php echo _("Check Answer"); ?>"></a>
		<a href="20.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _("Next"); ?>"></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _('Averaging measurements...'); ?></strong></section></section>
	<script src="scripts/cycle.js"></script>
	<script>$('#cycle').cycle('zoom,fade,turnDown,curtainX');</script>
	<script>
	var answer1,
		answered = 1,
		textstr = "",
		nullAnswer = false,
		back = $('img.back-toggle'),
		next = $('img.next-toggle'),
		check = $('img.check-toggle'),
		question = $('#question'),
		answer = $('#answer'),
		textanswer = $('#textanswer'),
		feedback = $('#feedback'),
		answericon = $('#answer-icon');
	
	
	$(document).ready(function() {
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "18.php";
			} else if (answer.is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
				answer.fadeOut(function() {
					question.fadeIn();
				});
			}
		});
		
		check.click(function(e){
			checkNull();
			//console.log(nullAnswer);
			if(nullAnswer == true) {
				e.preventDefault();
				window.location.hash = '';
				alert("<?php echo _("Please select your answers."); ?>");
				nullAnswer = false;
			} else {
				check.fadeOut(function() { next.fadeIn(); });
				question.fadeOut(function(){ 
					answer.fadeIn();
					window.location.hash = '#answer';
					
					/* For checking */
					answer1 = $('#opt1').val() + '-' + $('#opt2').val() + '-' + $('#opt3').val() + '-' + $('#opt4').val();
					$('#ans1').text($('#opt1 option:selected').text());
					$('#ans2').text($('#opt2 option:selected').text());
					$('#ans3').text($('#opt3 option:selected').text());
					$('#ans4').text($('#opt4 option:selected').text());
					
					//console.log(answer1);
					
					if(answer1 == 'centimeter-average-gram-data') {
						textstr =  ' <?php echo _("You got it! Centimeter, meter, and kilometer are all units of length and distance in the metric system. Averaging measurements made is a good way to reduce error in measurement. Grams and kilograms are the units of mass in the metric systems. Data are information gathered through observation."); ?>';
						answericon.attr("src", "images/others/correct.png");
						feedback.addClass('green');
					} else {
						textstr =  ' <?php echo _("Not quite! Centimeter, meter, and kilometer are all units of length and distance in the metric system. Averaging measurements made is a good way to reduce error in measurement. Grams and kilograms are the units of mass in the metric systems. Data are information gathered through observation."); ?>';
						answericon.attr("src", "images/others/wrong.png");
						answericon.addClass('img-align');
						feedback.removeClass();
						feedback.addClass('red');
					}
					feedback.text(textstr);
					/* End checking */
					
					if(answered == 0) {
						saveAnswer('gathering-data-qq4-a', $('#opt1').val());
						saveAnswer('gathering-data-qq4-b', $('#opt2').val());
						saveAnswer('gathering-data-qq4-c', $('#opt3').val());
						saveAnswer('gathering-data-qq4-d', $('#opt4').val());
						answered = 1;
					} // end save to db
					
				}); // end question fade
			} // end else
		}); // end check
	}); // end doc ready
	
	function checkNull() {
		if($('#opt1').val() == 1 || $('#opt2').val() == 1 || $('#opt3').val() == 1 || $('#opt4').val() == 1) nullAnswer = true;
	}
	</script>
	<script src="scripts/nlform.js"></script>
	<script>
		var nlform = new NLForm( document.getElementById( 'nl-form' ) );
	</script>
<script src="scripts/jpreloader.js"></script>
<?php include("setlocale.php"); ?>
</body>
</html>
