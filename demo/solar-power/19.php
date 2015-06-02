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
<script src="scripts/modernizr.min.js"></script>
<script src="scripts/jquery.wiggle.min.js"></script>
<script src="scripts/jquery.blink.min.js"></script>
<script src="scripts/global.js"></script>
<script src="scripts/jpreloader.min.js"></script>
<script src="scripts/jquery.jplayer.min.js"></script>
<script src="scripts/save-answer.js"></script>
<style>
	html, body {overflow: hidden;} 
	.wrap { overflow: hidden; }

h1 {margin-left: 1%; margin-right: 1%; padding-top: 10px;}
h2	{ padding-bottom:0px; margin-top:  -10px}

.bg { background: url('images/19/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
#answer-icon { display: inline-block; height: 30px; margin-right: 10px; }
#question .placeholder, #answer .placeholder { /* background: rgba(255,255,255,0.5); */ border-radius: 10px;padding: 0px 10px 10px 10px;}
/* img.next-toggle { display: none; } */
#buttons .next { display: none; }
#jquery_jplayer_1 { margin: 20px auto -40px; }
#jp_video_0 { height: auto !important; width: 340px; margin: 0 auto;  }
.ac-custom { padding: 0 0 0 25px; margin: 0; }
.ac-custom ul  { padding: 0; margin: 0; }
.ac-custom li { padding: 15px 0; }
.ac-custom label { padding-left: 60px; font-size: 24px; color: #000; }
.ac-custom input[type="radio"]:checked + label { color: orange !important;  }
.ac-custom svg path { stroke: #FFF1CB; }
#answer p { text-align: center; }


.ac-radio label::before { background-color: #FFA300;  color: #FFA300;}

html[dir="rtl"] .ac-custom label { padding:0 80px 0 0;  }
html[dir="rtl"] .ac-custom input[type="checkbox"], .ac-custom input[type="radio"], .ac-custom label::before { right:0; }
html[dir="rtl"] .ac-custom svg { right:5px; }

	<?php if($language == "ar_EG") { ?>
	 .lang-menu ul {margin-right: -9999px !important} 
	.lang-menu ul {left: 9999px }
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
				<h1><?php echo _("Quiz Question #4"); ?></h1>
				<div class="placeholder">
					<h2><?php echo _("Click on the statement that is <span class='red blink'>not</span> <span class='red blink'>true</span>."); ?></h2>

					<div class="video-container">
						<div id="jquery_jplayer_1"></div>
						<div id="jp_container_1"></div>
					</div>

					<form class="ac-custom ac-radio ac-fill" autocomplete="off">
						<ul>
							<li>
								<input id="a1" type="radio" name="q1" value="A">
								<label for="a1"><?php echo _("Every hour the earth makes one full rotation on its axis."); ?></label>
							</li>
							<li>
								<input id="a2" type="radio" name="q1" value="B">
								<label for="a2"><?php echo _("The earth's rotation causes the Sun's position in the sky to change."); ?></label>
							</li>
							<li>
								<input id="a3" type="radio" name="q1" value="C">
								<label for="a3"><?php echo _("When we are on the side of the earth facing the sun, it is daytime."); ?></label>
							</li>
							<li>
								<input id="a4" type="radio" name="q1" value="D">
								<label for="a4"><?php echo _("The sun only seems to rise and set every day."); ?></label>
							</li>
						</ul>
					</form>
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _("Quiz Question #4"); ?> - <?php echo _("How did I do?"); ?></h1>
				<div class="placeholder">
					<p><?php echo _("You answered..."); ?></p>
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
		<a href="20.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="20.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Spinning...spinning..."); ?></strong></section></section>
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
		answericon = $('#answer-icon');
		
	$(document).ready(function() {
		back.click(function() {
			if(question.is(':visible')) {
				document.location.href = "18.php";
			} else if (answer.is(':visible')) {
				next.fadeOut(function() { check.fadeIn(); });
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
					if($('#a1').is(':checked')) {
						textanswer.text("<?php echo _('Every hour the earth makes one full rotation on its axis.'); ?>");
						textstr = "<?php echo _('Super! The Earth makes one full rotation in 24 hours, not one hour'); ?>.";
						answericon.attr("src", "images/others/correct.png");
						feedback.addClass('green');
						answer1 = "A";
					} else {
						if($('#a2').is(':checked')) {
							textanswer.text("<?php echo _("The earth's rotation causes the Sun's position in the sky to change."); ?>");
							textstr = "<?php echo _("Nope! This statement is true. The sun does not really rise and set every day, it is the earth's rotation that makes it seem this way."); ?>";
							answer1 = "B";
						} else if ($('#a3').is(':checked')) {
							textanswer.text("<?php echo _('When we are on the side of the earth facing the sun, it is daytime.'); ?>");
							textstr = "<?php echo _('Not quite! This statement is true. It is daytime for the side of the Earth that faces the Sun.'); ?>";
							answer1 = "C";
						} else if ($('#a4').is(':checked')) {
							textanswer.text("<?php echo _('The sun only seems to rise and set every day.'); ?>");
							textstr = "<?php echo _("Think again! This statement is true. The sun does not really rise and set every day, it is the earth's rotation that makes it seem this way."); ?>";
							answer1 = "D";
						}
						answericon.attr("src", "images/others/wrong.png");
						answericon.addClass('img-align');
						feedback.addClass('red');
					}
					feedback.text(textstr);
					
					
					/* End checking */
				});
			}
			 
		});
	});
	
	function checkNull() {
		if(!$('input:radio').is(':checked')) {
			nullAnswer = true;
		}
	}

	$("#jquery_jplayer_1").jPlayer({
		ready: function () {
			$(this).jPlayer("setMedia", {
				webmv: "images/19/earth.webm"		 
			}).jPlayer("play");
		},
		
		ended: function() { // The $.jPlayer.event.ended event
			$(this).jPlayer("play"); // Repeat the media
		},

		swfPath: "scripts",
		supplied: "webmv",
		size: {
			 width: "340px",
			 height: "250px"
		},
		solutions: "flash, html",
		nativeVideoControls: {
			all: /./
		}
	});

	</script>
	<script src="scripts/svgcheckbx.js"></script>
	<?php include("setlocale.php"); ?>
</body>
</html>
