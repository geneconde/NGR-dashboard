<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(9, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'solar-power-qc3-a');
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
<link rel="stylesheet" type="text/css" href="styles/svgcomponent.css" />
<link rel="stylesheet" type="text/css" href="styles/global.css" />
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
	h2 {padding-bottom: 0px;}
.bg { background: url('images/9/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
.wrap {border-left: 1px dashed #FE7F83; border-right: 1px dashed #FE7F83;}
#answer { display: none; }
#answer-icon1, #answer-icon2 { display: inline-block; height: 30px; margin-right: 10px; }
#buttons .next { display: none; }
#question .placeholder, #answer .placeholder { background: rgba(255,255,255,0.5);border-radius: 10px;position: absolute; padding: 10px 10px 0 10px;margin-right: 21px;}
#question1 .ac-custom { width: 50%; margin: 0; padding: 0 0 0 30px; float: left; }
#question1 .ac-custom label { font-size: 30px; font-weight: normal; color: #000; padding: 0 0 0 80px; }
#question1 .ac-circle label::before { background-color: #FFA300; }
#question1 .ac-custom svg path { stroke: #FFA300; }
#question1 .ac-custom li { padding: 10px 0px; }
#question2 .ac-custom li { padding: 3px 0; }
#question2 .ac-custom { width: 60%; margin: 0; padding: 0; float: left; padding: 0px 10px; }
#question2 .ac-custom label { font-size: 18px; font-weight: normal; color: #000; padding: 0 0 0 50px; }
#question2 .ac-custom input[type="checkbox"], #question2 .ac-custom label::before { width: 40px; height: 40px; border: 4px solid #FFA300; }
#question2 .ac-custom svg { width: 30px; height: 30px; }
#question2 .ac-custom svg path { stroke: #FFA300; }

#question2 .ac-custom li:first-child svg { margin-top: -25px; }
#img-holder1 { width: 35%; height: 180px; float: left; }
#img-holder1 img { height: 100%; }
#img-holder2 { float: left; width: 20%; }
#img-holder2 img { width: 100%; }
#img-holder3 { float: right; width: 20%; }
#img-holder3 img { width: 100%; }
#question1 .ac-custom input[type="radio"]:checked + label { color: #000; }
#question2 .ac-custom input[type="checkbox"]:checked + label { color: #000; }
#question2 {margin-top:0px; position: relative; z-index: 6; }
#answer p { text-align: center; }
.answer-item2 {margin-top:45px;}
#question2 .ac-custom li:nth-child(5), #question2 .ac-custom li:nth-child(4) {padding-top:15px;}

html[dir="rtl"] #question1 .ac-custom { float:right; } 
html[dir="rtl"] #question1 #img-holder1 { margin-left:90px; }
html[dir="rtl"] #question1 .ac-custom label { padding:0 80px 0 0;width:260px; }
html[dir="rtl"] #question1 .ac-circle label::before { right:30px; }
html[dir="rtl"] #question1 .ac-circle svg { right:10px; }

html[dir="rtl"] #question2 .ac-custom li { padding:9px 0; }
html[dir="rtl"] #question2 .ac-custom input[type="checkbox"], .ac-custom input[type="checkbox"], .ac-custom label::before { right:0; }
html[dir="rtl"] #question2 .ac-custom label { padding:0 50px 7px 0; }
html[dir="rtl"] #question2 .ac-custom svg { right:5px; }
html[dir="rtl"] #question .placeholder, html[dir="rtl"] #answer .placeholder { margin-left: 21px; margin-right: 0; }

<?php if($language == "zh_CN") { ?>
		#question2 .ac-custom li { padding:10px 0 !important; }
		#question2 .ac-custom input[type="checkbox"], .ac-custom input[type="checkbox"], .ac-custom label::before { right:0; }
		#question2 .ac-custom label { padding:0 0 0 50px ; }
		#question2 .ac-custom svg { right:5px; }

<?php } ?>

<?php if($language == "es_ES") { ?>
	#question2 .ac-custom label {  padding: 0px 2px 0px 50px;}
	#question2 {  margin-top: 0px;}
	@media only screen and (max-width: 1249px) {
	#question2 .ac-custom li {padding: 2px 0px !important;}
	}
<?php } ?>

<?php if($language == "ar_EG") { ?>
	@media only screen and (max-width: 1250px) {
	#question2 .ac-custom label {font-size:16px !important;}

	}
<?php } ?>

@media only screen and (max-width: 1250px) {
	#question1 .ac-custom label {font-size: 20px;}
	#img-holder1 img {height:90%; }
	#img-holder1 {height:  140px;}
	#question2 {margin-top: 0px;}
	#question2 .ac-custom li {padding:0px 0px;}
	.ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before {top:61% !important;}

	.ac-circle svg {width:70px; height:50px;margin-top:-22px;}
	#answer p {font-size: 20px !important;}
}

@media only screen and (max-width: 700px) {
	#question2 .ac-custom label {font-size: 16px !important;}
	h2 {font-size: 18px !important;}
	#answer p {font-size: 18px !important;}
}

@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	#img-holder1 img {height:100%}
}	
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quick Check #3"); ?></h1>
				<div class="placeholder">
				<div id="question1">
					<h2><?php echo _("Question A. How long does it take the moon to travel once around the earth?"); ?></h2>
					<form class="ac-custom ac-radio ac-circle" autocomplete="off">
						<ul>
							<li>
								<input id="a1" name="r1" type="radio">
								<label for="a1" class="css-label"><?php echo _("24 hours"); ?></label>
							</li>
							<li>
								<input id="a2" name="r1" type="radio">
								<label for="a2" class="css-label"><?php echo _("28 days"); ?></label>
							</li>
							<li>
								<input id="a3" name="r1" type="radio">
								<label for="a3" class="css-label"><?php echo _("12 months"); ?></label>
							</li>
						</ul>
					</form>
					<div id="img-holder1">
						<img src="images/9/q1a.jpg">
					</div>
				</div>
				<div class="clear"></div>
				<div id="question2">
					<h2><?php echo _("Questions B. Look at the two pictures of the same runner and click on <span class='red blink'>all</span> the correct statements below."); ?></h2>
					<div id="img-holder2">
						<img src="images/9/q2b.jpg">
					</div>
					<form class="ac-custom ac-checkbox ac-checkmark" autocomplete="off">
						<ul>
							<li>
								<input id="b1" name="r2" type="checkbox">
								<label for="b1" class="css-label"><?php echo _("In both pictures the runner is running at the same time of the day."); ?></label>
							</li>
							<li>
								<input id="b2" name="r2" type="checkbox">
								<label for="b2" class="css-label"><?php echo _("The shadows for both runners will not change as the people walk."); ?></label>
							</li>
							<li>
								<input id="b3" name="r2" type="checkbox">
								<label for="b3" class="css-label"><?php echo _("Knowing the position of the sun at the same time the shadows are created, the time of the day can be estimated."); ?></label>
							</li>
							<li>
								<input id="b4" name="r2" type="checkbox">
								<label for="b4" class="css-label"><?php echo _("Both runners are facing the sun."); ?></label>
							</li>
							<li>
								<input id="b5" name="r2" type="checkbox">
								<label for="b5" class="css-label"><?php echo _("The shadow created in the picture on the right is most likely created closer to noon than the shadow on the left."); ?></label>
							</li>
						</ul>
					</form>
					<div id="img-holder3">
						<img src="images/9/q2a.jpg">
					</div>
				</div>
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _("Quick Check #3"); ?> - <?php echo _("How did I do?"); ?></h1>
				<div class="placeholder">
					<div class="answer-item">
						<h2><?php echo _("Question A. How long does it take the moon to travel once around the earth?"); ?></h2>
						<p><?php echo _("You answered..."); ?></p>
						<p><span id="textanswer1"></span></p>
						<p><img id="answer-icon1"><span id="feedback1"></span></p>
					</div>
					<div class="answer-item2">
						<h2><?php echo _("Questions B. Look at the two pictures of the same runner and click on <span class='red blink'>all</span> the correct statements below."); ?></h2>
						<!--<p>You answered...</p>
						<p><span id="textanswer2"></span></p>-->
						<p><img id="answer-icon2"><span id="feedback2"></span></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="10.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Checking, checking..."); ?></strong></section></section>
	<script>
	var answer1,
		answer2,
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
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "8.php#screen2";
			} else if (answer.is(':visible')) {
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
					
					/* For checking of question A */
					if($('#a2').is(':checked')) {
						textanswer1.text("<?php echo _('28 days'); ?>");
						textstr = "<?php echo _('Right on! It takes 28 days for the moon to travel once around the earth.'); ?>";
						answericon1.attr("src", "images/others/correct.png");
						feedback1.addClass('green');
						answer1 = "B";
					} else {
						if($('#a1').is(':checked')) {
							textanswer1.text("<?php echo _('24 hours'); ?>");
							textstr = "<?php echo _('Nope! It takes 24 hours for the earth to turn once in its axis.'); ?>";
							answer1 = "A";
						} else if ($('#a3').is(':checked')) {
							textanswer1.text("<?php echo _('12 months'); ?>");
							textstr = "<?php echo _('Not quite! It takes 12 months for the earth to revolve around the sun.'); ?>";
							answer1 = "C";
						}
						answericon1.attr("src", "images/others/wrong.png");
						answericon1.addClass('img-align');
						feedback1.addClass('red');
					}
					feedback1.text(textstr);
					/* End checking of question A */
					
					/* For checking of question B */
					var answer2 = "";
					if($('#b1').is(":checked")) {
						answer2 = "A"; 
						textanswer2.text('<?php echo _("Both runners are walking at the same time of the day."); ?>');
					}
					if($('#b2').is(":checked")) { 
						answer2 += "B";
						textanswer2.text('<?php echo _("The shadows for both runners will not change as the people walk."); ?>');
					}
					if($('#b3').is(":checked")) { 
						answer2 += "C"; 
						textanswer2.text('<?php echo _("Knowing the position of the sun at the same time the shadows are created, the time of the day can be estimated."); ?>');
					}
					if($('#b4').is(":checked")) { 
						answer2 += "D"; 
						textanswer2.text('<?php echo _("Both runners are facing the sun."); ?>');
					}
					if($('#b5').is(":checked")){
						answer2 += "E";
						textanswer2.text('<?php echo _("The shadow created in the picture on the right is most likely created closer to noon than the shadow on the left."); ?>');
					}
					
					if(!$('#b1').is(':checked') && !$('#b2').is(':checked') && $('#b3').is(':checked') && $('#b4').is(':checked') && $('#b5').is(':checked')) {
						textstr = "<?php echo _('You got it! Both shadows are behind the runners, so you can tell they are facing the sun. Knowing the position of the sun at the time the shadow is created, the time of day can be estimated. The time of the shorter shadow is probably closer to noon.'); ?>";
						answericon2.attr("src", "images/others/correct.png");
						feedback2.addClass('green');
					} else {
						textstr = "<?php echo _("Not quite! Based on the shadows you can see it is not the same time of day. No matter the time, a person's shadow will always move with them. Knowing the position of the sun at the time the shadow is created, the time of day can be estimated. The time of the shorter shadow is probably closer to noon. Both shadows are behind the runners, so you can tell they are facing the sun."); ?>";
						answericon2.attr("src", "images/others/wrong.png");
						answericon2.addClass('img-align');
						feedback2.addClass('red');
					}
					feedback2.text(textstr);
					/* End checking of question B */
					
					if(answered == 0) {
						saveAnswer('solar-power-qc3-a', answer1);
						saveAnswer('solar-power-qc3-b', answer2);
						answered = 1;
					} // end save to db
				}); 
			}
			
		});
	});
	
	function checkNull() {
		if(!$('#question1 input:radio').is(':checked')) {
			nullAnswer = true;
		}
		
		if(!$('#question2 input:checkbox').is(':checked')) {
			nullAnswer = true;
		}
	}
	</script>
	<script src="scripts/svgcheckbx.js"></script>
	<?php include("setlocale.php"); ?>
</body>
</html>
