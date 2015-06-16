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
.bg { background: url('images/7/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
#buttons .next { display: none; }
#answer-icon1, #answer-icon2 { display: inline-block; height: 30px; margin-right: 10px; }
#question .placeholder, #answer .placeholder { /* background: rgba(255,255,255,0.5); */border-radius: 10px;padding: 10px;margin-right: 3px;}
h2 { margin: 0; }
#question1 { width: 100%; margin-bottom: 10px; }
#question1 ul { width: 100%; margin: 0 auto; padding: 0; list-style-type: none; }
#question1 li { float: left; width: 208px; }
#question1 input[type=radio] { display: none; }
#choices1 label { display: block; text-align: center; cursor: pointer; }
#choices1 input[type="radio"] + label img { border: 4px solid transparent; -webkit-transition: all .3s ease; }
#choices1 input[type="radio"]:checked + label img { border: 4px solid #FFF500; -webkit-transition: all .3s ease; -webkit-backface-visibility: hidden; }
#choices1 input[type="radio"] + label span { color: #000; -webkit-transition: all .3s ease; }
#choices1 input[type="radio"]:checked + label span { color: #AAA300; -webkit-transition: all .3s ease; }
#question1 img { width: 200px; }
#question1 label { font-size: 24px; }

#question2 { margin-top: 20px; }

#choices2 { margin: 10px 0 0 20px; }
#choices2 input[type=radio].css-radio { display:none; }
#choices2 input[type=radio].css-radio + label.css-label {
	background-image: url('images/7/unchecked.png');
	height:40px; 
	display:inline-block;
	line-height:30px;
	background-repeat:no-repeat;
	background-position: 0 3px;
	background-size: 20px 20px;
	font-size:24px;
	vertical-align:middle;
	cursor:pointer;
	padding-left: 35px;
}

#choices2 input[type=radio].css-radio:checked + label.css-label { color: #c32222; background-image: url('images/7/checked.png'); }
#choices2 label.css-label {
	-webkit-touch-callout: none;
	-webkit-user-select: none;
	-khtml-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}

#answer p { text-align: center; padding: 0;}
figure {margin-bottom:0;margin-top:0;text-align:center}
#answer figure img{height:180px; }
#answer .answer-item { margin-top: 1%; }
html[dir="rtl"] #choices2 input[type=radio].css-radio + label.css-label { padding-right:35px;background-position-x:right; } 

@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	#question1 li { width: 170px; }
	#question1 img { width: 160px; }
}	

	
	@media only screen and (min-width: 1040px) and (max-width: 1250px) {
		#answer p {height:20px;} 
		#question1 label {font-size: 20px;}
		 p {height:36px; font-size: 20px;}
		
		#choices1 input[type="radio"] + label span, #choices2 input[type=radio].css-radio + label.css-label, #answer p{font-size: 20px;}
		#answer p {height:30px;}
	}


	@media only screen and (max-width: 1040px) {

		#question1 label {font-size: 20px;}
		p {height:36px; font-size: 20px;}
		#choices1 input[type="radio"] + label span, #choices2 input[type=radio].css-radio + label.css-label, #answer p{font-size: 20px;}
		#answer p {height:30px;}
		#question1 img {height: 120px !important; width: 175px !important;}

		#question1 li {width: 192px;}
	}

	@media only screen and (max-width: 978px) {
		body, h2 {font-size: 20px !important}

		#question1 label {font-size: 20px;}
		p {height:36px; font-size: 20px;}
		#choices1 input[type="radio"] + label span, #choices2 input[type=radio].css-radio + label.css-label, #answer p{font-size: 20px;}
		#answer p {height:30px;}
		#question1 img {height: 110px !important; width: 160px !important;}

		#question1 li {width: 170px;}

				#answer figure img {height: 150px;}
	}

	@media only screen and (max-width: 767px) {
		body, h2 {font-size: 18px !important}

		#question1 label {font-size: 20px;}
		p {height:36px; font-size: 20px;}
		#answer p{font-size: 20px;}
		#answer p {height:30px;}
		#question1 img {height: 95px !important; width: 125px !important;}
		#choices1 input[type="radio"] + label span, #choices2 input[type=radio].css-radio + label.css-label {font-size: 18px}
		#question1 li {width: 136px;}

				#answer figure img {height: 150px;}
	}

	@media only screen and (max-width: 600px) {
		body, h2 {font-size: 18px !important}

		#question1 label {font-size: 18px;}
		p {height:36px; font-size: 20px;}
		#answer p{font-size: 20px;}
		#answer p {height:30px;}
		#question1 img {height: 75px !important; width: 100px !important;}

		#choices1 input[type="radio"] + label span, #choices2 input[type=radio].css-radio + label.css-label {font-size: 18px}
		#question1 li {width: 112px;}
		
		#answer figure img {height: 100px;}
		#answer .answer-item {margin-top:12%;}
	}
<?php if($language == "ar_EG") { ?>
	@media only screen and (max-width: 1040px) {
	#question1 li { float: right !important; }
	}
<?php } ?>
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quick Check #2"); ?></h1>
				<div class="placeholder">
					<div id="question1">
						<h2><?php echo _("Question A. Which part of the water cycle does the sun directly effect?"); ?></h2>
						<ul id="choices1">
							<li>
								<input type="radio" id="a1" name="q1" value="A">
								<label for="a1"><img src="images/7/1.jpg"><span><?php echo _("Evaporation"); ?></span></label>
							</li>
							<li>
								<input type="radio" id="a2" name="q1" value="B">
								<label for="a2"><img src="images/7/2.jpg"><span><?php echo _("Condensation"); ?></span></label>
							</li>
							<li>
								<input type="radio" id="a3" name="q1" value="C">
								<label for="a3"><img src="images/7/3.jpg"><span><?php echo _("Precipitation"); ?></span></label>
							</li>
							<li>
								<input type="radio" id="a4" name="q1" value="D">
								<label for="a4"><img src="images/7/4.jpg"><span><?php echo _("None of the above"); ?></span></label>
							</li>
						</ul>
						<div class="clear"></div>
					</div>
				
					<div id="question2">
						<h2><?php echo _("Question B. Which statement best describes the relationship between the sun and life on earth?"); ?></h2>
						<div id="choices2">
							<input type="radio" id="b1" name="q2" class="css-radio">
							<label for="b1" class="css-label">A. <?php echo _("The sun damages life on earth."); ?></label><br>
							<input type="radio" id="b2" name="q2" class="css-radio">
							<label for="b2" class="css-label">B. <?php echo _("The sun powers life on earth."); ?></label><br>
							<input type="radio" id="b3" name="q2" class="css-radio">
							<label for="b3" class="css-label">C. <?php echo _("The sun protects life on earth."); ?></label><br>
							<input type="radio" id="b4" name="q2" class="css-radio">
							<label for="b4" class="css-label">D. <?php echo _("All of the above"); ?></label>
						</div>
					</div>
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _("Quick Check #2"); ?> - <?php echo _("How did I do?"); ?></h1>
				<div class="placeholder">
						<h2><?php echo _("Question A. Which part of the water cycle does the sun directly effect?"); ?></h2>
						<p><?php echo _("You answered..."); ?></p>
						<figure>
						<img src="" id="selected_img" />
					</figure>
						<p><span id="textanswer1"></span></p>
						<p><img id="answer-icon1"><span id="feedback1"></span></p>
					</figure>
					<br>
					<div class="answer-item">
						<h2><?php echo _("Question B. Which statement best describes the relationship between the sun and life on earth?"); ?></h2>
						<p><?php echo _("You answered..."); ?></p>
						<p><span id="textanswer2"></span></p>
						<p><img id="answer-icon2"><span id="feedback2"></span></p>
					</div>
				</div>
			</div>		
		</div>
	</div>
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="8.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("It's a sunny day..."); ?></strong></section></section>
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
				document.location.href = "6.php#screen3";
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
					if($('#a1').is(':checked')) {
						textanswer1.text("<?php echo _('Evaporation'); ?>");
						$('#selected_img').attr("src","images/7/1.jpg");
						textstr = "<?php echo _('You got it! The sun provides heat which causes water to evaporate.'); ?>";
						answericon1.attr("src", "images/others/correct.png");
						feedback1.addClass('green');
						answer1 = "A";
					} else {
						if($('#a2').is(':checked')) {
							textanswer1.text("<?php echo _('Condensation'); ?>");
							$('#selected_img').attr("src","images/7/2.jpg");
							textstr = "<?php echo _('Not quite! Once ocean water is evaporated, it condenses into clouds. So the sun plays a role in condensation, but is an indirect role.'); ?>";
							answer1 = "B";
						} else if ($('#a3').is(':checked')) {
							textanswer1.text("<?php echo _('Precipitation'); ?>");
							$('#selected_img').attr("src","images/7/3.jpg");
							textstr = "<?php echo _('Nope! The sun directly affects evaporation. But evaporation leads to condensation then precipitation. So the sun affects the entire water cycle, but directly affects evaporation.'); ?>";
							answer1 = "C";
						} else if ($('#a4').is(':checked')) {
							textanswer1.text("<?php echo _('None of the above'); ?>");
							$('#selected_img').attr("src","images/7/4.jpg");
							textstr = "<?php echo _('Think again! The sun affects the entire water cycle, but directly affects evaporation.'); ?>";
							answer1 = "D";
						}
						answericon1.attr("src", "images/others/wrong.png");
						answericon1.addClass('img-align');
						feedback1.addClass('red');
					}
					feedback1.text(textstr);
					/* End checking of question A */
					
					/* For checking of question B */
					if($('#b2').is(':checked')) {
						textanswer2.text("B. " + "<?php echo _('The sun powers life on earth.'); ?>");
						textstr = "<?php echo _('Right on! The sun gives life to everything on earth.'); ?>";
						answericon2.attr("src", "images/others/correct.png");
						feedback2.addClass('green');
						answer2 = "B";
					} else {
						if($('#b1').is(':checked')) {
							textanswer2.text("A. " + "<?php echo _('The sun damages life on earth.'); ?>");
							textstr = "<?php echo _('Nope! The opposite; the sun powers life on earth.'); ?>";
							answer2 = "A";
						} else if ($('#b3').is(':checked')) {
							textanswer2.text("C. " + "<?php echo _('The sun protects life on earth.'); ?>");
							textstr = "<?php echo _("Not quite! The sun doesn't protect things on earth, it gives life to them."); ?>";
							answer2 = "C";
						} else if ($('#b4').is(':checked')) {
							textanswer2.text("D. " + "<?php echo _('All of the above'); ?>");
							textstr = "<?php echo _('Think again! The sun does not damage or protect life on earth, it powers it.'); ?>";
							answer2 = "D";
						}
						answericon2.attr("src", "images/others/wrong.png");
						answericon2.addClass('img-align');
						feedback2.addClass('red');
					}
					feedback2.text(textstr);
					/* End checking of question B */
					
					if(answered == 0) {
						saveAnswer('solar-power-qc2-a', answer1);
						saveAnswer('solar-power-qc2-b', answer2);
						answered = 1;
					} // end save to db
				}); // end question fade
			} // end else
		}); // end check answer
	}); // end doc ready
	
	function checkNull() {
		if(!$('#choices1 input:radio').is(':checked')) {
			nullAnswer = true;
		}
		
		if(!$('#choices2 input:radio').is(':checked')) {
			nullAnswer = true;
		}
	}
	</script>
	<?php include("setlocale.php"); ?>
</body>
</html>
