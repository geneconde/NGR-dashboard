<?php 
	require_once "../../session.php";
	$_SESSION['cmodule'] = 'solar-power';
	require_once '../../verify.php';
	require_once "locale.php";
	
	if($user->getType() == 2) {
		$smc->updateStudentLastscreen(11, $_SESSION['smid']);
		$sa = $sac->getStudentAnswer($_SESSION['smid'], 'solar-power-qc4-a');
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
<link rel="stylesheet" type="text/css" href="styles/hexaflip.css" />
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
.bg { background: url('images/7/bg.jpg') no-repeat; background-size: 100% 100%; width: 100%; height: 100%; position: relative; }
#answer { display: none; }
#answer-icon1, #answer-icon2 { display: inline-block; height: 30px; margin-right: 10px; }
#question .placeholder, #answer .placeholder { /* background: rgba(255,255,255,0.5); */border-radius: 10px;position: absolute; padding: 10px 10px 10px 10px;margin-right: 21px;}
/* img.next-toggle { display: none; } */
#buttons .next { display: none; }
#question1 .ac-custom, #answer1 { width: 66%; margin: 0; padding: 0 0 0 10px; float: left; }
#question1 .ac-custom label { font-size: 22px; font-weight: normal; color: #000; padding: 0 0 0 60px; }
#question1 .ac-circle label::before { background-color: #FFA300; width: 25px; height: 25px; }
#question1 .ac-custom svg { width: 65px; height: 65px; }
#question1 .ac-custom svg path { stroke: #FFA300; }
#question1 .ac-custom li, #question2 .ac-custom li { padding: 10px 0px; }
#question1 .ac-custom input[type="radio"]:checked + label { color: #000; }
#question2 p { font-size: 20px; }
#choices2 { width: 70%; float: left; padding-left: 20px; }
.img-holder { width: 266px; float: right; text-align: center; }
.img-holder img { width: 186px; -webkit-border-radius: 0; -moz-border-radius: 0; border-radius: 0; }
#answer p { text-align: center; }

/*
#hexaflip-container { position: relative; overflow: hidden; float: right; margin: 0; width: 245px; margin-top: -18px;}
#hexaflip-container p { color: #000; padding-bottom: 10px; text-align: center; }
#hexaflip { margin-left:45px;}

.hexaflip-cube { text-rendering: optimizeLegibility; -webkit-font-smoothing: antialiased; cursor: move; cursor: -webkit-grab; cursor: -moz-grab; display: inline-block; position: relative; -webkit-transform-style: preserve-3d; -moz-transform-style: preserve-3d; -o-transform-style: preserve-3d; -ms-transform-style: preserve-3d; transform-style: preserve-3d; -webkit-transition: -webkit-transform 0.4s; -moz-transition: -moz-transform 0.4s; -o-transition: -o-transform 0.4s; -ms-transition: -ms-transform 0.4s; transition: transform 0.4s;}
.hexaflip-cube.no-tween { -webkit-transition-duration: 0; -moz-transition-duration: 0; -o-transition-duration: 0; -ms-transition-duration: 0; transition-duration: 0; }
.hexaflip-cube > div { width: 100%; overflow: hidden; height: 100.5%; position: absolute; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; -webkit-background-size: cover; -moz-background-size: cover; background-size: cover; text-align: center; background-color: #333; color: #fff; font-weight: 100; text-shadow: 0 -2px 0 rgba(0,0,0,0.2); line-height: 1.5; }
.hexaflip-left, .hexaflip-right { background-color: #555 !important; }
*/
	#hexaflip-container {position: relative; overflow: hidden; float: right; margin-right: 0px; width: 30%; padding: 0; margin-top: -18px; } 
	#hexaflip-container p { color: #055D79;  padding-bottom: 10px; text-align: center; }
	#hexaflip {margin-left:45px;   margin-left: 20%; margin-right: 20%;}


html[dir="rtl"] #question .placeholder { margin-left:21px;margin-right:0; }
html[dir="rtl"] #answer .placeholder { margin-left:21px;margin-right:0; }
html[dir="rtl"] #question1 .ac-custom { float:right; }
html[dir="rtl"] #answer1 { float:right; }
html[dir="rtl"] .img-holder { float:left; } 
html[dir="rtl"] #question1 .ac-circle input[type="checkbox"], .ac-circle input[type="radio"], .ac-circle label::before { right:10px; }
html[dir="rtl"] #question1 .ac-custom label { padding:0 60px 0 0; }
html[dir="rtl"] #question1 .ac-custom svg { right:2px;left:0; }
html[dir="rtl"] #choices2 { float:right; }
html[dir="rtl"] #hexaflip-container { float:left; }
html[dir="rtl"] #hexaflip { margin:0 auto; }
<?php if($language == "ar_EG") { ?>
	 .lang-menu ul {margin-right: -9999px !important} 
	.lang-menu ul {left: 9999px }
<?php } ?>
<?php if($language == "es_ES"){ ?>
	#question1 .ac-custom label { font-size:20px; }
	#answer .placeholder { margin-right:21px;margin-left:0 !important; }
<?php } ?>
<?php if($language == "zh_CN"){ ?>
	#answer .placeholder { margin-right:21px;margin-left:0 !important; }
<?php } ?>

#question1 .ac-custom label {font-size: 20px;}
.img-holder img {width: 170px;}

@media only screen and (max-width: 900px) {
	#question1 .ac-custom label, p, #question2 p {font-size: 18px !important; } #choices2 {width: 65% !important;} 
	.img-holder img {width: 115px !important;}
	#hexaflip-container p {font-size:16px !important;}
	#question1 .ac-custom, #answer1 {width: 58%;}
}

@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio: 1) {
	#question1 .ac-custom, #answer1, #choices2 { width: 60%; }

}

@media only screen and (max-width: 1250px) {
	#question1 .ac-custom label, p {font-size: 20px} .img-holder img {width:150px;} #question1 .ac-custom li, #question2 .ac-custom li {padding: 5px 0px;} #question1 .ac-custom svg {width:40px; height:65px; left:2px;} #hexaflip-container p {font-size: 18px !important;}
}
</style>
</head>
<body>
	<div class="wrap">
		<div class="bg">
			<div id="question">
				<h1><?php echo _("Quick Check #4"); ?></h1>
				<div class="placeholder">
				<div id="question1">
					<h2><?php echo _("Question A. What cycle caused by the sun is the diagram trying to show? What is the cause of this cycle?"); ?></h2>
					<form class="ac-custom ac-radio ac-circle" autocomplete="off">
						<ul>
							<li>
								<input id="a1" name="r1" type="radio">
								<label for="a1" class="css-label"><?php echo _("Day and night cycle, tilt of the earth on its axis"); ?></label>
							</li>
							<li>
								<input id="a2" name="r1" type="radio">
								<label for="a2" class="css-label"><?php echo _("Occurrence of seasons, tilt of the earth on its axis"); ?></label>
							</li>
							<li>
								<input id="a3" name="r1" type="radio">
								<label for="a3" class="css-label"><?php echo _("Day and night cycle, rotation of the earth on its axis"); ?></label>
							</li>
							<li>
								<input id="a4" name="r1" type="radio">
								<label for="a4" class="css-label"><?php echo _("Occurrence of seasons, rotation of the earth on its axis"); ?></label>
							</li>
						</ul>
					</form>
					<div class="img-holder">
						<img src="images/11/q1a.jpg">
					</div>
				</div>
				<div class="clear"></div>
				<div id="question2">
					<h2><?php echo _("Question B. Click on the answer that best describes the seasons when the North Pole is tilted towards the sun."); ?></h2>
					<div id="choices2">
						<p><?php echo _('A. '); ?><?php echo _("It is summer time in countries in the Northern Hemisphere. It is winter time in countries in the Southern Hemisphere."); ?></p>
						<p><?php echo _('B. '); ?><?php echo _("It is winter time in countries in the Northern Hemisphere. It is summer time in countries in the Southern Hemisphere."); ?></p>
						<p><?php echo _('C. '); ?><?php echo _("It is winter time in countries in the Northern and Southern Hemisphere."); ?></p>
						<p><?php echo _('D. '); ?><?php echo _("It is summer time in countries in the Northern and Southern Hemisphere."); ?></p>
					</div>
					<div id="hexaflip-container">
						<p><?php echo _("Rotate or flip the 3D box below either up or down to set your answer."); ?></p>
						<div id="hexaflip"></div>
					</div>
				</div>
				</div>
			</div>
			<div id="answer">
				<h1><?php echo _("Quick Check #4"); ?> - <?php echo _("How did I do?"); ?></h1>
				<div class="placeholder">
				<div class="answer-item">
					<h2><?php echo _("Question A. What cycle caused by the sun is the diagram trying to show? What is the cause of this cycle?"); ?></h2>
					<div id="answer1">
						<p><?php echo _("You answered..."); ?></p>
						<p><span id="textanswer1"></span></p>
						<p><img id="answer-icon1"><span id="feedback1"></span></p>
					</div>
					<div class="img-holder">
						<img src="images/11/q1b.jpg">
					</div>
					<div class="clear"></div>
				</div>
				<div class="answer-item">
					<h2><?php echo _("Question B. Click on the answer that best describes the seasons when the North Pole is tilted towards the sun."); ?></h2>
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
		<a href="12.php" class="wiggle"><img class="next-toggle" src="images/buttons/next.png" title="<?php echo _('Next'); ?>"></a>
	</div>
-->
	<div id="buttons">
		<a href="#" class="back back-toggle" title="<?php echo _("Back"); ?>"><i class="fa fa-arrow-left"></i></a>
		<a href="12.php" class="next next-toggle" title="<?php echo _("Next"); ?>"><i class="fa fa-arrow-right"></i></a>
		<a href="#" class="checkanswer check-toggle" title="<?php echo _("Check Answer"); ?>"><i class="fa fa-question"></i></a>
	</div>
	<section id="preloader"><section class="selected"><strong><?php echo _("Ready for last QC?"); ?></strong></section></section>
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
				document.location.href = "10.php#screen2";
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
						textanswer1.text("<?php echo _('Occurrence of seasons, tilt of the earth on its axis'); ?>");
						textstr = "<?php echo _('You got it! The diagram is showing how seasons work. The tilt of the earth is what causes the difference in the amount of sunlight reaching the ground in the different hemispheres and different seasons.'); ?>";
						answericon1.attr("src", "images/others/correct.png");
						feedback1.addClass('green');
						answer1 = "B";
					} else {
						if($('#a1').is(':checked')) {
							textanswer1.text("<?php echo _('Day and night cycle, tilt of the earth on its axis'); ?>");
							textstr = "<?php echo _('Not quite! Day and night are caused by the rotation of the earth, not its tilt. The earth makes a complete turn on its axis, which makes the sun to shine on one half, while the other half will have no light.'); ?>";
							answer1 = "A";
						} else if ($('#a3').is(':checked')) {
							textanswer1.text("<?php echo _('Day and night cycle, rotation of the earth on its axis'); ?>");
							textstr = "<?php echo _('Nope! Day and night are caused by the rotation of the earth, but the diagram is showing the occurrence of seasons due to the tilt of the earth.'); ?>";
							answer1 = "C";
						} else if ($('#a4').is(':checked')) {
							textanswer1.text("<?php echo _('Occurrence of seasons, rotation of the earth on its axis'); ?>");
							textstr = "<?php echo _('Look again! The diagram is showing the occurrence of seasons, but it is due to the tilt of the earth which causes a difference in the amount of sunlight reaching the ground in the different hemispheres.'); ?>";
							answer1 = "D";
						}
						answericon1.attr("src", "images/others/wrong.png");
						answericon1.addClass('img-align');
						feedback1.addClass('red');
					}
					feedback1.text(textstr);
					/* End checking of question A */
					
					/* For checking of question B */
					var hexavalue = hexa.getValue();
					if (hexavalue == './images/others/a.png') answer2 = "A";
					if (hexavalue == './images/others/b.png') answer2 = "B";
					if (hexavalue == './images/others/c.png') answer2 = "C";
					if (hexavalue == './images/others/d.png') answer2 = "D";
					
					if(answer2 == "A") {
						textanswer2.text("<?php echo _('It is summer time in countries in the Northern Hemisphere. It is winter time in countries in the Southern Hemisphere.'); ?>");
						textstr = "<?php echo _('Super! The Northern Hemisphere is getting all the sun, so it will be summer. The Southern Hemisphere is farther away from the sun and it will be winter in that area.'); ?>";
						answericon2.attr("src", "images/others/correct.png");
						feedback2.addClass('green');
					} else {
						if(answer2 == "B") {
							textanswer2.text("<?php echo _('It is winter time in countries in the Northern Hemisphere. It is summer time in countries in the Southern Hemisphere.'); ?>");
							textstr = "<?php echo _('Nope! Exactly the other way around. The Northern Hemisphere is getting all the sun, so it will be summer. The Southern Hemisphere is farther away from the sun and it will be winter in that area.'); ?>";
						} else if (answer2 == "C") {
							textanswer2.text("<?php echo _('It is winter time in countries in the Northern and Southern Hemisphere.'); ?>");
							textstr = "<?php echo _('Think again! The earth is tilted so the same amount of sun will not reach the Northern and Southern Hemisphere at the same time. It is summer time in countries in the Northern Hemisphere. It is winter time in countries in the Southern Hemisphere.'); ?>";
						} else if (answer2 == "D") {
							textanswer2.text("<?php echo _('It is summer time in countries in the Northern and Southern Hemisphere.'); ?>");
							textstr = "<?php echo _('Not quite! The earth is tilted so the same amount of sun will not reach the Northern and Southern Hemisphere at the same time. It is summer time in countries in the Northern Hemisphere. It is winter time in countries in the Southern Hemisphere.'); ?>";
						}
						answericon2.attr("src", "images/others/wrong.png");
						answericon2.addClass('img-align');
						feedback2.addClass('red');
					}
					feedback2.text(textstr);
					/* End checking of question B */
					
					if(answered == 0) {
						saveAnswer('solar-power-qc4-a', answer1);
						saveAnswer('solar-power-qc4-b', answer2);
						answered = 1;
					} // end save to db
					
				}); // end question fade
			} // end else
		}); // end check
		
		makeHexa();
	}); // end doc ready
	
	function checkNull() {
		if(!$('#question1 input:radio').is(':checked')) {
			nullAnswer = true;
		}
	}
	</script>
	<script src="scripts/svgcheckbx.js"></script>
<!--
	<script src="scripts/hexaflip.min.js"></script>
    <script>
        var hexa;
		set = ['./images/others/a.png','./images/others/b.png','./images/others/c.png','./images/others/d.png'];
        function resize(){
            var size, margin = 20;
            size = 150;
    	    var settings = { size: size, margin: margin, perspective: 1000, touchSensitivity: 1 };
            return settings;
        }
        function makeHexa(){
            var settings = resize();
            $('#hexaflip').empty();
            hexa = new HexaFlip(document.getElementById('hexaflip'),  {set1: set}, settings);
        }
    </script>
-->
	<script src="scripts/hexaflip.js"></script>
    <script>
		var set1 = ['./images/others/a.png','./images/others/b.png','./images/others/c.png', './images/others/d.png'];
		var hexa = new HexaFlip(document.getElementById('hexaflip'), { set: set1 }, { size: 150 });
    </script>

	<?php include("setlocale.php"); ?>
</body>
</html>
